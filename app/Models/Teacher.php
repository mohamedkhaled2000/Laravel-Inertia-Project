<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function specialize(){
        return $this->belongsTo(Speicalize::class,'speicalize_id','id');
    }

    public function sections(){
        return $this->belongsToMany(Section::class,'teacher_section');
    }

}
