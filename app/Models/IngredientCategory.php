<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class IngredientCategory extends Model
{
	protected $table = 'ingredient_category';
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function ingredients()
	{
		return $this->hasMany(Ingredient::class, 'category_id');
	}
}
