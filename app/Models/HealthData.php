<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthData extends Model
{
    protected $table = "health_data";

    protected $fillable = [
        'weight',
        'diastolicBloodPressure',
        'systolicBloodPressure',
        'pulse',
        'date',
        'user_id',
    ];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
