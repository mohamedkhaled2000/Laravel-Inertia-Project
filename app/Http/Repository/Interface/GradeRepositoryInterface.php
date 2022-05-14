<?php

namespace App\Http\Repository\Interface;

interface GradeRepositoryInterface {

    public function  getAllGrade();


    public function  storeGrade($request);

    public function  editGrade($id);

    public function  updateGrade($request,$id);

    public function  deleteGrade($id);

}
