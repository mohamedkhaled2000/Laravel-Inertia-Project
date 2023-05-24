<?php

namespace App\Http\Controllers\Backend\Classes;

use App\Http\Controllers\Controller;
use App\Http\Trait\ZoomMeetingTrait;
use App\Models\Grade;
use App\Models\ClassRooms;
use App\Models\OnlineClass;
use App\Models\Section;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use MacsiDigital\Zoom\Facades\Zoom;

class OnlineClassController extends Controller
{
    use ZoomMeetingTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = OnlineClass::with('grade','class_room','section','user')->latest()->get();
        return Inertia::render('OnlineClass/Index',[
            'classes' => $classes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades         = Grade::all();
        $class_room     = ClassRooms::all();
        $sections       = Section::all();
        return Inertia::render('OnlineClass/Add',[
            'grades'        => $grades,
            'class_rooms'   => $class_room,
            'sections'      => $sections,
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
        try{
            $meeting = $this->createMeeting($request);
            OnlineClass::create([
                'grade_id'      => $request->grade_id,
                'class_room_id' => $request->class_room_id,
                'section_id'    => $request->section_id,
                'user_id'       => auth()->user()->id,
                'meeting_id'    => $meeting->id,
                'topic'         => $request->topic,
                'duration'      => $request->duration,
                'password'      => $meeting->password,
                'start_time'    => Carbon::create($request->start_time)->format('Y-m-d (H:i a)'),
                'join_url'      => $meeting->join_url,
            ]);

            return redirect()->route('classes.index')->with(['message' => 'تم انشاء الحصة بنجاح']);
        }catch (\Exception $e){
            return redirect()->route('classes.index')->with(['error' => $e->getMessage()]);

        }

    }

    public function storeOffline(Request $request){
        try{
            OnlineClass::create([
                'grade_id'      => $request->grade_id,
                'class_room_id' => $request->class_room_id,
                'section_id'    => $request->section_id,
                'user_id'       => auth()->user()->id,
                'meeting_id'    => str_replace(' ','',$request->meeting_id),
                'topic'         => $request->topic,
                'duration'      => $request->duration,
                'password'      => $request->password,
                'start_time'    => Carbon::create($request->start_time)->format('Y-m-d (H:i a)'),
                'join_url'      => $request->join_url,
            ]);

            return redirect()->route('classes.index')->with(['message' => 'تم انشاء الحصة بنجاح']);
        }catch (\Exception $e){
            return redirect()->route('classes.index')->with(['error' => $e->getMessage()]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grades         = Grade::all();
        $class_room     = ClassRooms::all();
        $sections       = Section::all();
        return Inertia::render('OnlineClass/AddOffline',[
            'grades'        => $grades,
            'class_rooms'   => $class_room,
            'sections'      => $sections,
        ]);
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
        $meeting = Zoom::meeting()->find($id);
        $meeting->delete();
        OnlineClass::whereMeeting_id($id)->delete();
        return redirect()->route('classes.index')->with(['message' => 'تم حذف الحصة بنجاح']);

    }
}
