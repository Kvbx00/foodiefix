<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthData extends Model
{
    use HasFactory;

    protected $table = "health_data";

    protected $fillable = [
        'weight',
        'diastolicbloodpressure',
        'systolicbloodpressure',
        'pulse',
        'date',
        'user_id',
    ];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
