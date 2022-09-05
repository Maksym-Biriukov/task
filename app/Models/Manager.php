<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Manager extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    protected $table = 'managers';   

    protected $fillable = [
        'login',
        'password'
    ];

    protected $hidden = [
    ];

    protected $guarded = [];
}
