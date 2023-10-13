<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuMeal extends Model
{
	protected $table = 'menu_meal';
	public $timestamps = false;

	protected $casts = [
		'menu_id' => 'int',
		'meal_id' => 'int',
		'meal_meal_category_id' => 'int'
	];

	public function meal()
	{
		return $this->belongsTo(Meal::class,  'meal_id', 'id');
	}

	public function menu()
	{
		return $this->belongsTo(Menu::class);
	}

    public function mealCategory()
    {
        return $this->belongsTo(MealCategory::class, 'meal_meal_category_id');
    }

    protected $appends = ['mealCategory_name', 'meal_name'];

    public function getMealCategoryNameAttribute()
    {
        return $this->mealCategory->name;
    }

    public function getMealNameAttribute()
    {
        return $this->meal->name;
    }
}
