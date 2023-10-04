<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
	protected $table = 'meal';
	public $timestamps = false;

	protected $casts = [
		'meal_category_id' => 'int'
	];

	protected $fillable = [
		'name',
		'recipe'
	];

	public function meal_category()
	{
		return $this->belongsTo(MealCategory::class);
	}

	public function ingredients()
	{
		return $this->belongsToMany(Ingredient::class, 'meal_ingredient')
					->withPivot('quantity', 'unit');
	}

	public function menus()
	{
		return $this->belongsToMany(Menu::class, 'menu_meal')
					->withPivot('id', 'meal_meal_category_id');
	}

	public function nutritionalvalues()
	{
		return $this->hasOne(Nutritionalvalue::class);
	}

    public function menuMeals()
    {
        return $this->hasMany(MenuMeal::class, 'meal_id', 'id');
    }

    protected $appends = ['meal_category_name',];

    public function getMealCategoryNameAttribute()
    {
        return $this->meal_category->name;
    }
}
