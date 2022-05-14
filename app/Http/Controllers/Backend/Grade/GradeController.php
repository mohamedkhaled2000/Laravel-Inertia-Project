<?php

namespace App\Http\Controllers\Backend\Grade;

use App\Http\Controllers\Controller;
use App\Http\Repository\Interface\GradeRepositoryInterface;
use App\Http\Requests\GradeRequest;
use App\Models\ClassRooms;
use Inertia\Inertia;

class GradeController extends Controller
{

    protected $grade;
    public function __construct(GradeRepositoryInterface $grade)
    {
        return $this->grade = $grade;

    }
    public function index(){
        $grades = $this->grade->getAllGrade();
        return Inertia::render('Grade/Grade',['grades' => $grades]);
    }

    public function add(){
        return Inertia::render('Grade/GradeAdd');
    }


    public function edit($id){
        $grades = $this->grade->editGrade($id);;
        return Inertia::render('Grade/GradeEdit',['grade' => $grades]);
    }

    public function store(GradeRequest $request){

        $request->validated();
        $this->grade->storeGrade($request);
        return redirect()->route('grade.index')->with(['message' => 'تم اضافة المرحلة بنجاح']);

    }

    public function destroy($id){
        $classes = ClassRooms::whereGrade_id($id)->pluck('grade_id');
        if($classes->count() == 0){
            $this->grade->deleteGrade($id);
            return redirect()->back()->with(['message' => 'تم حذف المرحلة بنجاح']);
        }
        return redirect()->back()->with(['error' => 'قم بحذف الصفوف اولا']);

    }

    public function update(GradeRequest $request,$id){

        $request->validated();
        $this->grade->updateGrade($request,$id);
        return redirect()->route('grade.index')->with(['message' => 'تم تعديل المرحلة بنجاح']);

    }


}
