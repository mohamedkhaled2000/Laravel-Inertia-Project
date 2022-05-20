<?php

namespace App\Http\Repository;

use App\Http\Repository\Interface\PromotionRepositoryInterface;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PromotionRepository implements PromotionRepositoryInterface{

    protected $Promotion;
    public function __construct(Promotion $Promotion)
    {
        $this->Promotion = $Promotion;
    }

    public function storePromotion($request)
    {

        DB::beginTransaction();
        $students = Student::whereGrade_id($request->grade_id)
                            ->whereClass_room_id($request->class_room_id)
                            ->whereSection_id($request->section_id)
                            ->get();

        foreach($students as $student){
            $ids = explode(',' , $student->id);

            Student::whereIn('id',$ids)->update([
                'grade_id' => $request->new_grade_id,
                'class_room_id' => $request->new_class_room_id,
                'section_id' => $request->new_section_id,
            ]);

            Promotion::updateOrCreate([
                'student_id' => $student->id,
                'from_grade' => $request->grade_id,
                'from_class_room' => $request->class_room_id ,
                'from_section' => $request->section_id ,

                'to_grade' => $request->new_grade_id,
                'to_class_room' => $request->new_class_room_id ,
                'to_section' => $request->new_section_id ,
            ]);
            DB::commit();
        }
        DB::rollBack();
        return redirect()->route('student.index')->with(['message' => 'تم ترقية الطلاب بنجاح']);

    }


}
