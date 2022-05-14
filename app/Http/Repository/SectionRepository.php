<?php

namespace App\Http\Repository;

use App\Http\Repository\Interface\SectionRepositoryInterface;
use App\Models\Section;

class SectionRepository implements SectionRepositoryInterface{

    protected $section;
    public function __construct(Section $section)
    {
        $this->section = $section;
    }

    public function  getAllSection(){
        return $this->section->with('section_room','teachers')->orderBy('id','DESC')->get();
    }

    public function storeSection($request)
    {
        $section = new Section();
        $section->section_name = $request->section_name;
        $section->grade_id = $request->grade_id;
        $section->class_room_id = $request->class_room_id;
        $section->save();
        $section->teachers()->attach($request->teacher_id);
    }

    public function editSection($id)
    {

        return $this->section->with('teachers')->get()->find($id);
    }


    public function updateSection($request, $id)
    {
        $section = $this->section->findOrFail($id);
        $section->section_name = $request->section_name;
        $section->grade_id = $request->grade_id;
        $section->class_room_id = $request->class_room_id;
        $section->status = $request->status;

        if(isset($request->teacher_id)){
            $section->teachers()->sync($request->teacher_id);
        }else{
            $section->teachers()->sync(array());
        }
        $section->save();
    }

    public function deleteSection($id)
    {
        $this->section->findOrFail($id)->delete();

    }


}
