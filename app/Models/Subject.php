<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function teacher(){
        return $this->belongsTo(Teacher::class,'teacher_id');
    }

    public function grade(){
        return $this->belongsTo(Grade::class,'grade_id');
    }

    public function class_room(){
        return $this->belongsTo(ClassRooms::class,'class_room_id');
    }
}
