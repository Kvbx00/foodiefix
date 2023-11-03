<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\CaloricNeed;

class AuthController extends Controller
{

    public function showRegistrationView()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|regex:"^[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]*$"|max:45',
            'lastName' => 'required|regex:"^[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]*$"|max:100',
            'gender' => '',
            'height' => '',
            'weight' => '',
            'email' => 'required|string|email|max:100|unique:user',
            'age' => '',
            'physicalActivity' => '',
            'goal' => '',
            'password' => 'required|regex:"^(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$"|confirmed',
        ], [
            'name' => "Imię musi zaczynać się z dużej litery",
            'lastName' => "Nazwisko musi zaczynać się z dużej litery",
            'email' => "Wpisałeś nieprawidłowy email",
            'email.unique' => "Taki email już istnieje",
            'password' => "Hasło musi składać się z min. 8 znaków, min. 1 wielkiej litery, min. 1 znaku specjalnego i min. 1 cyfry",
            'password.confirmed' => "Hasła się nie zgadzają",
        ]);

        $user = User::create([
            'name' => $request->name,
            'lastName' => $request->lastName,
            'gender' => $request->gender,
            'height' => $request->height,
            'weight' => $request->weight,
            'email' => $request->email,
            'age' => $request->age,
            'physicalActivity' => $request->physicalActivity,
            'goal' => $request->goal,
            'password' => Hash::make($request->password),
        ]);

        auth()->login($user);

        $bmr = $this->calculateBMR($user->weight, $user->height, $user->age, $user->gender);
        $activityFactor = $this->calculateActivityFactor($user->physicalActivity);
        $goalFactor = $this->calculateGoalFactor($user->goal);

        $caloricNeeds = $bmr * $activityFactor * $goalFactor;

        CaloricNeed::create([
            'caloricNeeds' => $caloricNeeds,
            'date' => now(),
            'user_id' => $user->id,
        ]);

        return redirect('/userPanel');
    }

    private function calculateActivityFactor($activity)
    {
        if ($activity === 'Brak treningów') {
            return 1.2;
        } elseif ($activity === "Niska aktywność") {
            return 1.5;
        } elseif ($activity === "Średnia aktywność") {
            return 1.8;
        } elseif ($activity === "Wysoka aktywność") {
            return 2.1;
        } elseif ($activity === "Bardzo wysoka aktywność") {
            return 2.4;
        }
    }

    private function calculateGoalFactor($goal)
    {
        if ($goal === 'Chcę schudnąć') {
            return 0.8;
        } elseif ($goal === "Chcę utrzymać wagę") {
            return 1.0;
        } elseif ($goal === "Chcę przytyć") {
            return 1.2;
        }
    }

    private function calculateBMR($weight, $height, $age, $gender)
    {
        if ($gender === 'Mężczyzna') {
            return 66.47 + (13.7 * $weight) + (5.0 * $height) - (6.76 * $age);
        } elseif ($gender === 'Kobieta') {
            return 655.1 + (9.567 * $weight) + (1.85 * $height) - (4.68 * $age);
        }
    }

    public function showLoginView()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/userPanel');
        } else {
            return back()->withErrors(['email' => 'Nieprawidłowy email lub hasło']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
