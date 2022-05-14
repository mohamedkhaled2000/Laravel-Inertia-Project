<?php

namespace App\Http\Repository;

use App\Http\Repository\Interface\StudentRepositoryInterface;
use App\Models\ClassRooms;
use App\Models\Grade;
use App\Models\Nationality;
use App\Models\Parents;
use App\Models\Section;
use App\Models\Student;
use App\Models\TypeBlood;

class StudentRepository implements StudentRepositoryInterface{

    protected $Student;
    public function __construct(Student $Student)
    {
        $this->Student = $Student;
    }

    public function  getAllStudent(){
        return   $this->Student->with('grade','class_room','section')->latest()->paginate(10);
    }

    public function addStudent()
    {
        $data['nationality_id'] = Nationality::all();
        $data['type_blood_id'] = TypeBlood::all();
        $data['grade_id'] = Grade::all();
        $data['class_room_id'] = ClassRooms::all();
        $data['section_id'] = Section::all();
        $data['parent_id'] = Parents::all();
        return $data;
    }



    public function storeStudent($request)
    {
        $this->Student->create($request->all());
    }

    public function editStudent($id)
    {
       return $this->Student->findOrFail($id);
    }


    public function updateStudent($request, $id)
    {
        $this->Student->findOrFail($id)->update($request->all());
    }

    public function deleteStudent($id)
    {
        // $this->Student->findOrFail($id)->delete();
        $this->Student->destroy($id);
    }


}
