<?php

namespace App\Http\Repository;

use  App\Http\Repository\Interface\TeacherRepositoryInterface;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface{

    protected $teacher;
    public function __construct(Teacher $teacher)
    {
        $this->teacher = $teacher;
    }

    public function getTeacher(){
        return  $this->teacher->all();
    }

    public function getAllTeacher()
    {
        return  $this->teacher->with('specialize')->latest()->paginate(10);
    }

    public function getAllSpicalizes()
    {
        return DB::table('speicalizes')->get();
    }

    public function storeTeacher($request)
    {
        $teacher = new Teacher();

        $teacher->email = $request->email;
        $teacher->password = Hash::make($request->password);
        $teacher->name = $request->name;
        $teacher->speicalize_id = $request->speicalize_id;
        $teacher->gender = $request->gender;
        $teacher->join_date = Carbon::now()->format('d F Y');
        $teacher->address = $request->address;
        $teacher->save();
    }

    public function editTeacher($id)
    {
        return $this->teacher->findOrFail($id);
    }

    public function updateTeacher($request,$id)
    {
        $teacher = $this->teacher->findOrFail($id);

        $teacher->email = $request->email;
        $teacher->name = $request->name;
        $teacher->speicalize_id = $request->speicalize_id;
        $teacher->gender = $request->gender;
        $teacher->address = $request->address;
        $teacher->save();
    }

    public function deleteTeacher($id)
    {
        $this->teacher->findOrFail($id)->delete();
    }
}
