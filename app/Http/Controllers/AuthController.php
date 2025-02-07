<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $req)
    {
        return view('auth.login');
    }

    public function dologin(LoginRequest $req)
    {

        $credentials = $req->validated();
        if(Auth::attempt($credentials)) {
            $req->session()->regenerate();
            $email = $req->input('email');
            return redirect()->intended(route('auth.login'))->with('success', 'You are logged in as')->with('email', $email); // intended: redirect to the original route before the login
        }

        $email = $req->input('email');
        return redirect()->route('auth.login')->with('error', 'unknown user email :')->with('email', $email);
    }

    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect()->route('auth.login')->with('success', 'You are logged out');
    }
}
