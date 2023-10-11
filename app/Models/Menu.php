<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	protected $table = 'menu';

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

	public function menuMeals()
	{
        return $this->hasMany(MenuMeal::class);
	}

    protected $appends = ['user_email', 'user_name', 'user_lastName',];

    public function getUserEmailAttribute(){
        return $this->user->email;
    }

    public function getUserNameAttribute(){
        return $this->user->name;
    }

    public function getUserLastNameAttribute(){
        return $this->user->lastName;
    }
}
