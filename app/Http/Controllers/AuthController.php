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
            'name' => 'required|regex:"^[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]*$"|max:45',
            'lastname' => 'required|regex:"^[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]*$"|max:100',
            'gender' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'email' => 'required|string|email|max:100|unique:users',
            'age' => 'required',
            'physicalactivity' => 'required',
            'goal' => 'required',
            'password' => 'required|regex:"^(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$"|confirmed',
        ], [
            'name' => "Imię musi zaczynać się z dużej litery",
            'lastname' => "Nazwisko musi zaczynać się z dużej litery",
            'email' => "Wpisałeś nieprawidłowy email",
            'email.unique' => "Taki email już istnieje",
            'password' => "Hasło musi składać się z min. 8 znaków, min. 1 wielkiej litery, min. 1 znaku specjalnego i min. 1 cyfry",
            'password.confirmed' => "Hasła się nie zgadzają",
        ]);

        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'gender' => $request->gender,
            'height' => $request->height,
            'weight' => $request->weight,
            'email' => $request->email,
            'age' => $request->age,
            'physicalactivity' => $request->physicalactivity,
            'goal' => $request->goal,
            'password' => Hash::make($request->password),
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
