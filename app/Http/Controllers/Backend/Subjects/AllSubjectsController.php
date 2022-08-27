<?php

namespace App\Http\Controllers\Backend\Subjects;

use App\Http\Controllers\Controller;
use App\Models\ClassRooms;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AllSubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects   = Subject::with('teacher','grade','class_room')->get();
        $grades      = Grade::all();
        $class_room = ClassRooms::all();
        $teachers   = Teacher::all();
        return Inertia::render('Subjects/Index',[
            'subjects'  => $subjects,
            'grades'    => $grades,
            'classRom'  => $class_room,
            'teachers'  => $teachers,
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
        $subject = new Subject();
        $subject->name          = $request->name;
        $subject->grade_id      = $request->grade_id;
        $subject->class_room_id = $request->class_room_id;
        $subject->teacher_id    = $request->teacher_id;
        $subject->save();
        return back()->with(['message' => 'تم اضافة المادة بنجاح']);
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
        $subject        = Subject::with('teacher','grade','class_room')->findOrFail($id);
        $grades         = Grade::all();
        $class_room     = ClassRooms::all();
        $teachers       = Teacher::all();
        return Inertia::render('Subjects/Edit',[
            'subject'  => $subject,
            'grades'    => $grades,
            'classRom'  => $class_room,
            'teachers'  => $teachers,
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
        $subject = Subject::findOrFail($id);
        $subject->name          = $request->name;
        $subject->grade_id      = $request->grade_id;
        $subject->class_room_id = $request->class_room_id;
        $subject->teacher_id    = $request->teacher_id;
        $subject->save();
        return redirect()->route('subject.index')->with(['message' => 'تم تعديل المادة بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subject::destroy($id);
        return back()->with(['message' => 'تم حذف المادة بنجاح']);

    }
}
