<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function showMealView($id)
    {
        $meal = Meal::find($id);

        return view('user.meal', compact('meal'));
    }
}
