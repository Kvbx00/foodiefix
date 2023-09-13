<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientCategory extends Model
{
    protected $table = "ingredient_category";

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;
}
