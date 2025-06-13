<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['user_id', 'class_id', 'date', 'new_memorization', 'revision', 'tajweed', 'total'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function class()
    {
        return $this->belongsTo(Klasat::class);
    }
}
