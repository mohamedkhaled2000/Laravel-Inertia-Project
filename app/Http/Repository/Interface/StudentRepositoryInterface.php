<?php

namespace App\Http\Repository\Interface;

interface StudentRepositoryInterface {

    public function  getAllStudent();

    public function addStudent();
    public function  storeStudent($request);

    public function  editStudent($id);

    public function  updateStudent($request,$id);

    public function  deleteStudent($id);

}
