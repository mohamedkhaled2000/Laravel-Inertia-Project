<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\Interface\PromotionRepositoryInterface;
use App\Http\Repository\Interface\SectionRepositoryInterface;
use App\Http\Repository\Interface\GradeRepositoryInterface;
use App\Http\Repository\Interface\ClassRoomRepositoryInterface;
use App\Models\Promotion;
use App\Models\Student;
use Inertia\Inertia;

class PromotionController extends Controller
{
    protected $promotion;
    protected $section;
    protected $grade;
    protected $classRom;

    public function __construct(PromotionRepositoryInterface $promotion,
                                SectionRepositoryInterface $section,
                                GradeRepositoryInterface $grade,
                                ClassRoomRepositoryInterface $classRom)
    {
        $this->promotion = $promotion;
        $this->section = $section;
        $this->grade = $grade;
        $this->classRom = $classRom;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = $this->section->getAllSection();
        $grades = $this->grade->getAllGrade();
        $classRom = $this->classRom->getAllClassRoom();

        return Inertia::render('Student/ProStudent',[
            'sections' => $sections ,
            'grades' => $grades ,
            'classRom' => $classRom ,
        ]);
    }


    public function store(Request $request)
    {
        return $this->promotion->storePromotion($request);
    }


    public function create()
    {
        return Inertia::render('Student/ShowPromotion',[
            'promotions' => $this->promotion->getPromotion() ,
        ]);
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        Student::whereId($id)->Delete();
        return redirect()->route('graduated.index')->with(['success' => 'تم التنفيذ بنجاح']);
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function stdReturn($id)
    {
        $pro = Promotion::findOrFail($id);

       $student = Student::findOrFail($pro->student_id)->update([
            'grade_id'      => $pro->from_grade,
            'class_room_id' => $pro->from_class_room,
            'section_id'    => $pro->from_section,
            'academic_year' => $pro->academic_year,
       ]);

       if($student){
           $pro->delete();
       }

       return back()->with(['success' => 'تم استرجاع الطالب بنجاح']);

    }


    public function destroy($id)
    {
        return $this->promotion->destroy($id);
    }
}
