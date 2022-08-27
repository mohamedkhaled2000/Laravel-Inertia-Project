<?php

namespace App\Http\Controllers\Backend\Subjects;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with('exam')->latest()->get();
        return Inertia::render('Subjects/Questions/Index',[
            'questions' => $questions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exams = Exam::all();
        return Inertia::render('Subjects/Questions/Add',[
            'exams' => $exams
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
        Question::create([
            'title'         => $request -> title,
            'answers'       => json_encode($request -> answers),
            'right_answer'  => $request -> right_answer,
            'score'         => $request -> score,
            'exam_id'       => $request -> exam_id,
        ]);

        return redirect()->route('question.index')->with(['message' => 'تم اضافة السؤال بنجاح']);
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
        $exams = Exam::all();
        $question = Question::with('exam')->findOrFail($id);
        return Inertia::render('Subjects/Questions/Edit',[
            'exams' => $exams,
            'question' => $question
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
        Question::findOrFail($id)->update([
            'title'         => $request -> title,
            'answers'       => json_encode($request -> answers),
            'right_answer'  => $request -> right_answer,
            'score'         => $request -> score,
            'exam_id'       => $request -> exam_id,
        ]);

        return redirect()->route('question.index')->with(['message' => 'تم تحديث السؤال بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Question::destroy($id);
        return redirect()->route('question.index')->with(['message' => 'تم حذف السؤال بنجاح']);

    }
}
