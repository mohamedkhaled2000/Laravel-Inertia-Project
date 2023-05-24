<?php
use Illuminate\Support\Str;

function uploadFile($photo,$path){
    $pass_photo = Str::random(20).$photo->getClientOriginalName();
    $photo->move(public_path($path),$pass_photo);
    return $pass_photo;
}
