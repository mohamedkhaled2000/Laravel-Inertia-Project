<?php

namespace App\Http\Repository\Interface;

interface StudentRepositoryInterface {

    public function  getAllStudent();

    public function addStudent();

    public function viewStudent($id);

    public function  storeStudent($request);

    public function  editStudent($id);

    public function  updateStudent($request,$id);

    public function  deleteStudent($id);

    public function  upload_att($request);

    public function  download_att($url);

    public function  delete_att($id);

}
