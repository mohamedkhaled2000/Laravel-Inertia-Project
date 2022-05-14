<?php

namespace App\Http\Repository\Interface;

interface ParentRepositoryInterface {

    public function  getAllParent();

    public function  storeParent($request);

    public function  editParent($id);

    public function  updateParent($request,$id);

    public function  deleteParent($id);

    public function  getNationalities();

    public function  getReligions();
    
    public function  getTypeBloods();
}
