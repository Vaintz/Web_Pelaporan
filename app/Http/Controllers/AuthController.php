<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
                'regex:/^[^@\s]+@(mhs\.)?unimal\.ac\.id$/',
            ],
            'password' => [
                'required',
            ],
        ], [
            'email.regex' => 'Gunakan email kampus UNIMAL yang valid.',
        ]);

        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors([
                    'email' => 'Email atau password salah.',
                ])
                ->withInput($request->only('email'));
        }

        $request->session()->regenerate();

        return match (Auth::user()->role) {
            'pelapor' => redirect()->route('pelapor.dashboard'),
            'admin_fakultas' => redirect()->route('admin.fakultas.dashboard'),
            'admin_biro' => redirect()->route('admin.biro.dashboard'),
            default => abort(403),
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}