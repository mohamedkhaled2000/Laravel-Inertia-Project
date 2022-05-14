<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Repository\Interface\TeacherRepositoryInterface;
use App\Http\Requests\TeacherRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeacherController extends Controller
{

    protected $teacher;
    public function __construct(TeacherRepositoryInterface $teacher)
    {
        return $this->teacher = $teacher;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = $this->teacher->getAllTeacher();

        return Inertia::render('Teacher/TeacherView',[
            'teachers' => $teachers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $spicalizes = $this->teacher->getAllSpicalizes();

        return Inertia::render('Teacher/TeacherAdd',[
            'spicalizes' => $spicalizes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherRequest $request)
    {
        $request->validated();
        $this->teacher->storeTeacher($request);
        return redirect()->route('teacher.index')->with(['message' => 'تم اضافة المدرس بنجاح']);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $spicalizes = $this->teacher->getAllSpicalizes();

        $teacher = $this->teacher->editTeacher($id);
        return Inertia::render('Teacher/TeacherEdit',[
            'spicalizes' => $spicalizes,
            'teacher' => $teacher,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherRequest $request, $id)
    {
        $request->validated();
        $this->teacher->updateTeacher($request,$id);
        return redirect()->route('teacher.index')->with(['message' => 'تم تعديل المدرس بنجاح']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->teacher->deleteTeacher($id);
        return redirect()->route('teacher.index')->with(['message' => 'تم حذف المدرس بنجاح']);

    }
}
