<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActiveSession extends Model
{

    protected $fillable = [
        'class_id',     
        'teacher_id',   
        'started_at',   
        'is_active',
    ];
    public function class()
    {
        return $this->belongsTo(Klasat::class, 'class_id');
    }
    
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function participants()
    {
        return $this->hasMany(MeetingParticipant::class, 'meeting_id');
    }

}
