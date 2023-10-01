<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	protected $table = 'menu';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime',
		'user_id' => 'int'
	];

	protected $fillable = [
		'date',
		'dayOfTheWeek'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function meals()
	{
		return $this->belongsToMany(Meal::class, 'menu_meal')
					->withPivot('id', 'meal_meal_category_id');
	}
}
