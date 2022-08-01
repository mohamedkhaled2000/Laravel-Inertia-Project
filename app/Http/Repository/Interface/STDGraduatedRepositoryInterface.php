<?php

namespace App\Http\Repository\Interface;

interface STDGraduatedRepositoryInterface {

    public function  getAllGraduated();

    public function  create();

    public function  store($request);

    public function  update($id);

    public function  delete($id);

}
