<?php

namespace App\Http\Controllers\Backend\Subjects;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Grade;
use App\Models\ClassRooms;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\Subject;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams          = Exam::with('teacher','grade','class_room','section','subject')->get();
        $subjects       = Subject::all();
        $grades         = Grade::all();
        $class_room     = ClassRooms::all();
        $teachers       = Teacher::all();
        $sections       = Section::all();

        return Inertia::render('Subjects/Exams/Index',[
            'exams' => $exams,
            'subjects'  => $subjects,
            'grades'    => $grades,
            'classRom'  => $class_room,
            'teachers'  => $teachers,
            'sections'  => $sections,
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
        $exam = new Exam();
        $exam -> name           = $request -> name;
        $exam -> subject_id     = $request -> subject_id;
        $exam -> grade_id       = $request -> grade_id;
        $exam -> class_room_id  = $request -> class_room_id;
        $exam -> section_id     = $request -> section_id;
        $exam -> teacher_id     = $request -> teacher_id;
        $exam -> save();
        return redirect()->route('exam.index')->with(['message' => 'تم الحفظ بنجاح']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exam          = Exam::with('teacher','grade','class_room','section','subject')->findOrFail($id);
        $subjects       = Subject::all();
        $grades         = Grade::all();
        $class_room     = ClassRooms::all();
        $teachers       = Teacher::all();
        $sections       = Section::all();

        return Inertia::render('Subjects/Exams/Edit',[
            'exam' => $exam,
            'subjects'  => $subjects,
            'grades'    => $grades,
            'classRom'  => $class_room,
            'teachers'  => $teachers,
            'sections'  => $sections,
        ]);
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
        $exam = Exam::findOrFail($id);
        $exam -> name           = $request -> name;
        $exam -> subject_id     = $request -> subject_id;
        $exam -> grade_id       = $request -> grade_id;
        $exam -> class_room_id  = $request -> class_room_id;
        $exam -> section_id     = $request -> section_id;
        $exam -> teacher_id     = $request -> teacher_id;
        $exam -> save();
        return redirect()->route('exam.index')->with(['message' => 'تم التعديل بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Exam::destroy($id);
        return back()->with(['message' => 'تم الحذف بنجاح']);
    }
}
