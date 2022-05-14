<?php

namespace App\Http\Controllers\Backend\Grade;

use App\Http\Controllers\Controller;
use App\Http\Repository\Interface\ClassRoomRepositoryInterface;
use App\Http\Repository\Interface\GradeRepositoryInterface;
use App\Models\ClassRooms;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClassRoomsController extends Controller
{

    protected $classRoom;
    protected $grade;
    public function __construct(ClassRoomRepositoryInterface $classRoom,GradeRepositoryInterface $grade)
    {
        $this->classRoom = $classRoom;
        $this->grade = $grade;
    }

    public function index(){
        $classes = $this->classRoom->getAllClassRoom();
        $grades = $this->grade->getAllGrade();

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
        $this->classRoom->storeClassRoom($request);

        return redirect()->route('class.index')->with(['message' => 'تم اضافة الصف بنجاح']);
    }

    public function edit($id){

        $classRom = $this->classRoom->editClassRoom($id);
        $grades = $this->grade->getAllGrade();

        return Inertia::render('ClassRooms/ClassEdit',[
            'classRom' => $classRom,
            'grades' => $grades,
        ]);

    }


    public function destroy($id){
        $this->classRoom->deleteClassRoom($id);
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

        $this->classRoom->updateClassRoom($request,$id);
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
