<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Manual authentication to avoid any issues
        $user = User::where('email', $request->email)->first();

        if ($user && \Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();
            
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function createAdminUser()
    {
        if (!User::where('email', 'admin@igea.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@igea.com',
                'password' => bcrypt('password123'),
            ]);
            return "Admin user created: admin@igea.com / password123";
        }
        return "Admin user already exists.";
    }
}