<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HealthData;
use Carbon\Carbon;

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

        return view('user.userPanel', compact('lastValues'));
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
}
