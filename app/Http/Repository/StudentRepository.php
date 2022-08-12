<?php

namespace App\Http\Repository;

use App\Http\Repository\Interface\StudentRepositoryInterface;
use App\Models\ClassRooms;
use App\Models\Grade;
use App\Models\Image;
use App\Models\Nationality;
use App\Models\Parents;
use App\Models\Section;
use App\Models\Student;
use App\Models\TypeBlood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class StudentRepository implements StudentRepositoryInterface{

    protected $Student;
    public function __construct(Student $Student)
    {
        $this->Student = $Student;
    }

    public function  getAllStudent(){
        return   $this->Student->with('grade','class_room','section')->latest()->paginate(10);
    }

    public function addStudent()
    {
        $data['nationality_id'] = Nationality::all();
        $data['type_blood_id'] = TypeBlood::all();
        $data['grade_id'] = Grade::all();
        $data['class_room_id'] = ClassRooms::all();
        $data['section_id'] = Section::all();
        $data['parent_id'] = Parents::all();
        return $data;
    }



    public function storeStudent($request)
    {
        $request->validated();


        DB::beginTransaction();
        try{

            $student = $this->Student->create($request->except('images'));

            if($request->file('images')){
                foreach($request->file('images') as $image){

                    $filename = Str::random(20).$image->getClientOriginalName();
                    $image->move(public_path('upload/Students/'.$student->name),$filename);


                    $images = new Image();
                    $images->url = 'upload/Students/'. $student->name.'/' .$filename;
                    $images->imageable_id = $student->id;
                    $images->imageable_type = 'App\Models\Student';
                    $images->save();
                }
            }
            DB::commit();
            return redirect()->route('student.index')->with(['message' => 'تم اضافة الطالب بنجاح']);

        }catch(\Exception $e){
        DB::rollBack();
        return redirect()->route('student.index')->with(['error' => $e->getMessage()]);
        }


    }

    public function editStudent($id)
    {
       return $this->Student->findOrFail($id);
    }


    public function updateStudent($request, $id)
    {
        $this->Student->findOrFail($id)->update($request->all());
    }

    public function deleteStudent($id)
    {
        // $this->Student->findOrFail($id)->delete();
        $this->Student->destroy($id);
    }

    public function viewStudent($id)
    {
        $student =  $this->Student->with('grade','class_room','section','parent','nationality','type_boold','images')->get()->find($id);

        return Inertia::render('Student/ViewStudent',[
            'student' => $student
        ]);
    }

    public function upload_att($request)
    {
        if($request->file('images')){
            foreach($request->file('images') as $image){

                $filename = Str::random(20).$image->getClientOriginalName();
                $image->move(public_path('upload/Students/'.$request->name),$filename);


                $images = new Image();
                $images->url = 'upload/Students/'. $request->name.'/' .$filename;
                $images->imageable_id = $request->id;
                $images->imageable_type = 'App\Models\Student';
                $images->save();
            }
        }
    }

    public function download_att($stdName,$file){
        if(file_exists(public_path('upload/Students/'.$stdName.'/'.$file))){
            return  response()->download(public_path('upload/Students/'.$stdName.'/'.$file));
        }else{
            return 'هذا الملف غير موجود';
        }
    }

    public function delete_att($id){
        $image = Image::findOrFail($id);
        if(file_exists(public_path($image->url))){
            unlink($image->url);
        }
        $image->delete();
        return redirect()->back()->with(['message' => 'تم حذف المرفق بنجاح']);
    }


}
