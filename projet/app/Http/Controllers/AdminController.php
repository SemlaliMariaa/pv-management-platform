<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
     public function pendingUsers()
    {
        $users = User::where('is_approved', false)->get();
        return view('admin.pending_users', compact('users'));
    }

    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = true;
        $user->save();

        return redirect()->back()->with('success', 'المستخدم تم تفعيله بنجاح');
    }

    public function rejectUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();  // أو تقدر تعطل الحساب بطريقة أخرى

        return redirect()->back()->with('success', 'المستخدم تم رفضه وحذفه');
    }
}
