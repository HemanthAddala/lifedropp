<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:20|unique:users',
            'dob' => 'required|date|before_or_equal:today -18 years', // Must be 18+ to donate
            'gender' => 'required|string|in:Male,Female,Other',
            'city' => 'required|string|max:100',
            'blood_group' => 'required|string|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'dob.before_or_equal' => 'You must be at least 18 years old to register as a blood donor.',
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            // Store directly in public/uploads/avatars for easy Railway accessibility
            $file->move(public_path('uploads/avatars'), $filename);
            $avatarPath = 'uploads/avatars/'.$filename;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'city' => $request->city,
            'blood_group' => $request->blood_group,
            'avatar' => $avatarPath,
            'is_available' => true,
            'role' => 'donor',
            'is_verified' => true,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Welcome, '.$user->name.'! Your blood donor registration was successful.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.index')->with('success', 'Logged in successfully as Administrator.');
            }

            return redirect()->route('dashboard')->with('success', 'Welcome back, '.$user->name.'!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out successfully.');
    }
}
