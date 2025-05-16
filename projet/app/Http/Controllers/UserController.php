<?php

namespace App\Http\Controllers;

use App\Models\MeetingMember;
use App\Models\Need;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

public function index()
    {
        $needs = Need::all();  // جلب كل الحاجيات من الداتابيز
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
