<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\Interface\ParentRepositoryInterface;
use App\Http\Repository\Interface\StudentRepositoryInterface;
use App\Http\Requests\StudentRequest;
use App\Models\Student;
use Inertia\Inertia;

class StudentController extends Controller
{

    protected $Student;
    public function __construct(StudentRepositoryInterface $Student)
    {
        $this->Student = $Student;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Student/ShowStudent', [
            'students' => Student::with('grade','class_room','section')->when($request->search, function ($quary, $search) {
                $quary->where('name', 'LIKE', '%' . $search . '%');
            })->paginate(10)

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->Student->addStudent();
        return Inertia::render('Student/AddStudent',[
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        return $this->Student->storeStudent($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       return $this->Student->viewStudent($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = $this->Student->editStudent($id);
        $data = $this->Student->addStudent();

        return Inertia::render('Student/EditStudent',[
            'data' => $data,
            'student' => $student
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
        $this->Student->updateStudent($request,$id);
        return redirect()->route('student.index')->with(['message' => 'تم تعديل الطالب بنجاح']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->Student->deleteStudent($id);
        return redirect()->back()->with(['message' => 'تم حذف الطالب بنجاح']);
    }


    public function upload_new(Request $request)
    {
        $this->Student->upload_att($request);
        return redirect()->back()->with(['message' => 'تم اضافة المرفقات بنجاح']);
    }


    public function downloadAtt($stdName,$file)
    {
        return $this->Student->download_att($stdName,$file);
    }

    public function deleteAtt($id)
    {
        return $this->Student->delete_att($id);
    }

}
