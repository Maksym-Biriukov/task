<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    public $timestamps = true;
    protected $table = 'orders';
    protected $fillable = ['id_session', 'type', 'total', 'created_at', 'updated_at'];
}
