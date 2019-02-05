<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateInvoiceRequest;
use App\Invoice;
use DB;
use Exception;
use Illuminate\Http\Request;

class MyInvoiceController extends Controller
{
    /**
     * Display the data in the table.
     *
     * @return \Illuminate\Http\Response
     */
    public function data() 
    {   
        $invoices = Invoice::perCompany()->purchases()->render()->get();

        return response()->json([
            'total' => $invoices->count(),
            'rows' => $invoices
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.my-invoices.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.my-invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInvoiceRequest $request)
    {
        $data = $request->validated();
        $summary = Invoice::calculateSummary($data['items']);

        DB::beginTransaction();

        try {
            $invoice = Invoice::create([
                'serie' => $data['serie'], 
                'correlative' => $data['correlative'],
                'currency_code' => $data['currency_code'], 
                'creation_date' => $data['creation_date'],
                'expiration_date' => $data['expiration_date'] ?? NULL,
                'customer_id' => $data['customer_id'],
                'status' => $data['status'],
                'igv_percent' =>  $summary['igv_percent'],
                'subtotal' => $summary['subtotal'],
                'tax' => $summary['tax'],
                'total' => $summary['total'],
                'created_by' => $request->user()->id,
                'company_id' => $request->user()->company_id
            ]);

            $invoice->items()->createMany($data['items']);

            DB::commit();

            return response()->json(['redirect' => route('admin.my-invoices.show', $invoice->id)]);
        }
        catch(Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 500);
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
