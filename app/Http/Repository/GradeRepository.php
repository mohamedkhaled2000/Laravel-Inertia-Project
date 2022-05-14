<?php

namespace App\Http\Repository;

use App\Http\Repository\Interface\GradeRepositoryInterface;
use App\Models\Grade;

class GradeRepository implements GradeRepositoryInterface{

    protected $grade;
    public function __construct(Grade $grade)
    {
        $this->grade = $grade;
    }

    public function  getAllGrade(){
        return $this->grade->all();
    }

    public function editGrade($id)
    {
       return $this->grade->findOrFail($id);
    }

    public function storeGrade($request)
    {
        $grade = new Grade();
        $grade->name = $request->name;
        $grade->notes = $request->notes;
        $grade->save();
    }

    public function updateGrade($request, $id)
    {
        $this->grade->findOrFail($id)->update([
            'name' => $request->name,
            'notes' => $request->notes
        ]);

    }

    public function deleteGrade($id)
    {
        $this->grade->findOrFail($id)->delete();

    }


}
