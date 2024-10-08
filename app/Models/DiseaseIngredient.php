<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiseaseIngredient extends Model
{
    protected $table = "diseases_ingredient";

    protected $fillable = [
        'diseases_id', 'ingredient_id', 'ingredient_category_id',
    ];

    public function disease()
    {
        return $this->belongsTo(Disease::class, 'diseases_id');
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class, 'ingredient_id');
    }

    public function ingredientCategory()
    {
        return $this->belongsTo(IngredientCategory::class, 'ingredient_category_id');
    }

    protected $appends = ['disease_name', 'ingredient_name'];

    public function getDiseaseNameAttribute()
    {
        return $this->disease->name;
    }

    public function getIngredientNameAttribute()
    {
        return $this->ingredient->name;
    }

    public $timestamps = false;
}
