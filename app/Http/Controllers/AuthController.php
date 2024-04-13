<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.pages.login');
    }

    public function authenticate(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard.index');
        }

        toast('Email atau password salah', 'error');

        return back()->withInput();
    }

    public function logout()
    {
        Auth::logout();

        toast('Berhasil Logout', 'success');

        return redirect()->route('login');
    }
}
