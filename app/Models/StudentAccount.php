<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAccount extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function student(){
        return $this->belongsTo(Student::class,'student_id');
    }

    public function grade(){
        return $this->belongsTo(Grade::class,'grade_id');
    }

    public function class_room(){
        return $this->belongsTo(ClassRooms::class,'class_room_id');
    }
    
    public function fee(){
        return $this->belongsTo(Fees::class,'debit','id');
    }

}
