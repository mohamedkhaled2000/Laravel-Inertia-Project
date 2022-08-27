<?php

namespace App\Http\Controllers\Backend\Fees;

use App\Http\Controllers\Controller;
use App\Models\ProcessingFees;
use App\Models\Student;
use App\Models\StudentAccount;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ProcessingFeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processing = ProcessingFees::with('student')->latest()->get();
        return Inertia::render('Fees/ProcessingFees/Index',[
           'processing' => $processing
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{

            $prcessing = new ProcessingFees();
            $prcessing->date          = date('Y-m-d');
            $prcessing->student_id    = $request->student_id;
            $prcessing->amount        = $request->amount;
            $prcessing->notes         = $request->notes;
            $prcessing->save();

            $std_account = new StudentAccount();
            $std_account->date          = date('Y-m-d');
            $std_account->type          = 'processing';
            $std_account->student_id    = $request->student_id;
            $std_account->processing_id = $prcessing->id;
            $std_account->debit         = 0;
            $std_account->credit        = $request->amount;
            $std_account->notes         = $request->notes;
            $std_account->save();

            DB::commit();
            return redirect()->route('student.index')->with(['message' => 'تم معالجه الرسوم بنجاح']);
        }catch (Exception $e){
            DB::rollback();
            return redirect()->route('student.index')->with(['error' => $e->getMessage()]);
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
        $student = Student::with('student_account')->findOrFail($id);
        $sum = $student->student_account->sum('debit') - $student->student_account->sum('credit');
        return Inertia::render('Fees/ProcessingFees/Add',[
            'student' => $student,
            'sum'     => $sum,
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
        $processing = ProcessingFees::with('student')->findOrFail($id);
        return Inertia::render('Fees/ProcessingFees/Edit',[
            'processing' => $processing
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
        DB::beginTransaction();
        try{

            $prcessing = ProcessingFees::findOrFail($id);
            $prcessing->date          = date('Y-m-d');
            $prcessing->student_id    = $request->student_id;
            $prcessing->amount        = $request->amount;
            $prcessing->notes         = $request->notes;
            $prcessing->save();

            $std_account = StudentAccount::where('processing_id',$prcessing->id)->first();
            $std_account->date          = date('Y-m-d');
            $std_account->type          = 'processing';
            $std_account->student_id    = $request->student_id;
            $std_account->processing_id = $prcessing->id;
            $std_account->debit         = 0;
            $std_account->credit        = $request->amount;
            $std_account->notes         = $request->notes;
            $std_account->save();

            DB::commit();
            return redirect()->route('processing_fees.index')->with(['message' => 'تم تعديل معالجة الرسوم بنجاح']);
        }catch (Exception $e){
            DB::rollback();
            return redirect()->route('processing_fees.index')->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProcessingFees::destroy($id);
        return redirect()->route('processing_fees.index')->with(['message' => 'تم حذف الرسم بنجاح']);
    }
}
