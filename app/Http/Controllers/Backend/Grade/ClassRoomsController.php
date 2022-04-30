<?php

namespace App\Http\Controllers\Backend\Grade;

use App\Http\Controllers\Controller;
use App\Models\ClassRooms;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ClassRoomsController extends Controller
{
    public function index(){
        $classes = ClassRooms::with('grade')->orderBy('id','DESC')->get();
        $grades = DB::table('grades')->get();

        return Inertia::render('ClassRooms/ClassView',[
            'classes' => $classes,
            'grades' => $grades,
        ]);
    }

    public function store(Request $request){

        $request->validate([
            'class_name' => 'required',
            'grade_id' => 'required'
        ],[
            'class_name.required' => 'هذا الحقل مطلوب',
            'grade_id.required' => 'هذا الحقل مطلوب',

        ]);

        $class = new ClassRooms();
        $class->class_name = $request->class_name;
        $class->grade_id = $request->grade_id;
        $class->save();

        return redirect()->route('class.index')->with(['message' => 'تم اضافة الصف بنجاح']);
    }

    public function edit($id){
        $classRom = ClassRooms::find($id);
        $grades = DB::table('grades')->get();
        return Inertia::render('ClassRooms/ClassEdit',[
            'classRom' => $classRom,
            'grades' => $grades,
        ]);

    }


    public function destroy(ClassRooms $class,$id){
        $class->find($id)->delete();
        return redirect()->back()->with(['message' => 'تم حذف الصف بنجاح']);
    }

    public function update(Request $request,$id){

        $request->validate([
            'class_name' => 'required',
            'grade_id' => 'required'
        ],[
            'class_name.required' => 'هذا الحقل مطلوب',
            'grade_id.required' => 'هذا الحقل مطلوب',

        ]);

        $class = ClassRooms::find($id);
        $class->class_name = $request->class_name;
        $class->grade_id = $request->grade_id;
        $class->save();

        return redirect()->route('class.index')->with(['message' => 'تم تعديل الصف بنجاح']);
    }

    public function delete_all($slug){

        $all_slug = json_encode($slug);
        $all = explode(',', $all_slug);
        foreach($all as $item){
            ClassRooms::whereId($item)->delete();
        }


        return redirect()->route('class.index')->with(['message' => 'تم حذف الصفوف المحددة بنجاح']);


    }
}
