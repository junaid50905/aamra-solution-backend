<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // register
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users,email',
            'name' => 'required',
            'password' => 'required'
        ]);

        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('register_' . $request->email)->plainTextToken;

        return response([
            'message' => 'Successfully registered',
            'status' => 'success',
            'token' => $token
        ], 201);
    }

    // login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            $token = $user->createToken('login_' . $request->email)->plainTextToken;

            return response([
                'message' => 'Successfully login',
                'status' => 'success',
                'token' => $token
            ], 200);
        }

        return response([
            'message' => 'Invalid credential',
            'status' => 'failed'
        ], 401);
    }

    // logout
    public function logout()
    {
        if (auth()->check()) {

            auth()->user()->tokens()->delete();

            return response([
                'message' => 'Successfully logged out',
                'status' => 'success'
            ], 200);
        }

        return response([
            'message' => 'User not authenticated',
            'status' => 'failed'
        ], 401);
    }

    // logged user data
    public function logged_user()
    {
        $logged_user = auth()->user();

        return response([
            'user' => $logged_user,
            'status' => 'success'
        ], 200);
    }

    // change password
    public function change_password(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
        ]);

        $logged_user = auth()->user();
        $logged_user->password = Hash::make($request->password);
        $logged_user->save();

        return response([
            'message' => 'Password changed successfully',
            'status' => 'success'
        ]);
    }

}
