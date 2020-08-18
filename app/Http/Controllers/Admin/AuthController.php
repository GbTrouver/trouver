<?php

namespace App\Http\Controllers\Admin;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminAuthRequest;

class AuthController extends Controller
{
    public function loginPost(AdminAuthRequest $request)
    {
        $valid = $request->validated();
        if (Auth::attempt([
                'email' => $valid['email'],
                'password' => $valid['password']
            ])) {
            $user = Auth::user();
            return redirect()->route('admin.dashboard')->with('success', $user->first_name.' '.$user->last_name.' Logged in successfully.');
        } else {
            return redirect()->back()->with('error', 'Please, check your credentials.');
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('admin.login')->with('success', "You've logged out successfully.");
    }
}
