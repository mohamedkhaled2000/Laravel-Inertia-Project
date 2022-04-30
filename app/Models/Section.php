<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function section_grade(){
        return $this->belongsTo(Grade::class,'grade_id','id')->orderByDesc('id');
    }


    public function section_room(){
        return $this->belongsTo(ClassRooms::class,'class_room_id','id')->orderByDesc('id');
    }
}
