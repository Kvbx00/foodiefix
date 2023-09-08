<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HealthData;
use Carbon\Carbon;

class HealthDataController extends Controller
{
    public function showForm()
    {
        $lastRecord = HealthData::where('user_id', auth()->id())
            ->latest('date')
            ->first();

        $lastWeight = $lastRecord ? $lastRecord->weight : null;

        session(['lastWeight' => $lastWeight]);

        return view('user.userPanel', ['lastWeight' => $lastWeight]);
    }

    public function storeMeasurements(Request $request)
    {
        $lastWeight = session('lastWeight');

        $existingRecord = HealthData::where('user_id', auth()->id())
            ->whereDate('date', Carbon::today())
            ->first();

        if ($existingRecord) {
            $existingRecord->update($request->all());
        } else {
            $defaultWeight = $request->input('weight', $lastWeight);

            HealthData::create([
                'user_id' => auth()->id(),
                'date' => Carbon::today(),
                'weight' => $defaultWeight,
                'diastolicbloodpressure' => $request->input('diastolicbloodpressure'),
                'systolicbloodpressure' => $request->input('systolicbloodpressure'),
                'pulse' => $request->input('pulse'),
            ]);
        }
        return redirect()->back()->with('success', 'Dane zostały zapisane.');
    }
}
