<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrator extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'admin';
    protected $table = "administrator";

    protected $fillable = [
        'email',
        'password',
    ];

    public $timestamps = false;

}
