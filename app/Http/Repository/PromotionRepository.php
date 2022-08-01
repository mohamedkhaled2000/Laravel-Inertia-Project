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
                            ->whereAcademic_year($request->academic_year)
                            ->get();

        foreach($students as $student){
            $ids = explode(',' , $student->id);

            Student::whereIn('id',$ids)->update([
                'grade_id'      => $request->new_grade_id,
                'class_room_id' => $request->new_class_room_id,
                'section_id'    => $request->new_section_id,
                'academic_year' => $request->academic_year_new,
            ]);

            Promotion::updateOrCreate([
                'student_id'        => $student->id,
                'from_grade'        => $request->grade_id,
                'from_class_room'   => $request->class_room_id ,
                'from_section'      => $request->section_id ,

                'to_grade'          => $request->new_grade_id,
                'to_class_room'     => $request->new_class_room_id ,
                'to_section'        => $request->new_section_id ,

                'academic_year'     => $request->academic_year ,
                'academic_year_new' => $request->academic_year_new ,
            ]);
            DB::commit();
        }
        DB::rollBack();
        return redirect()->route('student.index')->with(['message' => 'تم ترقية الطلاب بنجاح']);

    }

    public function getPromotion(){
        return $this->Promotion->with('student','f_grade','f_class_room','f_section','t_grade','t_class_room','t_section')
                                ->latest()->paginate(10);
    }

    public function destroy($id){

        if($id == 1){
            try{
                DB::beginTransaction();

                $Promotions = $this->Promotion->all();

                foreach($Promotions as $pro){
                    $ids = explode(',' , $pro->student_id);

                    Student::whereIn('id',$ids)->update([
                        'grade_id'      => $pro->from_grade,
                        'class_room_id' => $pro->from_class_room,
                        'section_id'    => $pro->from_section,
                        'academic_year' => $pro->academic_year,
                    ]);

                    DB::commit();
                }
                $this->Promotion->truncate();

                return redirect()->back()->with(['message' => 'تم استرجاع الترقيات بنجاح']);
            }catch(\Exception $e){
                DB::rollBack();
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
        }else{
            return 2;
        }

    }


}
