<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParentRequest;
use App\Models\ParentAttachment;
use App\Models\Parents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Support\Str;
class ParentsController extends Controller
{

    public function show(){
        $parents = DB::table('parents')->latest()->paginate(10);

        return Inertia::render('Student/ParentsShow',[
            'parents' => $parents
        ]);
    }


    public function Add(){
        $nationality = DB::table('nationalities')->get();
        $religions = DB::table('religions')->get();
        $bloods = DB::table('type_bloods')->get();
        return Inertia::render('Student/AddParent',[
            'nationality' => $nationality,
            'religions' => $religions,
            'bloods' => $bloods
        ]);
    }

    public function store(ParentRequest $request){

        $request->validated();

        $parent = new Parents();
        $parent->email =  $request->email;
        $parent->password =  Hash::make($request->passowrd);
        $parent->father_name =  $request->father_name;
        $parent->father_nation_id =  $request->father_nation_id;
        $parent->father_passport_id =  $request->father_passport_id;
        $parent->father_phone =  $request->father_phone;
        $parent->father_job =  $request->father_job;
        $parent->father_address =  $request->father_address;
        $parent->nationality_father_id =  $request->nationality_father_id;
        $parent->boold_type_father_id =  $request->boold_type_father_id;
        $parent->religion_father_id =  $request->religion_father_id;

        $parent->mother_name =  $request->mother_name;
        $parent->mother_nation_id =  $request->mother_nation_id;
        $parent->mother_passport_id =  $request->mother_passport_id;
        $parent->mother_phone =  $request->mother_phone;
        $parent->mother_job =  $request->mother_job;
        $parent->mother_address =  $request->mother_address;
        $parent->nationality_mother_id =  $request->nationality_mother_id;
        $parent->boold_type_mother_id =  $request->boold_type_mother_id;
        $parent->religion_mother_id =  $request->religion_mother_id;

        $parent->save();
        if($request->file('pass_photo') && $request->file('nation_photo')){
            $path = [
                $request->file('pass_photo')->getClientOriginalName(),
                $request->file('nation_photo')->getClientOriginalName()];

            $pass_photo = Str::random(20).'.webp';
            $nation_photo = Str::random(20).'.webp';

            $request->file('pass_photo')->move(public_path('upload/Parents/'.$request->father_name),$pass_photo);
            $request->file('nation_photo')->move(public_path('upload/Parents/'.$request->father_name),$nation_photo);
            ParentAttachment::create([
                'file_name' => json_encode($path),
                'parent_id' => Parents::latest()->first()->id
            ]);
        }

        return redirect()->back()->with(['message' => 'تم اضافة بيانات ولى الامر بنجاح']);
    }

    public function edit($id){
        $nationality = DB::table('nationalities')->get();
        $religions = DB::table('religions')->get();
        $bloods = DB::table('type_bloods')->get();
        $parent = Parents::find($id);
        return Inertia::render('Student/EditParent',[
            'nationality' => $nationality,
            'religions' => $religions,
            'bloods' => $bloods,
            'parent' => $parent
        ]);
    }

    public function update(Request $request,$id){

        $parent = Parents::find($id);

        $parent->email =  $request->email;
        $parent->father_name =  $request->father_name;
        $parent->father_nation_id =  $request->father_nation_id;
        $parent->father_passport_id =  $request->father_passport_id;
        $parent->father_phone =  $request->father_phone;
        $parent->father_job =  $request->father_job;
        $parent->father_address =  $request->father_address;
        $parent->nationality_father_id =  $request->nationality_father_id;
        $parent->boold_type_father_id =  $request->boold_type_father_id;
        $parent->religion_father_id =  $request->religion_father_id;

        $parent->mother_name =  $request->mother_name;
        $parent->mother_nation_id =  $request->mother_nation_id;
        $parent->mother_passport_id =  $request->mother_passport_id;
        $parent->mother_phone =  $request->mother_phone;
        $parent->mother_job =  $request->mother_job;
        $parent->mother_address =  $request->mother_address;
        $parent->nationality_mother_id =  $request->nationality_mother_id;
        $parent->boold_type_mother_id =  $request->boold_type_mother_id;
        $parent->religion_mother_id =  $request->religion_mother_id;

        if($request->file('pass_photo') && $request->file('nation_photo')){
            File::deleteDirectory(public_path('upload/Parents/'.$parent->father_name));
            $path = [
                $request->file('pass_photo')->getClientOriginalName(),
                $request->file('nation_photo')->getClientOriginalName()];

            $pass_photo = Str::random(20).'.webp';
            $nation_photo = Str::random(20).'.webp';

            ParentAttachment::whereParent_id($id)->update([
                'file_name' => json_encode($path),
            ]);

            $request->file('pass_photo')->move(public_path('upload/Parents/'.$request->father_name),$pass_photo);
            $request->file('nation_photo')->move(public_path('upload/Parents/'.$request->father_name),$nation_photo);

            return redirect()->back()->with(['message' => 'تم اضافة بيانات ولى الامر بنجاح']);

        }else{
            $parent->save();

            return redirect()->back()->with(['message' => 'تم اضافة بيانات ولى الامر بنجاح']);

        }

    }


    public function destroy($id){
        $parent = Parents::find($id);
        File::deleteDirectory(public_path('upload/Parents/'.$parent->father_name));
        ParentAttachment::whereParent_id($id)->delete();
        $parent->delete();
        return redirect()->back()->with(['message' => 'تم الحذف بنجاح']);
    }



}
