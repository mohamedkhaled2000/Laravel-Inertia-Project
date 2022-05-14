<?php

namespace App\Http\Repository;

use App\Http\Repository\Interface\ParentRepositoryInterface;
use App\Models\ParentAttachment;
use App\Models\Parents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;



class ParentRepository implements ParentRepositoryInterface{

    protected $Parents;
    public function __construct(Parents $Parents)
    {
        $this->Parents = $Parents;
    }

    public function  getAllParent(){
        return $this->Parents->latest()->paginate(10);
    }

    public function storeParent($request)
    {

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
                'parent_id' => $this->Parents->latest()->first()->id
            ]);
        }

    }

    public function editParent($id)
    {
       return $this->Parents->findOrFail($id);;
    }


    public function updateParent($request, $id)
    {

        $parent = $this->Parents->findOrFail($id);

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

        return $parent;

    }

    public function deleteParent($id)
    {
        $parent = $this->Parents->findOrFail($id);
        File::deleteDirectory(public_path('upload/Parents/'.$parent->father_name));
        ParentAttachment::whereParent_id($id)->delete();
        $parent->delete();
    }

    public function getNationalities()
    {
        return  DB::table('nationalities')->get();
    }
    public function getReligions()
    {
        return DB::table('religions')->get();
    }
    public function getTypeBloods()
    {
        return DB::table('type_bloods')->get();
    }


}
