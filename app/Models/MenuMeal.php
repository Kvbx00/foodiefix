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

    protected $appends = ['mealCategory_name'];

    public function getMealCategoryNameAttribute()
    {
        return $this->mealCategory->name;
    }
}
