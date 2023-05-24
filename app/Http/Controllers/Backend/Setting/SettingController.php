<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function index(){
        $collection = Setting::all();
        $settings['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });
        return Inertia::render('Settings/Index',[
            'settings' => $settings
        ]);
    }


    public function update(Request $request,$id){
        try {
            $info = $request->except('_token' , '_method','logo');
            foreach($info as $key => $val) {
                Setting::where('key' , $key)->update([
                    'value' => $val
                ]);
            }

            if ($request->hasFile('logo')){
                Setting::where('key','logo')->update([
                    'value' => uploadFile($request->file('logo'),'upload/Logo')
                ]);
            }
            return back()->with(['message' => "تم الحفظ بنجاح"]);
        } catch (\Exception $e) {
           return back()->with(['error' => $e->getMessage()]);
        }
    }
}
