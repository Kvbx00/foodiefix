<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDisease extends Model
{
    protected $table = "user_diseases";

    protected $fillable = [
        'user_id',
        'diseases_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function disease()
    {
        return $this->belongsTo(Disease::class);
    }

    public $timestamps = false;
}
