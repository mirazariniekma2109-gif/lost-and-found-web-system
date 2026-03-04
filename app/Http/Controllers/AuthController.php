<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * 1. Papar Borang Register
     */
    public function showRegister()
    {
        return view('auth.register'); // Pastikan folder/fail ini wujud
    }

    /**
     * 2. Proses Pendaftaran User Baru
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone'    => 'nullable|string'
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'phone'    => $request->phone,
        ]);

        // Login secara automatik selepas register
        Auth::login($user);

        // Terus ke Home (/) bukannya Dashboard
        return redirect()->route ('dashboard')->with('success', 'Account created and logged in successfully!');
    }

    /**
     * 3. Papar Borang Login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * 4. Proses Login User
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Berjaya login terus ke Home (/)
            return redirect()->route ('dashboard')->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * 5. Proses Logout User
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Balik ke Home (/) selepas logout
        return redirect('/');
    }
}