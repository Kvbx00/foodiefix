<?php

namespace App\Http\Controllers;

use App\Models\CaloricNeed;
use App\Models\Meal;
use App\Models\MealCategory;
use App\Models\Menu;
use App\Models\MenuMeal;
use App\Models\Nutritionalvalue;
use Carbon\Carbon;

class MenuController extends Controller
{
    public function showMenu()
    {
        $user = auth()->user();
        $daysOfWeek = [
            'Poniedziałek',
            'Wtorek',
            'Środa',
            'Czwartek',
            'Piątek',
            'Sobota',
            'Niedziela'
        ];

        $menus = Menu::where('user_id', $user->id)->whereIn('dayOfTheWeek', $daysOfWeek)->get();

        $menuMeals = MenuMeal::whereIn('menu_id', $menus->pluck('id'))->with('meal')->get();

        $groupedMenuMeals = $menuMeals->groupBy('menu.dayOfTheWeek');

        return view('user.menu', compact('groupedMenuMeals', 'user'));
    }

    public function createMenu()
    {
        $user = auth()->user();

        $caloricNeeds = $user->caloric_needs()->first();

        $caloricNeedsValue = $caloricNeeds->caloricNeeds;

        $maxTries = 100;
        $tries = 0;
        $menu = null;

        while ($tries < $maxTries) {
            $meals = Meal::inRandomOrder()->limit(5)->get();

            $totalCalories = $meals->sum(function ($meal) {
                return $meal->nutritionalvalues->calories;
            });

            if (abs($totalCalories - $caloricNeedsValue) <= $caloricNeedsValue * 0.1) {
                $menu = new Menu();
                $menu->date = now();
                $menu->user_id = $user->id;
                $menu->save();

                foreach ($meals as $meal) {
                    $menuMeal = new MenuMeal();
                    $menuMeal->menu_id = $menu->id;
                    $menuMeal->meal_id = $meal->id;
                    $menuMeal->meal_meal_category_id = $meal->meal_category_id;
                    $menuMeal->save();
                }

                break;
            }

            $tries++;
        }

        if (!$menu) {
            return response()->json(['error' => 'Nie udało się utworzyć odpowiedniego menu.'], 500);
        }

        return response()->json(['success' => 'Menu zostało utworzone pomyślnie.']);
    }
}
