<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;

class AuthController extends Controller
{
    // admin and amdin user login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|string|max:191',
            'password' => 'required|min:3',
        ]);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput($request->all());
        }

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return redirect()->route('adminDashboard');
        } else {
            return redirect()->back()->with('loginerror', 'Incorrect Email or Password!');
        }

    }

    // admin and admin user logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('adminLogin');
    }
}
