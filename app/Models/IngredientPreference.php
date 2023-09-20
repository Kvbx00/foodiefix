<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IngredientPreference extends Model
{
    protected $table = "ingredient_preferences";

    protected $fillable = [
        'ingredient_id',
        'ingredient_category_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class, 'ingredient_id', 'id');
    }

    public function ingredientCategory()
    {
        return $this->belongsTo(IngredientCategory::class, 'ingredient_category_id', 'id');
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

    public function getIngredientNameAttribute(){
        return $this->ingredient->name;
    }

    public $timestamps = false;
}
