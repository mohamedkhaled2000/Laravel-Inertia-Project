<?php

namespace App\Http\Controllers\Backend\Sections;

use App\Http\Controllers\Controller;
use App\Http\Repository\Interface\ClassRoomRepositoryInterface;
use App\Http\Repository\Interface\GradeRepositoryInterface;
use App\Http\Repository\Interface\SectionRepositoryInterface;
use App\Http\Repository\Interface\TeacherRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SectionController extends Controller
{
    protected $section;
    protected $grade;
    protected $classRom;
    protected $teacher;
    public function __construct(SectionRepositoryInterface $section,
                                GradeRepositoryInterface $grade,
                                ClassRoomRepositoryInterface $classRom,
                                TeacherRepositoryInterface $teacher)
    {
        $this->section = $section;
        $this->grade = $grade;
        $this->classRom = $classRom;
        $this->teacher = $teacher;
    }


    public function index(){
        $sections = $this->section->getAllSection();
        $grades = $this->grade->getAllGrade();
        $classRom = $this->classRom->getAllClassRoom();
        $teachers = $this->teacher->getTeacher();

        return Inertia::render('Section/SectionView',[
            'sections' => $sections,
            'grades' => $grades,
            'classRom' => $classRom,
            'teachers' => $teachers,
        ]);
    }

    public function store(Request $request){

        $request->validate([
            'section_name' => 'required',
            'grade_id' => 'required',
            'class_room_id' => 'required',
            'teacher_id' => 'required',
        ],[
            'section_name.required' => 'هذا الحقل مطلوب',
            'grade_id.required' => 'هذا الحقل مطلوب',
            'class_room_id.required' => 'هذا الحقل مطلوب',
            'teacher_id.required' => 'هذا الحقل مطلوب',
        ]);
        $this->section->storeSection($request);

        return redirect()->back()->with(['message' => 'تم اضافة القسم بنجاح']);

    }

    public function edit($id){
        $section = $this->section->editSection($id);
        $grades = $this->grade->getAllGrade();
        $classRom = $this->classRom->getAllClassRoom();
        $teachers = $this->teacher->getTeacher();


        return Inertia::render('Section/SectionEdit',[
            'section' =>$section,
            'grades' => $grades,
            'classRom' => $classRom,
            'teachers' => $teachers,

        ]);
    }

    public function update(Request $request,$id){

        $request->validate([
            'section_name' => 'required',
            'grade_id' => 'required',
            'class_room_id' => 'required',
        ],[
            'section_name.required' => 'هذا الحقل مطلوب',
            'grade_id.required' => 'هذا الحقل مطلوب',
            'class_room_id.required' => 'هذا الحقل مطلوب',
        ]);
        $this->section->updateSection($request,$id);

        return redirect()->route('section.index')->with(['message' => 'تم تعديل القسم بنجاح']);



    }

    public function destroy($id){
        $this->section->deleteSection($id);
        return redirect()->back()->with(['message' => 'تم حذف القسم بنجاح']);
    }

}
