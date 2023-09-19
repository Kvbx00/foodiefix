<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    protected $table = "diseases";

    protected $fillable = [
        'name',
    ];

    public function userDiseases()
    {
        return $this->hasMany(UserDisease::class, 'diseases_id');
    }

    public $timestamps = false;
}
