<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')
            ->withSuccess('You have logged out successfully!');;
    }
    public function register()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        $validated =$request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);
       if($validated){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return redirect()->route('login');
       }
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
    
            // Check if the authenticated user is an admin
            if(Auth::user()->role === 'admin') {
                return redirect()->route('home')
                    ->withSuccess('You have successfully logged in as admin!');
            } else {
                return redirect()->route('home')
                    ->withSuccess('You have successfully logged in!');
            }
        }
    
        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');
    }
}
