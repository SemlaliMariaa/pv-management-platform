<?php

namespace App\Http\Controllers;

use App\Models\MeetingMember;
use App\Models\Need;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function showMeetingNote()
{
    $user = Auth::user(); 
    return view('user.dashboard', compact('user'));
}

public function store(Request $request)
{
    $members = $request->input('members', []);

    foreach ($members as $data) {
        if (!empty($data['fullname']) && !empty($data['role'])) {
            MeetingMember::create([
                'fullname' => $data['fullname'],
                'role' => $data['role'],
            ]);
        }
    }

    return back()->with('success', 'تم تسجيل الأعضاء بنجاح');
}




 public function indexM(Request $request)
    {
        $query = MeetingMember::with(['user', 'association'])
            ->orderBy('created_at', 'desc');

        // Filtrage par utilisateur si user_id est spécifié
        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filtrage par association si association_name est spécifié
        if ($request->has('association_name')) {
            $query->where('association_name', $request->association_name);
        }

        $members = $query->paginate(20);

        return view('user.meetingusers', compact('members'));
    }
    public function editM(MeetingMember $meetingMember)
{
    $users = User::orderBy('fullname')->get();
    $associations = User::whereNotNull('name_assotiation')
                       ->distinct('name_assotiation')
                       ->pluck('name_assotiation', 'name_assotiation');

    return view('user.edit', compact('meetingMember', 'users', 'associations'));
}

public function storeM(Request $request)
{
   $validator = Validator::make($request->all(), [
        'members' => 'required|array',
        'members.*.fullname' => [
            'required',
            'string',
            'max:255',
            // شرط uniqueness فقاعدة البيانات
            function ($attribute, $value, $fail) {
                if (MeetingMember::where('fullname', $value)->exists()) {
                    $fail("الاسم '$value' مسجل من قبل.");
                }
            }
        ],
        'members.*.role' => 'required|string',
    ]);

    // شرط آخر باش نمنعو التكرار داخل نفس الطلب
    $fullnames = array_column($request->members, 'fullname');
    if (count($fullnames) !== count(array_unique($fullnames))) {
        $validator->after(function ($validator) {
            $validator->errors()->add('members', 'الأسماء لا يجب أن تتكرر داخل نفس الطلب.');
        });
    }

    // التحقق من الأخطاء
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // الحفظ
    foreach ($request->members as $member) {
        MeetingMember::create([
            'fullname' => $member['fullname'],
            'role' => $member['role'],
            'user_id' => auth()->id(), // ID de l'utilisateur qui ajoute
            'association_name' => auth()->user()->name_assotiation, // Nom de l'association
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    return redirect()->back()->with('success', 'تمت إضافة المشاركين بنجاح!');
}


public function updateM(Request $request, MeetingMember $meetingMember)
{
    $validated = $request->validate([
        'user_id' => 'nullable|exists:users,id',
        'fullname' => 'required|string|max:255',
        'role' => 'required|string|max:255',
        'association_name' => 'nullable|string|max:255',
        'existing_signature' => 'nullable|string', // Champ caché pour la signature existante
    ]);

    // Si une signature existante a été envoyée (via le champ caché)
    if ($request->has('existing_signature')) {
        $validated['signature'] = $request->existing_signature;
    }

    $meetingMember->update($validated);

    return redirect()->route('meetings.index')
        ->with('success', 'Participant mis à jour avec succès.');
}
public function destroyM(MeetingMember $meetingMember)
{
    // Supprimer la signature si elle existe
    if ($meetingMember->signature) {
        Storage::disk('public')->delete($meetingMember->signature);
    }

    $meetingMember->delete();

    return redirect()->route('meetings.index')
        ->with('success', 'Participant supprimé avec succès.');
}

// gestion needs 
// app/Http/Controllers/UserController.php

    public function index()
    {
        $needs = Need::all();
        return view('user.dashboard', compact('needs'));
    }

    public function storeNeeds(Request $request)
    {
        $request->validate([
            'description.*' => 'required|string|max:255',
            'quantity_required.*' => 'required|integer|min:1',
        ]);

        $descriptions = $request->description;
        $quantities = $request->quantity_required;

        foreach ($descriptions as $index => $desc) {
            Need::create([
                'description' => $desc,
                'quantity_required' => $quantities[$index],
                'number' => Need::max('number') ? Need::max('number') + 1 : 1,
            ]);
        }

        return redirect()->back()->with('success', 'تمت إضافة الحاجيات بنجاح!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'quantity_required' => 'required|integer|min:1',
        ]);

        $need = Need::findOrFail($id);
        $need->update([
            'description' => $request->description,
            'quantity_required' => $request->quantity_required,
        ]);

        return redirect()->route('needs.index')->with('success', 'تم تعديل الحاجة بنجاح!');
    }

    public function destroy($id)
    {
        $need = Need::findOrFail($id);
        $need->delete();

        return redirect()->route('needs.index')->with('success', 'تم حذف الحاجة بنجاح!');
    }
} 