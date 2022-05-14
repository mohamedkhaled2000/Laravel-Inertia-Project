<?php

namespace App\Http\Repository\Interface;

interface TeacherRepositoryInterface {

    // Get All Teacher
    public function  getTeacher();
    public function  getAllTeacher();

    // Get All Spicalizes
    public function  getAllSpicalizes();

    // Store New Teacher
    public function  storeTeacher($request);

    // Get Edit Page
    public function  editTeacher($id);

    // Update Teacher
    public function  updateTeacher($request,$id);

    // Delete Teacher
    public function  deleteTeacher($id);

}
