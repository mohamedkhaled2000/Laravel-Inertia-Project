<?php

namespace App\Http\Controllers\Backend\Fees;

use App\Http\Controllers\Controller;
use App\Models\ClassRooms;
use App\Models\Fees;
use App\Models\Grade;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fees = Fees::with('grade','class_room')->latest()->get();
        return Inertia::render('Fees/index', [ 'fees' => $fees ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades = Grade::all();
        $classRom = ClassRooms::all();
        return Inertia::render('Fees/Create',[
            'grades'    => $grades,
            'classRom'  => $classRom
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

        $request->validate([
            'name'                  => 'required',
            'price'                 => 'required',
            'grade_id'              => 'required',
            'class_room_id'         => 'required',
            'academic_year'         => 'required',
        ]);



        $fees = new Fees();
        $fees->name             = $request->name ;
        $fees->price            = $request->price ;
        $fees->grade_id         = $request->grade_id ;
        $fees->class_room_id    = $request->class_room_id ;
        $fees->academic_year    = $request->academic_year ;
        $fees->notes            = $request->notes ;
        $fees->save();

        return redirect()->route('fees.index')->with(['success' => 'تم اضافة بنجاح']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grades = Grade::all();
        $classRom = ClassRooms::all();
        $fee = Fees::findOrFail($id);
        return Inertia::render('Fees/Edit',[
            'grades'    => $grades,
            'classRom'  => $classRom,
            'fee'       => $fee
        ]);
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
        $request->validate([
            'name'                  => 'required',
            'price'                 => 'required',
            'grade_id'              => 'required',
            'class_room_id'         => 'required',
            'academic_year'         => 'required',
        ]);



        $fees = Fees::findOrFail($id);
        $fees->name             = $request->name ;
        $fees->price            = $request->price ;
        $fees->grade_id         = $request->grade_id ;
        $fees->class_room_id    = $request->class_room_id ;
        $fees->academic_year    = $request->academic_year ;
        $fees->notes            = $request->notes ;
        $fees->save();

        return redirect()->route('fees.index')->with(['success' => 'تم التحديث بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Fees::destroy($id);
        return back()->with(['success' => 'تم الحذف بنجاح']);
    }
}
