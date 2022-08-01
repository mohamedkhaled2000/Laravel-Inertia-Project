<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;
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
    public function parent(){
       return $this->belongsTo(Parents::class,'parent_id','id');
    }

    public function nationality(){
       return $this->belongsTo(Nationality::class,'nationality_id','id');
    }

    public function type_boold(){
       return $this->belongsTo(TypeBlood::class,'type_blood_id','id');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

}
