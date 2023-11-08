<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HealthData;
use Carbon\Carbon;
use App\Models\UserDisease;
use App\Models\Disease;
use App\Models\Ingredient;
use App\Models\IngredientPreference;
use App\Models\User;
use App\Models\CaloricNeed;

class HealthDataController extends Controller
{
    public function showUserPanelView()
    {
        $lastRecord = HealthData::where('user_id', auth()->id())
            ->latest('date')
            ->first();

        $lastValues = [
            'weight' => $lastRecord ? $lastRecord->weight : null,
            'diastolicBloodPressure' => $lastRecord ? $lastRecord->diastolicBloodPressure : null,
            'systolicBloodPressure' => $lastRecord ? $lastRecord->systolicBloodPressure : null,
            'pulse' => $lastRecord ? $lastRecord->pulse : null,
        ];

        session(['lastValues' => $lastValues]);

        $diseases = Disease::all();
        $availableDiseases = $this->getAvailableDiseases(auth()->user(), $diseases);

        $ingredients = Ingredient::all();
        $availableIngredients = $this->getAvailableIngredients(auth()->user(), $ingredients);

        $userMeasurements = HealthData::where('user_id', auth()->id())->paginate(5);

        $userMeasurementsForChart = HealthData::where('user_id', auth()->id())->latest('date')->get()->reverse();

        $chartData = [
            'labels' => $userMeasurementsForChart->pluck('date'),
            'weight' => $userMeasurementsForChart->pluck('weight'),
            'pulse' => $userMeasurementsForChart->pluck('pulse'),
            'diastolicBloodPressure' => $userMeasurementsForChart->pluck('diastolicBloodPressure'),
            'systolicBloodPressure' => $userMeasurementsForChart->pluck('systolicBloodPressure'),
        ];

        return view('user.userPanel', compact('lastValues', 'availableDiseases', 'availableIngredients', 'userMeasurements', 'chartData'));
    }

    public function storeMeasurements(Request $request)
    {
        $user = User::find(auth()->id());
        $weight = $request->input('weight');
        $height = $user->height;
        $age = $user->age;
        $gender = $user->gender;
        $physicalActivity = $user->physicalActivity;
        $goal = $user->goal;

        $bmr = $this->calculateBMR($weight, $height, $age, $gender);
        $activityFactor = $this->calculateActivityFactor($physicalActivity);
        $goalFactor = $this->calculateGoalFactor($goal);

        $caloricNeeds = $bmr * $activityFactor * $goalFactor;

        $existingCaloricNeed = CaloricNeed::where('user_id', auth()->id())->first();

        if ($existingCaloricNeed) {
            $existingCaloricNeed->update([
                'caloricNeeds' => $caloricNeeds,
                'date' => Carbon::today(),
            ]);
        } else {
            CaloricNeed::create([
                'caloricNeeds' => $caloricNeeds,
                'date' => Carbon::today(),
                'user_id' => auth()->id(),
            ]);
        }

        $dataToUpdate = $request->all();
        $dataToUpdate['user_id'] = auth()->id();
        $dataToUpdate['date'] = Carbon::today();

        if (isset($weight)){
            $user->update(['weight' => $weight]);
        }

        $existingRecord = HealthData::where('user_id', auth()->id())
            ->whereDate('date', Carbon::today())
            ->first();

        if ($existingRecord) {
            $existingRecord->update($dataToUpdate);
        } else {
            foreach ($dataToUpdate as $field => $value) {
                if (!isset($value)) {
                    unset($dataToUpdate[$field]);
                }
            }

            HealthData::create($dataToUpdate);
        }

        return redirect()->back()->with('success', 'Dane zostały zapisane.');
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

    public function storeDiseases(Request $request)
    {
        $userId = auth()->user()->id;
        $diseaseId = $request->input('diseases_id');

        $existingUserDisease = UserDisease::where('user_id', $userId)->where('diseases_id', $diseaseId)->first();

        if (!$existingUserDisease) {
            UserDisease::create([
                'user_id' => $userId,
                'diseases_id' => $diseaseId,
            ]);
        }

        return redirect()->route('userPanel');
    }

    public function destroyDiseases($id)
    {
        $userId = auth()->user()->id;
        $userDisease = UserDisease::where('user_id', $userId)->where('diseases_id', $id)->first();

        if ($userDisease) {
            $userDisease->delete();
        }

        return redirect()->route('userPanel');
    }

    private function getAvailableDiseases($user, $allDiseases)
    {
        $userDiseases = $user->diseases;
        $availableDiseases = $allDiseases->diff($userDiseases);

        return $availableDiseases;
    }

    public function storeIngredients(Request $request)
    {
        $userId = auth()->user()->id;
        $ingredientId = $request->input('ingredient_id');
        $ingredient = Ingredient::find($ingredientId);

        $ingredientCategoryId = $ingredient->category_id;

        $existingUserIngredient = IngredientPreference::where('user_id', $userId)->where('ingredient_id', $ingredientId)->first();

        if (!$existingUserIngredient) {
            IngredientPreference::create([
                'user_id' => $userId,
                'ingredient_id' => $ingredientId,
                'ingredient_category_id' => $ingredientCategoryId,
            ]);
        }

        return redirect()->route('userPanel');
    }

    public function destroyIngredients($id)
    {
        $userId = auth()->user()->id;
        $userIngredient = IngredientPreference::where('user_id', $userId)->where('ingredient_id', $id)->first();

        if ($userIngredient) {
            $userIngredient->delete();
        }

        return redirect()->route('userPanel')->with('success', 'Składnik został usunięty z preferencji.');
    }

    private function getAvailableIngredients($user, $allIngredients)
    {
        $userIngredients = $user->ingredientPreferences;
        $availableIngredients = $allIngredients->diff($userIngredients);

        return $availableIngredients;
    }

}
