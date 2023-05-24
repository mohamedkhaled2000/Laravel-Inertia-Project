<?php

namespace App\Http\Controllers\Auth\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class LoginController extends Controller
{

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('student')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect(RouteServiceProvider::STUDENT);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();

        return redirect()->intended('/');

    }

    public function update(Request $request,$id){

        $data = Student::findOrFail($id);
        $data->name = $request->name;
        $data->email = $request->email;

        if($request->file('avatar')){
            $file = $request->file('avatar');
            if($data->profile_photo_path != null){
                unlink($data->profile_photo_path);
            }

            $filename = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            Image::make($file)->resize(225,225)->save('upload/student/profile_img/'.$filename);
            $url = 'upload/student/profile_img/'.$filename;
            $data['profile_photo_path'] = $url;
        }
        $data->save();

        return redirect()->back()->with(['message' => 'تم تحديث الملف الشخصى بنجاح']);
    }

}
