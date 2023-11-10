<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Menu;
use App\Models\MenuMeal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        $menuDates = $menus->pluck('date');

        $menuCheck = Menu::where('user_id', $user->id)->exists();

        return view('user.menu', compact('groupedMenuMeals', 'daysOfWeek', 'menuDates', 'menuCheck'));
    }

    public function createMenu()
    {
        $user = auth()->user();

        $existingMenu = Menu::where('user_id', $user->id)
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->first();

        if ($existingMenu) {
            return redirect()->route('menu.show')->with('error', 'Masz już utworzone menu na ten tydzień.');
        }

        Menu::where('user_id', $user->id)
            ->whereBetween('created_at', [now()->startOfWeek()->subWeek(), now()->endOfWeek()->subWeek()])
            ->get()
            ->each(function ($menu){
                $menu->menuMeals()->delete();
                $menu->delete();
            });

        Meal::where('used', 1)->update(['used' => 0]);

        $caloricNeeds = $user->caloric_needs()->first();
        $caloricNeedsValue = $caloricNeeds->caloricNeeds;

        $startDate = now()->startOfWeek();

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

        foreach ($daysOfWeek as $index => $day) {
            $tries = 0;

            $currentDate = $startDate->copy()->addDays($index);

            while ($tries < $maxTries) {
                $mealsByCategory = Meal::whereDoesntHave('ingredients', function ($query) use ($user) {
                    $query->whereIn('ingredient_id', $user->ingredient_preferences->pluck('ingredient_id'));
                })
                    ->where('used', 0)
                    ->inRandomOrder()
                    ->get()
                    ->groupBy('meal_category_id');

                $selectedMeals = collect();

                foreach ($mealsByCategory as $categoryMeals) {
                    $selectedMeals = $selectedMeals->merge($categoryMeals->take(1));
                }

                $totalCalories = $selectedMeals->sum(function ($meal) {
                    return $meal->nutritionalvalues->calories;
                });

                if (abs($totalCalories - $caloricNeedsValue) <= $caloricNeedsValue * 0.05) {
                    $menu = new Menu();
                    $menu->date = $currentDate;
                    $menu->dayOfTheWeek = $day;
                    $menu->user_id = $user->id;
                    $menu->save();

                    foreach ($selectedMeals as $meal) {
                        $menuMeal = new MenuMeal();
                        $menuMeal->menu_id = $menu->id;
                        $menuMeal->meal_id = $meal->id;
                        $menuMeal->meal_meal_category_id = $meal->meal_category_id;
                        $menuMeal->used = 1;
                        $menuMeal->save();

                        $meal->used = 1;
                        $meal->save();
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
