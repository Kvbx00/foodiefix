<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\MealCategory;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function showMealView($id)
    {
        $meal = Meal::find($id);

        return view('user.meal', compact('meal'));
    }

    public function showRecipesView(Request $request)
    {
        $search = request('search');
        $selectedCategory = $request->get('category');

        $categories = MealCategory::all();

        $meal = Meal::orderBy('id');

        if($search) {
            $meal->where(function ($query) use ($search){
                $query->where('name', 'like', '%' . $search . '%');
            });
        }

        if ($selectedCategory) {
            $meal->where('meal_category_id', $selectedCategory);
        }

        $meal = $meal->paginate(21);

        $meal->appends(['search' => $search, 'category' => $selectedCategory]);

        return view('recipes', compact('meal', 'search', 'categories', 'selectedCategory'));
    }

    public function showRecipesMeal($id)
    {
        $meal = Meal::find($id);

        return view('user.meal', compact('meal'));
    }
}
