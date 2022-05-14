<?php

namespace App\Http\Repository;

use App\Http\Repository\Interface\ClassRoomRepositoryInterface;
use App\Models\ClassRooms;

class ClassRoomRepository implements ClassRoomRepositoryInterface{

    protected $classRooms;
    public function __construct(ClassRooms $classRooms)
    {
        $this->classRooms = $classRooms;
    }

    public function  getAllClassRoom(){
        return $this->classRooms->with('grade')->orderBy('id','DESC')->get();
    }

    public function storeClassRoom($request)
    {
        $class = new ClassRooms();
        $class->class_name = $request->class_name;
        $class->grade_id = $request->grade_id;
        $class->save();
    }

    public function editClassRoom($id)
    {
       return $this->classRooms->findOrFail($id);
    }


    public function updateClassRoom($request, $id)
    {
        $class = $this->classRooms->findOrFail($id);
        $class->class_name = $request->class_name;
        $class->grade_id = $request->grade_id;
        $class->save();

    }

    public function deleteClassRoom($id)
    {
        $this->classRooms->findOrFail($id)->delete();
    }


}
