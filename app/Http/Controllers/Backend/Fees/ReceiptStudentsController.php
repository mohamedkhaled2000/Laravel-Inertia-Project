<?php

namespace App\Http\Controllers\Backend\Fees;

use App\Http\Controllers\Controller;
use App\Models\FundAccounts;
use App\Models\ReceiptStudents;
use App\Models\Student;
use App\Models\StudentAccount;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ReceiptStudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receipt = ReceiptStudents::with('student')->latest()->get();
        return Inertia::render('Fees/ReceiptStudents/Index',[
           'receipts' => $receipt
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

            $receipt = new ReceiptStudents();
            $receipt->date          = date('Y-m-d');
            $receipt->student_id    = $request->student_id;
            $receipt->debit         = $request->amount;
            $receipt->notes         = $request->notes;
            $receipt->save();

            $fund = new FundAccounts();
            $fund->date          = date('Y-m-d');
            $fund->receipt_id    = $receipt->id;
            $fund->debit         = $request->amount;
            $fund->credit        = 0;
            $fund->notes         = $request->notes;
            $fund->save();


            $std_account = new StudentAccount();
            $std_account->date          = date('Y-m-d');
            $std_account->type          = 'receipt';
            $std_account->student_id    = $request->student_id;
            $std_account->receipt_id    = $receipt->id;
            $std_account->debit         = 0;
            $std_account->credit        = $request->amount;
            $std_account->notes         = $request->notes;
            $std_account->save();

            DB::commit();
            return redirect()->route('student.index')->with(['message' => 'تم اضافة السند بنجاح']);
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
        $student = Student::findOrFail($id);
        return Inertia::render('Fees/ReceiptStudents/Add',[
            'student' => $student
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
        $receipt = ReceiptStudents::with('student')->findOrFail($id);
        return Inertia::render('Fees/ReceiptStudents/Edit',[
            'receipt' => $receipt
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

            $receipt = ReceiptStudents::findOrFail($id);
            $receipt->date          = date('Y-m-d');
            $receipt->student_id    = $request->student_id;
            $receipt->debit         = $request->amount;
            $receipt->notes         = $request->notes;
            $receipt->save();

            $fund = FundAccounts::where('receipt_id',$receipt->id)->first();
            $fund->date          = date('Y-m-d');
            $fund->receipt_id    = $receipt->id;
            $fund->debit         = $request->amount;
            $fund->credit        = 0;
            $fund->notes         = $request->notes;
            $fund->save();


            $std_account = StudentAccount::where('receipt_id',$receipt->id)->first();
            $std_account->date          = date('Y-m-d');
            $std_account->type          = 'receipt';
            $std_account->student_id    = $request->student_id;
            $std_account->receipt_id    = $receipt->id;
            $std_account->debit         = 0;
            $std_account->credit        = $request->amount;
            $std_account->notes         = $request->notes;
            $std_account->save();

            DB::commit();
            return redirect()->route('receipt.index')->with(['message' => 'تم تحدديث السند بنجاح']);
        }catch (Exception $e){
            DB::rollback();
            return redirect()->route('receipt.index')->with(['error' => $e->getMessage()]);
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
        ReceiptStudents::destroy($id);
        return redirect()->route('receipt.index')->with(['message' => 'تم حذف السند بنجاح']);

    }
}
