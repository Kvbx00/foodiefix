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
        return $this->belongsTo(User::class, 'user_id');
    }

    public function disease()
    {
        return $this->belongsTo(Disease::class, 'diseases_id');
    }

    protected $appends = ['user_email', 'user_name', 'user_lastName', 'disease_name'];

    public function getUserEmailAttribute()
    {
        return $this->user->email;
    }

    public function getUserNameAttribute()
    {
        return $this->user->name;
    }

    public function getUserLastNameAttribute()
    {
        return $this->user->lastName;
    }

    public function getDiseaseNameAttribute()
    {
        return $this->disease->name;
    }

    public $timestamps = false;
}
