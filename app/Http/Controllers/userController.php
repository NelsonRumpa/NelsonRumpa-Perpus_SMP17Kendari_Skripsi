<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function showLoginForm()
    {
        return view('akun.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
            $request->session()->regenerate();

            $user = Auth::user();
            return redirect('dashboard');
        }

        return redirect()->back()->with('error', 'Invalid username or password');
    }
    
    public function showRegisterForm()
    {
        return view('akun.regis');
    }

    public function register(Request $request)
{
    $request->validate([
        'username' => 'required|string|max:255',
        'password' => 'required|string|confirmed|min:8',
    ]);

    $user = User::create([
        'username' => $request->username,
        'password' => Hash::make($request->password), 
    ]);

    Auth::login($user); 

    return redirect('dashboard');
}
}
