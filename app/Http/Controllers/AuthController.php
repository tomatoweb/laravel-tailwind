<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $req)
    {
        return view('auth.login');
    }

    public function dologin(LoginRequest $req)
    {

        $data = $req->validated();

        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];
        /**
         * @var UploadedFile|null $image
         */
        $image = $data['image'];        
                 
        $imagePath = $image->store('blog', 'public');        
        
        if (Auth::attempt($credentials)) {
            User::where('email', $data['email'])->update(['image' => $imagePath]); // php artisan storage:link
            $req->session()->regenerate();
            $email = $req->input('email');
            return redirect()->intended(route('auth.login'))->with('success', 'You are logged in as')->with('email', $email)->with('image', $imagePath); // intended: redirect to the original route before the login
        }

        
        return redirect()->route('auth.login')->with('error', 'unknown user email :')->onlyInput('email')->withErrors(['email' => 'cet email n\'existe pas', 'password' => 'mot de passe incorrect']);
    }

    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect()->route('auth.login')->with('success', 'You are logged out');
    }
}
