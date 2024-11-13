<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\RegisterRequest;

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
                'name' => Auth::user()->name,
            ]);
            
        }

        return response()->json([
            'message' => 'The provided credentials do not match our records.',
        ], 401);
    }
    public function register(RegisterRequest $request){
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
