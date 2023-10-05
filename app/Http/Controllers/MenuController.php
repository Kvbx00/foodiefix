<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Menu;
use App\Models\MenuMeal;

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

        $groupedMenuMeals = [];

        foreach ($daysOfWeek as $day) {
            $menuMeals = MenuMeal::whereIn('menu_id', $menus->pluck('id'))
                ->whereHas('menu', function ($query) use ($day) {
                    $query->where('dayOfTheWeek', $day);
                })
                ->orderBy('meal_meal_category_id', 'asc')
                ->with('meal')
                ->get();

            $groupedMenuMeals[$day] = $menuMeals;

            $groupedMenuMeals[$day]['totalCalories'] = $this->calculateTotalCalories($menuMeals);
        }

        return view('user.menu', compact('groupedMenuMeals', 'daysOfWeek'));
    }

    public function createMenu()
    {
        $user = auth()->user();
        $caloricNeeds = $user->caloric_needs()->first();
        $caloricNeedsValue = $caloricNeeds->caloricNeeds;

        $daysOfWeek = [
            'Poniedziałek',
            'Wtorek',
            'Środa',
            'Czwartek',
            'Piątek',
            'Sobota',
            'Niedziela'
        ];

        $maxTries = 500;

        foreach ($daysOfWeek as $day) {
            $tries = 0;

            while ($tries < $maxTries) {
                $mealsByCategory = Meal::inRandomOrder()->get()->groupBy('meal_category_id');

                $selectedMeals = collect();

                foreach ($mealsByCategory as $categoryMeals) {
                    $selectedMeals = $selectedMeals->merge($categoryMeals->take(1));
                }

                $totalCalories = $selectedMeals->sum(function ($meal) {
                    return $meal->nutritionalvalues->calories;
                });

                if (abs($totalCalories - $caloricNeedsValue) <= $caloricNeedsValue * 0.05) {
                    $menu = new Menu();
                    $menu->date = now();
                    $menu->dayOfTheWeek = $day;
                    $menu->user_id = $user->id;
                    $menu->save();

                    foreach ($selectedMeals as $meal) {
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
        }
        return redirect()->route('menu.show');
    }

    //funkcja do zliczania kalorii z danego dnia
    public function calculateTotalCalories($menuMeals)
    {
        $totalCalories = 0;

        foreach ($menuMeals as $menuMeal) {
            if (isset($menuMeal->meal)) {
                $totalCalories += $menuMeal->meal->nutritionalvalues->calories;
            }
        }

        return $totalCalories;
    }
}
