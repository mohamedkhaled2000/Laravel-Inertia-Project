<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\Interface\PromotionRepositoryInterface;
use App\Http\Repository\Interface\SectionRepositoryInterface;
use App\Http\Repository\Interface\GradeRepositoryInterface;
use App\Http\Repository\Interface\ClassRoomRepositoryInterface;
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


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->promotion->storePromotion($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
