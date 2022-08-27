<?php

namespace App\Http\Controllers\Backend\Student\Attentances;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Repository\Interface\ClassRoomRepositoryInterface;
use App\Http\Repository\Interface\GradeRepositoryInterface;
use App\Http\Repository\Interface\SectionRepositoryInterface;
use App\Http\Repository\Interface\TeacherRepositoryInterface;
use App\Models\Attentance;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class AttentanceStudentController extends Controller
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

        return Inertia::render('Attentances/Index',[
            'sections' => $sections,
            'grades' => $grades,
            'classRom' => $classRom,
            'teachers' => $teachers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arr = $request->attentance;
        $attentance = array_filter($arr, fn($value) => !is_null($value) && $value !== '');

        foreach ($attentance as $student_id => $attent){
            if ($attent == "1") {
                $status = true;
            }else if ($attent == "0") {
                $status = false;
            }

            Attentance::create([
                'student_id' => $student_id,
                'grade_id' => $request->grade_id,
                'class_room_id' => $request->class_room_id,
                'section_id' => $request->section_id,
                'teacher_id' => 1,
                'date' => Carbon::now(),
                'attentance_status' => $status,
            ]);


        }
        return back()->with(['message' => 'تم بنجاح']);

    }


    public function show($id,Request $request)
    {
        $students = Student::with('attentance','grade','class_room','section')
                        ->whereSection_id($id)->when($request->search, function ($quary, $search) {
                $quary->where('name', 'LIKE', '%' . $search . '%');
                })->paginate(10);


        return Inertia::render('Attentances/Show', [
            'students' => $students,
            'id' => $id,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
