<?php

namespace App\Http\Controllers;

use App\Models\Mahdar;
use App\Models\MeetingMember;
use App\Models\Need;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{


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
        $query = MeetingMember::with(['user', 'mahdar'])
            ->orderBy('created_at', 'desc');

        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->has('association_name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name_assotiation', $request->association_name);
            });
        }

        $members = $query->paginate(20);

        return view('user.meetingusers', compact('members'));
    }


    public function editM(MeetingMember $meetingMember)
    {
        $users = User::orderBy('fullname')->get();

        $associations = User::whereNotNull('name_association')
            ->select('name_association')
            ->distinct()
            ->pluck('name_association', 'name_association');

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
                function ($attribute, $value, $fail) use ($request) {
                    if (
                        MeetingMember::where('fullname', $value)
                        ->where('mahdar_id', $request->mahdar_id)
                        ->exists()
                    ) {
                        $fail("الاسم '$value' مسجل من قبل في هذا المحضر.");
                    }
                }
            ],
            'members.*.role' => 'required|string',
        ]);

        $fullnames = array_column($request->members, 'fullname');
        if (count($fullnames) !== count(array_unique($fullnames))) {
            $validator->after(function ($validator) {
                $validator->errors()->add('members', 'الأسماء لا يجب أن تتكرر داخل نفس المحضر.');
            });
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $mahdar = Mahdar::create([
            'title' => 'PV - ' . now()->format('Y-m-d H:i:s'),
            'user_id' => Auth::id()
        ]);


        foreach ($request->members as $member) {
            MeetingMember::create([
                'mahdar_id' => $mahdar->id,
                'fullname' => $member['fullname'],
                'role' => $member['role'],
                'user_id' => Auth::id(),
                'association_name' => Auth::user()->name_assotiation
            ]);
        }

        return back()->with('success', 'تم تسجيل المحضر والأعضاء بنجاح');
    }

    public function updateM(Request $request, MeetingMember $meetingMember)
    {
        $validated = $request->validate([
            'mahdar_id' => 'required|exists:mahdars,id',
            'user_id' => 'nullable|exists:users,id',
            'fullname' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'signature' => 'nullable|string',
        ]);

        $validated['signature'] = $request->has('existing_signature')
            ? $request->existing_signature
            : $request->signature;

        $meetingMember->update([
            'fullname' => $validated['fullname'],
            'role' => $validated['role'],
            'signature' => $validated['signature']
        ]);

        return redirect()->route('meetings.index')
            ->with('success', 'Participant mis à jour avec succès.');
    }
    public function destroyM(MeetingMember $meetingMember)
    {
        if ($meetingMember->signature) {
            Storage::disk('public')->delete($meetingMember->signature);
        }

        $meetingMember->delete();

        return redirect()->route('meetings.index')
            ->with('success', 'Participant supprimé avec succès.');
    }

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
            'mahdar_id' => 'required|exists:mahdars,id'
        ]);

        $descriptions = $request->description;
        $quantities = $request->quantity_required;

        foreach ($descriptions as $index => $desc) {
            Need::create([
                'mahdar_id' => $request->mahdar_id,
                'user_id' => auth()->id(),
                'description' => $desc,
                'quantity_required' => $quantities[$index],
                'number' => Need::where('mahdar_id', $request->mahdar_id)->max('number') + 1 ?? 1,
            ]);
        }

        return redirect()->back()->with('success', 'تمت إضافة الحاجيات بنجاح!');
    }

    public function showMeetingNote()
    {
        $user = Auth::user();
        $mahdar = Mahdar::where('user_id', $user->id)
            ->latest()
            ->firstOr(function () use ($user) {
                return Mahdar::create([
                    'title' => 'PV - ' . now()->format('Y-m-d'),
                    'user_id' => $user->id
                ]);
            });

        return view('user.dashboard', compact('user', 'mahdar'));
    }

    public function createOrGetMahdar()
    {
        $user = auth()->user();

        $mahdar = Mahdar::create([
            'title' => 'PV - ' . now()->format('Y-m-d H:i'),
            'user_id' => $user->id
        ]);

        return $mahdar;
    }











    public function generateReport()
    {
        $user = Auth::user();
        $members = MeetingMember::where('mahdar_id', $user->id)->get();
        $needs = Need::where('mahdar_id', $user->id)->get();

        return view('user.rapport', compact('user', 'members', 'needs'));
    }




    public function generateArabicPDF()
    {
        $user = Auth::user();
        $members = MeetingMember::where('mahdar_id', $user->id)->get();
        $needs = Need::where('mahdar_id', $user->id)->get();

        $pdf = Pdf::loadView('user.pdf', compact('user', 'members', 'needs'))
            ->setPaper('A4', 'portrait')
            ->setOption('defaultFont', 'Amiri')
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true)
            ->setOption('isFontSubsettingEnabled', true)
            ->setOption('isPhpEnabled', true);

        return $pdf->download('meeting_report_' . now()->format('Y-m-d') . '.pdf');
    }




}
