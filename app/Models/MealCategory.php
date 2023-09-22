<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class MealCategory extends Model
{
	protected $table = 'meal_category';
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function meals()
	{
		return $this->hasMany(Meal::class);
	}
}
