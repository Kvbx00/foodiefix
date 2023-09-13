<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HealthData;
use Carbon\Carbon;
use App\Models\UserDisease;
use App\Models\Disease;

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

        return view('user.userPanel', compact('lastValues', 'availableDiseases'));
    }

    public function storeMeasurements(Request $request)
    {
        $lastValues = session('lastValues');

        $dataToUpdate = $request->all();
        $dataToUpdate['user_id'] = auth()->id();
        $dataToUpdate['date'] = Carbon::today();

        $existingRecord = HealthData::where('user_id', auth()->id())
            ->whereDate('date', Carbon::today())
            ->first();

        if ($existingRecord) {
            $existingRecord->update($dataToUpdate);
        } else {
            foreach ($lastValues as $field => $value) {
                $dataToUpdate[$field] = $request->input($field, $value);
            }

            HealthData::create($dataToUpdate);
        }

        return redirect()->back()->with('success', 'Dane zostały zapisane.');
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
}
