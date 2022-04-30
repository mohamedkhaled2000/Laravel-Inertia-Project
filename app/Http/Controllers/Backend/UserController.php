<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class UserController extends Controller
{
    public function userLogin(Request $request){

        $data = User::find(Auth::id());
        $data->name = $request->name;
        $data->email = $request->email;

        if($request->file('avatar')){
            $file = $request->file('avatar');
            unlink($data->profile_photo_path);
            $filename = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            Image::make($file)->resize(225,225)->save('upload/profile_img/'.$filename);
            $url = 'upload/profile_img/'.$filename;
            $data['profile_photo_path'] = $url;
        }
        $data->save();

        return redirect()->back()->with(['message' => 'تم تحديث الملف الشخصى بنجاح']);
    }
}
