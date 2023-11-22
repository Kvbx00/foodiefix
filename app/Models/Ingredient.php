<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
	protected $table = 'ingredient';
	public $timestamps = false;

	protected $casts = [
		'category_id' => 'int'
	];

	protected $fillable = [
		'name'
	];

	public function ingredient_category()
	{
		return $this->belongsTo(IngredientCategory::class, 'category_id');
	}

	public function ingredient_preferences()
	{
		return $this->hasMany(IngredientPreference::class);
	}

	public function meals()
	{
		return $this->belongsToMany(Meal::class, 'meal_ingredient')
					->withPivot('quantity', 'unit');
	}

    public function diseases()
    {
        return $this->belongsToMany(Disease::class, 'diseases_ingredient', 'ingredient_id', 'diseases_id')
            ->withPivot('ingredient_category_id');
    }

    protected $appends = ['ingredient_category_name',];

    public function getIngredientCategoryNameAttribute()
    {
        return $this->ingredient_category->name;
    }
}
