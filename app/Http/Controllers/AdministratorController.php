<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\UserDisease;
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

    public function showUserDisease()
    {
        $userDisease = UserDisease::all();

        return view('administrator.userDisease', compact('userDisease'));
    }

    public function showAddUserDiseaseView()
    {
        $users = User::all();
        $diseases = Disease::all();

        return view('administrator.addUserDisease', compact('users', 'diseases'));
    }

    public function addUserDisease(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'disease_name' => 'required',
        ]);

        $user = User::findOrFail($validatedData['user_id']);
        $diseaseName = $validatedData['disease_name'];

        $existingDisease = $user->diseases->where('name', $diseaseName)->first();

        if ($existingDisease) {
            return back()->withErrors('Użytkownik posiada już taką chorobę');
        }

        $disease = Disease::where('name', $diseaseName)->first();

        $user->diseases()->attach($disease->id);

        return redirect()->route('administrator.userDisease')->with('success', 'Choroba została dodana użytkownikowi.');
    }

    public function removeUserDisease($userDiseaseId)
    {
        $userDisease = UserDisease::find($userDiseaseId);

        $userDisease->delete();

        return redirect()->route('administrator.userDisease')->with('success', 'Choroba użytkownika została usunięta.');
    }
}
