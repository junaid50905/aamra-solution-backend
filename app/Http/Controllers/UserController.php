<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // register
    public function register(Request $request)
    {
        $register_user = User::create($request->all());

        return response()->json($register_user);
    }
}
