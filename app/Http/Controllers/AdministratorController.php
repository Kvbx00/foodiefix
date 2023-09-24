<?php

namespace App\Http\Controllers;

use App\Models\CaloricNeed;
use App\Models\Disease;
use App\Models\HealthData;
use App\Models\Ingredient;
use App\Models\IngredientPreference;
use App\Models\Meal;
use App\Models\MealCategory;
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

    public function showUserHealthData()
    {
        $healthData = HealthData::all();

        return view('administrator.userHealthData', compact('healthData'));
    }

    public function editUserHealthData($id)
    {
        $healthData = HealthData::findOrFail($id);

        return view('administrator.editUserHealthData', compact('healthData'));
    }

    public function updateUserHealthData(Request $request, $id)
    {
        $healthData = HealthData::findOrFail($id);

        $validatedData = $request->validate([
            'weight' => '',
            'diastolicBloodPressure' => '',
            'systolicBloodPressure' => '',
            'pulse' => '',
        ]);

        $healthData->update($validatedData);

        return redirect()->route('administrator.userHealthData')->with('success', 'Dane użytkownika zostały zaktualizowane.');
    }

    public function removeUserHealthData($healthDataId)
    {
        $healthData = HealthData::find($healthDataId);

        $healthData->delete();

        return redirect()->route('administrator.userHealthData')->with('success', 'Dane zdrowotne użytkownika zostały usunięte.');
    }

    public function showUserIngredientPreference()
    {
        $ingredientPreference = IngredientPreference::all();

        return view('administrator.userIngredientPreference', compact('ingredientPreference'));
    }

    public function showAddUserIngredientPreferenceView()
    {
        $users = User::all();
        $ingredients = Ingredient::all();

        return view('administrator.addUserIngredientPreference', compact('ingredients', 'users'));
    }

    public function addUserIngredientPreference(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'ingredient_name' => 'required',
        ]);

        $user = User::findOrFail($validatedData['user_id']);
        $ingredientName = $validatedData['ingredient_name'];

        $ingredient = Ingredient::where('name', $ingredientName)->first();

        $ingredientCategory = $ingredient->ingredient_category;

        $existingPreference = $user->ingredientPreferences()->where('ingredient_id', $ingredient->id)->first();

        if ($existingPreference) {
            return back()->withErrors('Użytkownik już ma ten składnik w preferencjach.');
        }

        $user->ingredientPreferences()->attach($ingredient->id, ['ingredient_category_id' => $ingredientCategory->id]);

        return redirect()->route('administrator.userIngredientPreference')->with('success', 'Preferencja została dodana');
    }

    public function removeUserIngredientPreference($ingredientPreferenceId)
    {
        $ingredientPreference = IngredientPreference::find($ingredientPreferenceId);

        $ingredientPreference->delete();

        return redirect()->route('administrator.userIngredientPreference')->with('success', 'Preferencja została usunięta');
    }

    public function showUserCaloricNeed()
    {
        $caloricNeed = CaloricNeed::all();

        return view('administrator.userCaloricNeed', compact('caloricNeed'));
    }

    public function editUserCaloricNeed($id)
    {
        $caloricNeed = CaloricNeed::findOrFail($id);

        return view('administrator.editUserCaloricNeed', compact('caloricNeed'));
    }

    public function updateUserCaloricNeed(Request $request, $id)
    {
        $caloricNeed = CaloricNeed::findOrFail($id);

        $validatedData = $request->validate([
            'caloricNeeds' => 'required|regex:"^(?!0{4})[1-9]\d{3}$"',
        ], [
            'caloricNeeds' => 'Zakres liczbowy to 1000 - 9999 kcal.'
        ]);

        $caloricNeed->update($validatedData);

        return redirect()->route('administrator.userCaloricNeed')->with('success', 'Dane użytkownika zostały zaktualizowane.');
    }

    public function removeUserCaloricNeed($caloricNeedId)
    {
        $caloricNeed = CaloricNeed::find($caloricNeedId);

        $caloricNeed->delete();

        return redirect()->route('administrator.userCaloricNeed')->with('success', 'Dane użytkownika zostały usunięte.');
    }

    public function showDisease()
    {
        $disease = Disease::all();

        return view('administrator.disease', compact('disease'));
    }

    public function editDisease($id)
    {
        $disease = Disease::findOrFail($id);

        return view('administrator.editDisease', compact('disease'));
    }

    public function updateDisease(Request $request, $id)
    {
        $disease = Disease::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|regex:"^([a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+ )*[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+$"|max:70',
        ], [
            'name' => 'Maksymalna długość choroby to 70 znaków. Cyfry i znaki specjalne niedozwolone.',
            'name.required' => 'Pole nie może być puste',
        ]);

        $disease->update($validatedData);

        return redirect()->route('administrator.disease')->with('success', 'Choroba została zaktualizowana.');
    }

    public function removeDisease($diseaseId)
    {
        $disease = Disease::find($diseaseId);

        $disease->delete();

        return redirect()->route('administrator.disease')->with('success', 'Choroba została usunięta.');
    }

    public function showAddDiseaseView()
    {
        return view('administrator.addDisease');
    }

    public function addDisease(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|regex:"^([a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+ )*[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+$"|max:70',
        ], [
            'name' => 'Maksymalna długość choroby to 70 znaków. Cyfry i znaki specjalne niedozwolone.',
            'name.required' => 'Pole nie może być puste',
        ]);

        Disease::create([
            'name' => $request->name,
        ]);

        return redirect()->route('administrator.disease')->with('success', 'Choroba została dodana.');
    }

    public function showMealCategory()
    {
        $mealCategory = MealCategory::all();

        return view('administrator.mealCategory', compact('mealCategory'));
    }

    public function editMealCategory($id)
    {
        $mealCategory = MealCategory::findOrFail($id);

        return view('administrator.editMealCategory', compact('mealCategory'));
    }

    public function updateMealCategory(Request $request, $id)
    {
        $mealCategory = MealCategory::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|regex:"^([a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+ )*[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+$"|max:60',
        ], [
            'name' => 'Maksymalna długość kategorii to 60 znaków. Cyfry i znaki specjalne niedozwolone.',
            'name.required' => 'Pole nie może być puste',
        ]);

        $mealCategory->update($validatedData);

        return redirect()->route('administrator.mealCategory')->with('success', 'Kategoria została zaktualizowana.');
    }

    public function removeMealCategory($mealCategoryId)
    {
        $mealCategory = MealCategory::find($mealCategoryId);

        if ($mealCategory->meals()->count() > 0) {
            return redirect()->route('administrator.mealCategory')->with('error', 'Nie można usunąć kategorii dań z przypisanymi daniami.');
        }

        $mealCategory->delete();

        return redirect()->route('administrator.mealCategory')->with('success', 'Kategoria została usunięta.');
    }

    public function showAddMealCategoryView()
    {
        return view('administrator.addMealCategory');
    }

    public function addMealCategory(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|regex:"^([a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+ )*[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+$"|max:60',
        ], [
            'name' => 'Maksymalna długość kategorii to 60 znaków. Cyfry i znaki specjalne niedozwolone.',
            'name.required' => 'Pole nie może być puste',
        ]);

        MealCategory::create([
            'name' => $request->name,
        ]);

        return redirect()->route('administrator.mealCategory')->with('success', 'Kategoria została dodana.');
    }

    public function showMeal()
    {
        $meal = Meal::all();

        return view('administrator.meal', compact('meal'));
    }

    public function editMeal($id)
    {
        $meal = Meal::findOrFail($id);
        $mealCategory = MealCategory::all();

        return view('administrator.editMeal', compact('meal', 'mealCategory'));
    }

    public function updateMeal(Request $request, $id)
    {
        $meal = Meal::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|regex:"^([a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+ )*[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+$"|max:300',
            'recipe' => 'required|regex:"^([a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+ )*[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+$"|max:5000',
            'meal_category_name' => '',
        ], [
            'name' => 'Maksymalna długość dania to 300 znaków. Cyfry i znaki specjalne niedozwolone.',
            'name.required' => 'Pole nie może być puste',
            'recipe' => 'Maksymalna długość przepisu to 5000 znaków. Cyfry i znaki specjalne niedozwolone.',
            'recipe.required' => 'Pole nie może być puste',
        ]);

        if ($request->has('name')) {
            $newMealName = $validatedData['name'];
            if ($newMealName !== $meal->name) {
                $existingMeal = Meal::where('name', $newMealName)->first();
                if ($existingMeal) {
                    return redirect()->route('administrator.meal')->with('error', 'Danie o podanej nazwie już istnieje.');
                }
            }
        }

        if ($request->has('name')) {
            $meal->name = $validatedData['name'];
        }

        if ($request->has('recipe')) {
            $meal->recipe = $validatedData['recipe'];
        }

        if ($request->has('meal_category_name')) {
            $mealCategoryName = $validatedData['meal_category_name'];
            $mealCategory = MealCategory::where('name', $mealCategoryName)->first();
            if ($mealCategory) {
                $meal->meal_category_id = $mealCategory->id;
            }
        }

        $meal->save();

        return redirect()->route('administrator.meal')->with('success', 'Danie zostało zaktualizowane.');
    }

    public function showAddMealView()
    {
        $mealCategory = MealCategory::all();

        return view('administrator.addMeal', compact('mealCategory'));
    }

    public function addMeal(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|regex:"^([a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+ )*[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+$"|max:300',
            'recipe' => 'required|regex:"^([a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+ )*[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+$"|max:5000',
            'meal_category_name' => '',
        ], [
            'name' => 'Maksymalna długość dania to 300 znaków. Cyfry i znaki specjalne niedozwolone.',
            'name.required' => 'Pole nie może być puste',
            'recipe' => 'Maksymalna długość przepisu to 5000 znaków. Cyfry i znaki specjalne niedozwolone.',
            'recipe.required' => 'Pole nie może być puste',
        ]);

        $mealName = $validatedData['name'];
        $mealRecipe = $validatedData['recipe'];
        $mealCategoryName = $validatedData['meal_category_name'];

        $existingMeal = Meal::where('name', $mealName)->first();

        if ($existingMeal) {
            return redirect()->route('administrator.meal')->with('error', 'Danie o podanej nazwie już istnieje.');
        }

        $mealCategory = MealCategory::where('name', $mealCategoryName)->first();

        $meal = new Meal();
        $meal->name = $mealName;
        $meal->recipe = $mealRecipe;
        $meal->meal_category_id = $mealCategory->id;

        $meal->save();

        return redirect()->route('administrator.meal')->with('success', 'Danie zostało dodane.');
    }

    public function removeMeal($mealId)
    {
        $meal = Meal::find($mealId);

        if ($meal->ingredients()->count() > 0) {
            return redirect()->route('administrator.meal')->with('error', 'Nie można usunąć dania z przypisanymi składnikami.');
        }

        if ($meal->menus()->count() > 0) {
            return redirect()->route('administrator.meal')->with('error', 'Nie można usunąć dania przypisanego do menu użytkownika.');
        }

        if ($meal->nutritionalvalues()->count() > 0) {
            return redirect()->route('administrator.meal')->with('error', 'Nie można usunąć dania z przypisanymi wartościami odżywczymi.');
        }

        $meal->delete();

        return redirect()->route('administrator.meal')->with('success', 'Danie zostało usunięte.');
    }


}
