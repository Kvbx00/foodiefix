<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdministratorController extends Controller
{

    public function showUserProfile()
    {
        $user = User::all();

        return view('administrator.userProfile', compact('user'));
    }

    public function editUserProfile($id)
    {
        $user = User::findOrFail($id);
        return view('administrator.editUserProfile', compact('user'));
    }

    public function updateUserProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|regex:"^[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]*$"|max:45',
            'lastName' => 'required|regex:"^[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]*$"|max:100',
            'gender' => '',
            'height' => '',
            'email' => 'required|string|email|max:100|unique:user,email,' . $id,
            'age' => '',
            'physicalActivity' => '',
            'goal' => '',
        ], [
            'name' => "Imię musi zaczynać się z dużej litery",
            'lastName' => "Nazwisko musi zaczynać się z dużej litery",
            'email' => "Wpisałeś nieprawidłowy email",
            'email.unique' => "Taki email już istnieje",
        ]);

        if (!empty($request->password)) {
            $request->validate([
                'password' => 'regex:"^(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$"|confirmed',
            ], [
                'password' => 'Hasło musi składać się z min. 8 znaków, min. 1 wielkiej litery, min. 1 znaku specjalnego i min. 1 cyfry.',
                'password.confirmed' => 'Hasła się nie zgadzają.',
            ]);

            $user->password = bcrypt($request->password);
        }

        $user->update($validatedData);

        return redirect()->route('administrator.userProfile')->with('success', 'Dane użytkownika zostały zaktualizowane.');
    }
}
