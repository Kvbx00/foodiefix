<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "user";

    protected $fillable = [
        'name',
        'lastName',
        'gender',
        'height',
        'weight',
        'email',
        'age',
        'physicalActivity',
        'goal',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function caloric_needs()
    {
        return $this->hasMany(CaloricNeed::class);
    }

    public function health_data()
    {
        return $this->hasMany(HealthData::class);
    }

    public function ingredient_preferences()
    {
        return $this->hasMany(IngredientPreference::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function diseases()
    {
        return $this->belongsToMany(Disease::class, 'user_diseases', 'user_id', 'diseases_id')
                    ->withPivot('id');
    }

    public function ingredientPreferences()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_preferences', 'user_id', 'ingredient_id');
    }

    public function userDiseases()
    {
        return $this->hasMany(UserDisease::class, 'user_id');
    }
}
