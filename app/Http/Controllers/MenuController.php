<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Menu;
use App\Models\MenuMeal;
use App\Models\ShoppingList;

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
        }

        $menuDates = $menus->pluck('date');

        $menuCheck = Menu::where('user_id', $user->id)->exists();

        $menuCheckWeek = Menu::where('user_id', $user->id)
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->exists();

        return view('user.menu', compact('groupedMenuMeals', 'daysOfWeek', 'menuDates', 'menuCheck', 'menuCheckWeek'));
    }

    public function createMenu()
    {
        $user = auth()->user();

        $userDiseases = $user->userDiseases()->pluck('diseases_id');
        $userIngredientPreferences = $user->ingredient_preferences()->pluck('ingredient_id');

        $existingMenu = Menu::where('user_id', $user->id)
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->first();

        if ($existingMenu) {
            return back()->withErrors('Masz już utworzone menu na ten tydzień.');
        }

        Menu::where('user_id', $user->id)
            ->where('created_at', '<', now()->startOfWeek())
            ->get()
            ->each(function ($menu) {
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
                $mealsByCategory = Meal::whereDoesntHave('ingredients', function ($query) use ($userDiseases, $userIngredientPreferences) {
                    $query->where(function ($query) use ($userDiseases, $userIngredientPreferences) {
                        $query->whereIn('ingredient_id', function ($query) use ($userDiseases) {
                            $query->select('ingredient_id')
                                ->from('diseases_ingredient')
                                ->whereIn('diseases_id', $userDiseases);
                        })
                            ->orWhereIn('ingredient_id', $userIngredientPreferences);
                    });
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

                        foreach ($meal->mealIngredients as $mealIngredient) {
                            $existingItem = ShoppingList::where([
                                'user_id' => $user->id,
                                'ingredient_name' => $mealIngredient->ingredient_name,
                            ])->first();

                            if ($existingItem) {
                                $existingItem->quantity += $mealIngredient->quantity;
                                $existingItem->save();
                            } else {
                                $shoppingListItem = new ShoppingList();
                                $shoppingListItem->user_id = $user->id;
                                $shoppingListItem->ingredient_name = $mealIngredient->ingredient_name;
                                $shoppingListItem->quantity = $mealIngredient->quantity;
                                $shoppingListItem->unit = $mealIngredient->unit;
                                $shoppingListItem->save();
                            }
                        }
                    }
                    break;
                }
                $tries++;
            }
        }
        return redirect()->route('menu.show');
    }
}
