<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
Use App\Models\User;


class LoginController
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
       
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json([
                'isLogin' => true,
                'user_name' => Auth::user()->name,
            ]);
            
        }

        return response()->json([
            'message' => 'The provided credentials do not match our records.',
        ], 401);
    }
    public function register(Request $request){
        $request->validate([
            'password' => ['required', 'string','confirmed'],
        ]);
        $hashedPassword = Hash::make($request->password);
        $request['password'] = $hashedPassword;
        User::create($request->all());
    }
    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return response()->json([
            'isLogin' => false,
        ]);;
    }
    public function checkLogin(Request $request)
    {
        
        return Auth::check();
        
    }
 
}
