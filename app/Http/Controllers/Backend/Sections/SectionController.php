<?php

namespace App\Http\Controllers\Backend\Sections;

use App\Http\Controllers\Controller;
use App\Models\ClassRooms;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SectionController extends Controller
{
    public function index(){
        $grades = Grade::all();
        $sections = Section::with('section_room')->orderBy('id','DESC')->get();
        $classRom = ClassRooms::all();

        return Inertia::render('Section/SectionView',[
            'sections' => $sections,
            'grades' => $grades,
            'classRom' => $classRom
        ]);
    }

    public function store(Request $request){

        $request->validate([
            'section_name' => 'required',
            'grade_id' => 'required',
            'class_room_id' => 'required',
        ],[
            'section_name.required' => 'هذا الحقل مطلوب',
            'grade_id.required' => 'هذا الحقل مطلوب',
            'class_room_id.required' => 'هذا الحقل مطلوب',
        ]);
        $section = new Section();
        $section->section_name = $request->section_name;
        $section->grade_id = $request->grade_id;
        $section->class_room_id = $request->class_room_id;
        $section->save();

        return redirect()->back()->with(['message' => 'تم اضافة القسم بنجاح']);

    }

    public function edit($id){
        $section = Section::find($id);
        $grades = DB::table('grades')->get();
        $classRom = DB::table('class_rooms')->get();

        return Inertia::render('Section/SectionEdit',[
            'section' =>$section,
            'grades' => $grades,
            'classRom' => $classRom
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
        $section = Section::find($id);
        $section->section_name = $request->section_name;
        $section->grade_id = $request->grade_id;
        $section->class_room_id = $request->class_room_id;
        $section->status = $request->status;
        $section->save();

        return redirect()->route('section.index')->with(['message' => 'تم تعديل القسم بنجاح']);

    }

    public function destroy($id){
        Section::find($id)->delete();

        return redirect()->back()->with(['message' => 'تم حذف القسم بنجاح']);
    }

}
