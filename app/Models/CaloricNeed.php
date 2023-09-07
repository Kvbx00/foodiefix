<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaloricNeed extends Model
{
    use HasFactory;

    protected $table = 'caloric_needs';

    protected $fillable = [
        'caloricneeds',
        'date',
        'user_id',
    ];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
