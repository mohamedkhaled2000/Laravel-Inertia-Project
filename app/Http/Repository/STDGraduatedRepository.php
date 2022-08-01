<?php

namespace App\Http\Repository;

use App\Http\Repository\Interface\STDGraduatedRepositoryInterface;
use App\Models\ClassRooms;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use Inertia\Inertia;

class STDGraduatedRepository implements STDGraduatedRepositoryInterface{

    public function __construct()
    {
    }

    public function  getAllGraduated(){
        $students = Student::with('grade','class_room','section')->onlyTrashed()->get();
        return Inertia::render('Graduated/IndexGrad',[
            'students' => $students
        ]);
    }

    public function create()
    {
        $grades      = Grade::all();
        $class_rooms = ClassRooms::all();
        $sections    = Section::all();

        return Inertia::render('Graduated/AddGrad',[
            'grades'        => $grades,
            'class_rooms'   => $class_rooms,
            'sections'      => $sections,
        ]);
    }
    public function store($request)
    {

        $students = Student::whereGrade_id($request->grade_id)
                            ->whereClass_room_id($request->class_room_id)
                            ->whereSection_id($request->section_id)
                            ->get();
        if($students->count() > 0 ){
            foreach($students as $student){
                $ids = explode(',',$student->id);
                Student::whereIn('id',$ids)->Delete();
            }
            return redirect()->route('graduated.index')->with(['success' => 'تم ترقية الطلاب بنجاح']);
        }else{
            return back()->with(['error' => 'لا توجد بيانات']);
        }
    }

    public function update($id)
    {
        Student::onlyTrashed()->whereId($id)->first()->restore();
        return back()->with(['success' => 'تم استرجاع الطلاب بنجاح']);
    }


    public function delete($id)
    {
        Student::onlyTrashed()->whereId($id)->first()->forceDelete();
        return back()->with(['success' => 'تم حذف الطلاب بنجاح']);
    }


}
