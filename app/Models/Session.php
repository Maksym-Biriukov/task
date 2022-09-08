<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'sesions';   

    protected $fillable = [
        'id_manager',
        'cash_total',
        'card_total',
        'date_end',
    ];
}
