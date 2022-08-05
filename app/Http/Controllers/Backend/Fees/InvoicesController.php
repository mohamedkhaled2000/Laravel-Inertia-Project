<?php

namespace App\Http\Controllers\Backend\Fees;

use App\Http\Controllers\Controller;
use App\Models\Fees;
use App\Models\Invoices;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoices::with('student','grade','class_room','fee')->latest()->get();
        return Inertia::render('Fees/Invoices/IndexInvoices',[
            'invoices'      => $invoices,
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
            foreach ($request->fee as $item){
                $invoice = new Invoices();  // Store Invoices
                $invoice->invoice_date = date("Y-m-d");
                $invoice->student_id = $request->student_id;
                $invoice->grade_id = $request->grade_id;
                $invoice->class_room_id = $request->class_room_id;
                $invoice->fee_id =  explode(':',implode(':',$item))[0];
                $invoice->notes = $request->notes;
                $invoice->save();


                $account = new StudentAccount();  // Store Student Accouent
                $account->date = date("Y-m-d");
                $account->type = 'invoice';
                $account->invoice_id = $invoice->id;
                $account->student_id = $request->student_id;
                $account->debit = explode(':',implode(':',$item))[1];
                $account->credit = 0.0;
                $account->notes = $request->notes;
                $account->save();

            }

            DB::commit();

            return redirect()->route('invoices.index')->with(['success' => 'تم الاضافة بنجاح']);
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->route('invoices.index')->with(['error' => $e->getMessage()]);

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
        $fees = Fees::where('class_room_id',$student->class_room_id)->get();
        return Inertia::render('Fees/Invoices/CreateInvoice',[
            'student'   => $student,
            'fees'      => $fees,
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
        $invoice = Invoices::with('student','fee')->findOrFail($id);
        $fee = Fees::where('class_room_id',$invoice->class_room_id)->get();
        return Inertia::render('Fees/Invoices/EditInvoice',[
            'invoice' => $invoice,
            'fee' => $fee,
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

            $invoice = Invoices::findOrFail($id);  // Store Invoices
            $invoice->fee_id =  $request->fee_id;
            $invoice->amount =  $request->amount;
            $invoice->notes = $request->notes;
            $invoice->save();


            $account = StudentAccount::where('invoice_id',$id)->first();  // Store Student Accouent
            $account->debit = $request->amount;
            $account->notes = $request->notes;
            $account->save();

            DB::commit();

            return redirect()->route('invoices.index')->with(['success' => 'تم التحديث بنجاح']);
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->route('invoices.index')->with(['error' => $e->getMessage()]);

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
        Invoices::destroy($id);
        return back()->with(['success' => 'تم الحذف بنجاح']);

    }
}
