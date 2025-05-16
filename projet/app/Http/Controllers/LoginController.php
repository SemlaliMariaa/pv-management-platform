<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
     public function showLoginForm()
    {
        return view('auth.Login');
    }

    // Traiter la connexion
   public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt($credentials, $request->remember)) {
        $request->session()->regenerate();

        $user = Auth::user();

        // ✅ التحقق واش مقبول
        if (!$user->is_approved) {
            Auth::logout(); // نخرجوه
            return back()->withErrors([
                'message' => 'حسابك مازال ما تمش تأكيده من طرف الإدارة.',
            ]);
        }

        // ✅ التوجيه حسب الدور
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }

    return back()->withErrors([
        'email' => 'البريد الإلكتروني أو كلمة السر غير صحيحة.',
    ])->onlyInput('email');
}




    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return  redirect('/');
    }
}
