<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaloricNeed extends Model
{
    protected $table = 'caloric_needs';

    protected $fillable = [
        'caloricNeeds',
        'date',
        'user_id',
    ];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
