<?php

namespace App\Http\Controllers\Backend\Subjects\Library;

use App\Http\Controllers\Controller;
use App\Models\ClassRooms;
use App\Models\Grade;
use App\Models\Library;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $libraries = Library::with('teacher','grade','class_room','section')->get();
        return Inertia::render('Subjects/Library/Index',[
            'libraries'  => $libraries,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades         = Grade::all();
        $class_room     = ClassRooms::all();
        $sections       = Section::all();
        $teachers       = Teacher::all();
        return Inertia::render('Subjects/Library/Add',[
            'grades'        => $grades,
            'class_rooms'   => $class_room,
            'sections'      => $sections,
            'teachers'      => $teachers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            Library::create([
                'title'         => $request->title,
                'grade_id'      => $request->grade_id,
                'class_room_id' => $request->class_room_id,
                'section_id'    => $request->section_id,
                'teacher_id'    => $request->teacher_id,
                'file_name'     => uploadFile($request->file('file_name'),'upload/Library'),
            ]);

            return redirect()->route('library.index')->with(['message' => 'تم رفع الكتاب بنجاح']);
        }catch (\Exception $e){
            return redirect()->route('library.index')->with(['error' => $e->getMessage()]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = Library::findOrFail($id);
        if (file_exists('upload/Library/'.$file->file_name)){
            return  response()->download(public_path('upload/Library/'.$file->file_name));
        }else {
            return back()->with(['error' => 'الملف غير موجود']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $library        = Library::findOrFail($id);
        $grades         = Grade::all();
        $class_room     = ClassRooms::all();
        $sections       = Section::all();
        $teachers       = Teacher::all();
        return Inertia::render('Subjects/Library/Edit',[
            'library'       => $library,
            'grades'        => $grades,
            'class_rooms'   => $class_room,
            'sections'      => $sections,
            'teachers'      => $teachers,
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

        $file = Library::findOrFail($id);

        $file->title         = $request->title;
        $file->grade_id      = $request->grade_id;
        $file->class_room_id = $request->class_room_id;
        $file->section_id    = $request->section_id;
        $file->teacher_id    = $request->teacher_id;

        if ($request->hasFile('file_name')){
            File::delete('upload/Library/'.$file->file_name);
            $file->file_name = uploadFile($request->file('file_name'),'upload/Library');
        }
        $file->save();
        return redirect()->route('library.index')->with(['message' => 'تم تعديل الكتاب بنجاح']);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = Library::findOrFail($id);
        if (file_exists('upload/Library/'.$file->file_name)){
            File::delete('upload/Library/'.$file->file_name);
        }
        $file->delete();
        return redirect()->route('library.index')->with(['message' => 'تم حذف الكتاب بنجاح']);

    }
}
