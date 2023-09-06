<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    public function showRegitrationView(){
        return view('auth.register');
    }

    public function register(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'height' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'age' => 'required',
            'physicalactivity' => 'required',
            'goal' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'gender' => $request->gender,
            'height' => $request->height,
            'email' => $request->email,
            'age' => $request->age,
            'physicalactivity' => $request->physicalactivity,
            'goal' => $request->goal,
            'password' => Hash::make($request->password), // Haszowanie hasła
        ]);

        auth()->login($user);

        return redirect('/home');
    }

    public function showLoginView(){
        return view('auth.login');
    }

    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)){
            return redirect()->intended('/home');
        } else{
            return back()->withErrors(['email' => 'Nieprawidłowy email lub hasło']);
        }
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/');
    }
}
