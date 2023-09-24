<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealIngredient extends Model
{
	protected $table = 'meal_ingredient';
	public $timestamps = false;

	protected $casts = [
		'quantity' => 'float',
		'meal_id' => 'int',
		'ingredient_id' => 'int'
	];

	protected $fillable = [
		'quantity',
		'unit',
		'meal_id',
		'ingredient_id'
	];

	public function ingredient()
	{
		return $this->belongsTo(Ingredient::class);
	}

	public function meal()
	{
		return $this->belongsTo(Meal::class);
	}

    protected $appends = ['meal_name', 'ingredient_name'];

    public function getMealNameAttribute(){
        return $this->meal->name;
    }

    public function getIngredientNameAttribute(){
        return $this->ingredient->name;
    }
}
