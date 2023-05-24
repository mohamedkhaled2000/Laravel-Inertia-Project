<?php
namespace App\Http\Trait;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

trait AuthTrait{

    public function checkGuard($request){
        if ($request->type == 'student') {
            $guardName = 'student';
        } elseif ($request->type == 'teacher') {
            $guardName = 'teacher';
        }
        elseif ($request->type == 'parent') {
            $guardName = 'parent';
        }else {
            $guardName = 'web';
        }
        return $guardName;
    }


    public function redirectto($request) {
        if ($request->type === 'student'){
            return Redirect::intended(RouteServiceProvider::HOME);
        } elseif ($request->type === 'teacher') {
            return Redirect::intended(RouteServiceProvider::TEACHER);
        } elseif ($request->type === 'parent') {
            return Redirect::intended(RouteServiceProvider::PARENT);
        }elseif (($request->type === 'web')) {
            return Redirect::intended(RouteServiceProvider::HOME);
        }
    }

}
