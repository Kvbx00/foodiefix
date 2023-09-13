<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $table = "ingredient";

    protected $fillable = [
        'name',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(IngredientCategory::class, 'category_id', 'id');
    }

    public function preferences()
    {
        return $this->hasMany(IngredientPreference::class, 'ingredient_id', 'id');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'ingredient_preferences', 'ingredient_id', 'user_id');
    }

    public $timestamps = false;
}
