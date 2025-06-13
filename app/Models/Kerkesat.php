<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kerkesat extends Model
{
    protected $fillable = ['name' , 'email' , 'phone' , 'status'];
    protected $table = 'kerkesat';
}
