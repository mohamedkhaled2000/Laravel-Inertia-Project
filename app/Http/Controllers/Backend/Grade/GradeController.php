<?php

namespace App\Http\Controllers\Backend\Grade;

use App\Http\Controllers\Controller;
use App\Http\Requests\GradeRequest;
use App\Models\ClassRooms;
use App\Models\Grade;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class GradeController extends Controller
{
    public function index(){
        $grades = DB::table('grades')->get();
        return Inertia::render('Grade/Grade',['grades' => $grades]);
    }

    public function add(){
        return Inertia::render('Grade/GradeAdd');
    }
    public function edit(Grade $grade,$id){
        $grades = $grade->find($id);
        return Inertia::render('Grade/GradeEdit',['grade' => $grades]);
    }

    public function store(GradeRequest $request){

        $request->validated();
        $grade = new Grade();
        $grade->name = $request->name;
        $grade->notes = $request->notes;
        $grade->save();

        return redirect()->route('grade.index')->with(['message' => 'تم اضافة المرحلة بنجاح']);

    }

    public function destroy(Grade $grade,$id){
        $classes = ClassRooms::whereGrade_id($id)->pluck('grade_id');
        if($classes->count() == 0){
            $grade->find($id)->delete();
            return redirect()->back()->with(['message' => 'تم حذف المرحلة بنجاح']);
        }
        return redirect()->back()->with(['error' => 'قم بحذف الصفوف اولا']);

    }

    public function update(GradeRequest $request,Grade $grade,$id){

        $request->validated();

        $grade->find($id)->update([
            'name' => $request->name,
            'notes' => $request->notes
        ]);

        return redirect()->route('grade.index')->with(['message' => 'تم تعديل المرحلة بنجاح']);

    }
}
