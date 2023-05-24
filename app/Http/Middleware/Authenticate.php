<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // if (!$request->expectsJson()){
            // if ($request->is('/student/dashboard')) {
            //     return redirect()->route('selection');
            // // }
            // // elseif ($request->is('/teacher/dashboard')) {
            // //     return redirect()->route('selection');
            // // }
            // // elseif ($request->is('/parent/dashboard')) {
            // //     return redirect()->route('selection');
            // }else {
            //     return redirect()->route('selection');
            // }

        // }
        if (! $request->expectsJson()) {
            return route('selection');
        }
    }
}
