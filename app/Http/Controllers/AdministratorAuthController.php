<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Administrator;
use Illuminate\Support\Facades\Hash;

class AdministratorAuthController extends Controller
{
    public function showAdminLoginView()
    {
        return view('administratorAuth.login');
    }

    public function adminLogin(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect('/admin/dashboard');
        } else {
            return back()->withErrors(['email' => 'Nieprawidłowy email lub hasło']);
        }
    }

    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect('/adminLogin');
    }

    public function showAdminRegistrationView()
    {
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role === 'admin') {
            return view('administratorAuth.register');
        }
        return redirect('/admin/dashboard');
    }

    public function adminRegister(Request $request)
    {
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role === 'admin') {
            $this->validate($request, [
                'email' => 'required|string|email|max:100|unique:user',
                'password' => 'required|regex:"^(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$"|confirmed',
                'role' => '',
            ], [
                'email' => "Wpisałeś nieprawidłowy email",
                'email.unique' => "Taki email już istnieje",
                'password' => "Hasło musi składać się z min. 8 znaków, min. 1 wielkiej litery, min. 1 znaku specjalnego i min. 1 cyfry",
                'password.confirmed' => "Hasła się nie zgadzają",
            ]);

            Administrator::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            return redirect()->route('administrator.adminProfile')->with('success', 'Konto pracownika zostało utworzone.');
        }
        return redirect('/admin/dashboard');
    }

}
