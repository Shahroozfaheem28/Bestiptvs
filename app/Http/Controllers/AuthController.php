<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Show Login Form
    public function loginForm()
    {
        return view('auth.login');
    }

    // Show Register Form
    public function registerForm()
    {
        return view('auth.register');
    }

    // Register New User
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user', // default role
        ]);

        Auth::login($user);
        session(['role' => $user->role]);

        return redirect()->route('user.dashboard');
    }

    // Login Existing User
   public function login(Request $request)
{
    // Validate request
    $credentials = $request->only('email', 'password');

    if (auth()->attempt($credentials))
        {
            $user = auth()->user();

            // Role check aur redirect
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            else
                {
                return redirect()->route('user.dashboard');
                 }
        }

    // Login fail hone par wapas login form
    return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }
    public function logout(Request $request)
        {
            auth()->logout();  // User ko logout karo
            $request->session()->invalidate();  // Session invalidate karo
            $request->session()->regenerateToken();  // CSRF token regenerate karo

            return redirect()->route('user.dashboard');  // Login page par redirect karo
        }
}
