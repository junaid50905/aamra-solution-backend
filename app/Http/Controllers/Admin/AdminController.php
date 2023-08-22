<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.admin_dashboard', compact('users'));
    }
    public function resetPasswordForm($id)
    {
        $reset_user = User::find($id);

        return view('admin.reset_password', compact('reset_user'));
    }
    public function reset(Request $request, $id)
    {
        $request->validate([
            'password' => 'required',
        ]);
        $new_password = $request->input('password');

        $user = User::find($id);
        $user->password = Hash::make($new_password);
        $user->save();

        return redirect()->route('admin')->with('success', 'User password reset successfully.');


    }
}