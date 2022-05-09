<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [

            'flash' => [
                'message' => session('message'),
                'error'  => session('error')
            ],

            'auth' => Auth::check() ? [
                'user' => [
                    'id' => Auth::user()->id ,
                    'username' => Auth::user()->name ,
                    'email' => Auth::user()->email ,
                    'image' => Auth::user()->profile_photo_path == null ? 'upload/No-Image.svg.png' : Auth::user()->profile_photo_path
                ]
            ] :

            [
                'user' => [
                    'id' => 1 ,
                    'username' => 'admin' ,
                    'email' => 'admin@admon.com' ,
                    'image' =>  'upload/No-Image.svg.png'
                ]
            ]
        ]);
    }
}
