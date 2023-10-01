<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\MealCategory;
use App\Models\Menu;
use App\Models\MenuMeal;
use Carbon\Carbon;

class MenuController extends Controller
{
    public function showMenu()
    {
        $user = auth()->user();
        $allMenu = Menu::where('user_id', $user->id)->get();

        return view('user.menu', compact('allMenu', 'user'));
    }

    public function createMenu()
    {
        $user = auth()->user();

        $existingMenu = Menu::where('user_id', $user->id)
            ->whereDate('date', '>=', Carbon::now()->startOfWeek())
            ->whereDate('date', '<=', Carbon::now()->endOfWeek())
            ->first();

        if (!$existingMenu) {
            Menu::where('user_id', $user->id)
                ->get()
                ->each(function ($menu) {
                    $menu->menuMeals()->delete();
                    $menu->delete();
                });

            $englishToPolishDays = [
                'Monday' => 'Poniedziałek',
                'Tuesday' => 'Wtorek',
                'Wednesday' => 'Środa',
                'Thursday' => 'Czwartek',
                'Friday' => 'Piątek',
                'Saturday' => 'Sobota',
                'Sunday' => 'Niedziela',
            ];

            foreach ($englishToPolishDays as $englishDay => $polishDay) {
                $currentDate = Carbon::now()->startOfWeek();

                while ($currentDate->englishDayOfWeek != $englishDay) {
                    $currentDate->addDay();
                }

                $menu = new Menu();
                $menu->date = $currentDate;
                $menu->dayOfTheWeek = $polishDay;
                $menu->user_id = $user->id;
                $menu->save();

                $categories = MealCategory::all();

                foreach ($categories as $category) {
                    $meal = Meal::where('meal_category_id', $category->id)->inRandomOrder()->first();

                    $menuMeal = new MenuMeal();
                    $menuMeal->menu_id = $menu->id;
                    $menuMeal->meal_id = $meal->id;
                    $menuMeal->meal_meal_category_id = $category->id;
                    $menuMeal->save();
                }
            }
        }

        return redirect()->route('menu.show');
    }
}
