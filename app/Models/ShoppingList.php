<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    protected $table = 'shopping_list';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'ingredient_name',
        'quantity',
        'unit',
        'checked',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
