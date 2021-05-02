<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public $guarded = [];


    public function teacher(){
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    public function students(){
        return $this->belongsToMany(User::class,'room_user','room_id','user_id');
    }

    public function lessons(){
        return $this->hasMany(Lesson::class);
    }

    public function marks(){
        return $this->hasMany(Mark::class);
    }
}
