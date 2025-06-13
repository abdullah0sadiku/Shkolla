<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Klasat extends Model
{
    protected $fillable = ['name'];
    protected $table = 'klasat';
    
    // Each class can have one teacher
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // Each class can have many students
    public function students()
    {
        return $this->hasMany(User::class, 'class_id');
    }
    
    public function activeSession()
    {
        return $this->hasOne(ActiveSession::class, 'class_id')->where('is_active', true);
    }

}
