<?php

namespace App\Http\Repository\Interface;

interface ClassRoomRepositoryInterface {

    public function  getAllClassRoom();


    public function  storeClassRoom($request);

    public function  editClassRoom($id);

    public function  updateClassRoom($request,$id);

    public function  deleteClassRoom($id);

}
