<?php

namespace App\Http\Controllers\Backend\Fees;

use App\Http\Controllers\Controller;
use App\Models\FundAccounts;
use App\Models\PaymentFees;
use App\Models\ReceiptStudents;
use App\Models\Student;
use App\Models\StudentAccount;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment = PaymentFees::with('student')->latest()->get();
        return Inertia::render('Fees/PaymentFees/Index',[
           'payment' => $payment
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

            $payment = new PaymentFees();
            $payment->date          = date('Y-m-d');
            $payment->student_id    = $request->student_id;
            $payment->amount         = $request->amount;
            $payment->notes         = $request->notes;
            $payment->save();

            $fund = new FundAccounts();
            $fund->date          = date('Y-m-d');
            $fund->payment_id    = $payment->id;
            $fund->debit         = 0;
            $fund->credit        = $request->amount;
            $fund->notes         = $request->notes;
            $fund->save();


            $std_account = new StudentAccount();
            $std_account->date          = date('Y-m-d');
            $std_account->type          = 'payment';
            $std_account->student_id    = $request->student_id;
            $std_account->payment_id    = $payment->id;
            $std_account->debit         = $request->amount;
            $std_account->credit        = 0;
            $std_account->notes         = $request->notes;
            $std_account->save();

            DB::commit();
            return redirect()->route('payment_fees.index')->with(['message' => 'تم اضافة السند بنجاح']);
        }catch (Exception $e){
            DB::rollback();
            return redirect()->route('payment_fees.index')->with(['error' => $e->getMessage()]);
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
        return Inertia::render('Fees/PaymentFees/Add',[
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
        $payment = PaymentFees::with('student')->findOrFail($id);
        return Inertia::render('Fees/PaymentFees/Edit',[
            'payment' => $payment
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

            $payment = PaymentFees::findOrFail($id);
            $payment->date          = date('Y-m-d');
            $payment->student_id    = $request->student_id;
            $payment->amount         = $request->amount;
            $payment->notes         = $request->notes;
            $payment->save();

            $fund = FundAccounts::where('payment_id',$payment->id)->first();
            $fund->date          = date('Y-m-d');
            $fund->payment_id    = $payment->id;
            $fund->debit         = 0;
            $fund->credit        = $request->amount;
            $fund->notes         = $request->notes;
            $fund->save();


            $std_account = StudentAccount::where('payment_id',$payment->id)->first();
            $std_account->date          = date('Y-m-d');
            $std_account->type          = 'payment';
            $std_account->student_id    = $request->student_id;
            $std_account->payment_id    = $payment->id;
            $std_account->debit         = $request->amount;
            $std_account->credit        = 0;
            $std_account->notes         = $request->notes;
            $std_account->save();

            DB::commit();
            return redirect()->route('payment_fees.index')->with(['message' => 'تم تحدديث السند بنجاح']);
        }catch (Exception $e){
            DB::rollback();
            return redirect()->route('payment_fees.index')->with(['error' => $e->getMessage()]);
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
        PaymentFees::destroy($id);
        return redirect()->route('payment_fees.index')->with(['message' => 'تم حذف السند بنجاح']);

    }
}
