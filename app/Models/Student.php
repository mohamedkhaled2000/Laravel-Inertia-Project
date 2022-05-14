<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function grade(){
       return $this->belongsTo(Grade::class,'grade_id','id');
    }


    public function class_room(){
       return $this->belongsTo(ClassRooms::class,'class_room_id','id');
    }

    public function section(){
       return $this->belongsTo(Section::class,'section_id','id');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

}
