<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class registerController extends Controller
{
    public function showregister(){
        return view('register');
    }
    public function showlogin(){
        return view('login');
    }
    public function register(Request $request){
        $request->validate([
            'name'=>'required',
            'phone'=>'required|max:10',
            'email'=>'required|email|unique:users',
            'username'=>'required|unique:users',
            'password'=>'required|min:4',
        ]);
         // Insert user into database
         $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            return view('login');
        } else {
            return redirect()->back()->with('error', 'Failed to register');
        }
    }
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Hardcoded Admin Credentials
        if ($credentials['username'] === 'mr_m_jeswal' && $credentials['password'] === 'admin1420') {
            session([
                'username' => 'mr_m_jeswal',
                'profile_image' => asset('uploads/admin-default.png') // Admin profile image
            ]);
            return redirect()->route('adp')->with('success', 'Admin logged in successfully.');
        }

        // Authenticate Normal Users
        if (Auth::attempt($credentials)) {
            session([
                'username' => Auth::user()->username,
                'profile_image' => Auth::user()->profile_image ?? asset('uploads/default-profile.png')
            ]);
            return redirect()->route('home')->with('success', 'Login successful.');
        }

        return back()->with('error', 'Invalid credentials');
    }

    // User Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logged out successfully.');
    }
    public function index()
    {
        return view('profile', [
            'user' => Auth::user(),
            'profile_image' => session('profile_image', asset('uploads/default-profile.png'))
        ]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/' . $filename;

            // Store the image in the public/uploads directory
            $image->move(public_path('uploads'), $filename);

            // Store the image URL in session
            session(['profile_image' => asset($path)]);
        }

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

}
