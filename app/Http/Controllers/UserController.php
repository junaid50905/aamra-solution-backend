<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
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

        if (User::where('email', $request->email)->first()) {
            return response([
                'message' => 'This email already exists',
                'status' => 'failed'
            ], 422);
        }

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


        auth()->user()->tokens()->delete();

        return response([
            'message' => 'Successfully logged out',
            'status' => 'success'
        ], 200);
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



    // profile
    public function profile(Request $request)
    {
        $logged_user_id = auth()->user()->id;
        UserProfile::updateOrInsert(
            ['user_id' => $logged_user_id],
            [
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'spouse_name' => $request->spouse_name,
                'phone' => $request->phone,
                'profile_picture' => $request->profile_picture,
                'gender' => $request->gender,
            ]
        );
        
        return response([
            'message' => 'Successfully update profile information',
            'status' => 'success',
        ], 200);
    }

    // profileData
    public function profileData()
    {
        $logged_user_id = auth()->user()->id;
        $user_profile_data = UserProfile::where('user_id', $logged_user_id)->first();

        return response([
            'profile' => $user_profile_data,
            'status' => 'success'
        ], 200);
    }

}
