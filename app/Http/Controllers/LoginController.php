<?php

namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class LoginController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->intended(Auth::user()->is_admin ? '/admin/dashboard' : '/');
        }
        return view('auth.login');
    }
 
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
        ]);
 
        $credentials = $request->only('email', 'password');
        $remember    = $request->boolean('remember');
 
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
 
            if (Auth::user()->is_admin) {
                return redirect()->intended('/admin/dashboard')
                    ->with('success', 'Selamat datang, ' . Auth::user()->name . '!');
            }
 
            return redirect()->intended('/')
                ->with('success', 'Berhasil masuk!');
        }
 
        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Email atau password salah.']);
    }
 
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Berhasil keluar.');
    }
}
 