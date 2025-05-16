<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.Register');
    }

    // Traiter l'inscription
    public function register(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'telephone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'name_assotiation' => 'required|string|max:255',
            'roleuser' => 'nullable|string|in:رئيس(ة) الجمعية,كاتب(ة) الجمعية,أمين(ة) الجمعية,عضو الجمعية'
        ]);

        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telephone' => $request->telephone,
            'address' => $request->address,
            'name_assotiation' => $request->name_assotiation,
            'role' => 'user',
            'roleuser' => $request->roleuser,
            'is_approved' => false,
        ]);

        return back()->with('message', 'تم إرسال طلب التسجيل بنجاح، سيتم مراجعته من طرف الإدارة.');
    }

}
