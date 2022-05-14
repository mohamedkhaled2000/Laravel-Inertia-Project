<?php

namespace App\Http\Repository\Interface;

interface SectionRepositoryInterface {

    public function  getAllSection();


    public function  storeSection($request);

    public function  editSection($id);

    public function  updateSection($request,$id);

    public function  deleteSection($id);

}
