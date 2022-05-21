<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function userLogin(Request $request){

        $data = User::findOrFail(Auth::id());
        $data->name = $request->name;
        $data->email = $request->email;

        if($request->file('avatar')){
            $file = $request->file('avatar');
            if($data->profile_photo_path != null){
                unlink($data->profile_photo_path);
            }

            $filename = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            Image::make($file)->resize(225,225)->save('upload/profile_img/'.$filename);
            $url = 'upload/profile_img/'.$filename;
            $data['profile_photo_path'] = $url;
        }
        $data->save();

        return redirect()->back()->with(['message' => 'تم تحديث الملف الشخصى بنجاح']);
    }

    public function backCover(Request $request){
        try{

            $User = User::findOrFail(Auth::id());

            if($request->file('photo')){
                if(File::exists($User->background_photo)){
                    File::delete($User->background_photo);
                }

                $filename = hexdec(uniqid()).'.'.$request->file('photo')->getClientOriginalExtension();
                Image::make($request->file('photo'))->resize(1600,451)->save('upload/profile_img/'.$filename);
                $url = 'upload/profile_img/'.$filename;
                $User->background_photo = $url;
            }
            $User->save();

            return redirect()->back()->with(['message' => 'تم تحديث الغلاف بنجاح']);
        }catch(\Exception $e){
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }

    }

}
