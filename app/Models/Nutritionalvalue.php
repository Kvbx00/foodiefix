<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nutritionalvalue extends Model
{
	protected $table = 'nutritionalvalues';
	public $timestamps = false;

	protected $casts = [
		'calories' => 'float',
		'protein' => 'float',
		'fats' => 'float',
		'carbohydrates' => 'float',
		'meal_id' => 'int'
	];

	protected $fillable = [
		'calories',
		'protein',
		'fats',
		'carbohydrates'
	];

	public function meal()
	{
		return $this->belongsTo(Meal::class);
	}

    protected $appends = ['meal_name'];

    public function getMealNameAttribute(){
        return $this->meal->name;
    }
}
