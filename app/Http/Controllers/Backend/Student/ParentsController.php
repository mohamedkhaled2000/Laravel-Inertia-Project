<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Http\Repository\Interface\ParentRepositoryInterface;
use App\Http\Requests\ParentRequest;
use App\Models\ParentAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;
class ParentsController extends Controller
{

    protected $Parent;
    public function __construct(ParentRepositoryInterface $Parent)
    {
        $this->Parent = $Parent;
    }

    public function show(){
        $parents = $this->Parent->getAllParent();

        return Inertia::render('Parent/ParentsShow',[
            'parents' => $parents
        ]);
    }


    public function Add(){
        $nationality = $this->Parent->getNationalities();
        $religions = $this->Parent->getReligions();
        $bloods = $this->Parent->getTypeBloods();
        return Inertia::render('Parent/AddParent',[
            'nationality' => $nationality,
            'religions' => $religions,
            'bloods' => $bloods
        ]);
    }

    public function store(ParentRequest $request){

        $request->validated();
        $this->Parent->storeParent($request);
        return redirect()->back()->with(['message' => 'تم اضافة بيانات ولى الامر بنجاح']);
    }

    public function edit($id){
        $nationality = $this->Parent->getNationalities();
        $religions = $this->Parent->getReligions();
        $bloods = $this->Parent->getTypeBloods();
        $parent = $this->Parent->editParent($id);
        return Inertia::render('Parent/EditParent',[
            'nationality' => $nationality,
            'religions' => $religions,
            'bloods' => $bloods,
            'parent' => $parent
        ]);
    }

    public function update(Request $request,$id){

        // $parent = $this->Parent->editParent($id);
        $parent = $this->Parent->updateParent($request,$id);


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

            return redirect()->route('parent.show')->with(['message' => 'تم تعديل بيانات ولى الامر بنجاح']);

        }else{
            $parent->save();

            return redirect()->route('parent.show')->with(['message' => 'تم تعديل بيانات ولى الامر بنجاح']);

        }

    }


    public function destroy($id){
        $this->Parent->deleteParent($id);
        return redirect()->back()->with(['message' => 'تم الحذف بنجاح']);
    }



}
