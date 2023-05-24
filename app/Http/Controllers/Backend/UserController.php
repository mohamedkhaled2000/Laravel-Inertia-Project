<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Trait\AuthTrait;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{

    use AuthTrait;

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

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect(RouteServiceProvider::HOME);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->intended('/');

    }

}
