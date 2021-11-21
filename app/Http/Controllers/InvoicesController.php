<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceDetails;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoice  = Invoice::with(['customer', 'detail'])->orderBy('created_at', 'DESC')->paginate(10);
        return view('invoice.index', compact('invoice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::orderBy('created_at', 'DESC')->get();
        return view('invoice.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'customer_id' => 'required|exists:customers,id'
        ]);

        try {
            $invoice = Invoice::create([
                'customer_id' => $request->customer_id,
                'total' => 0
            ]);

            return redirect(route('invoice.edit', ['id' => $invoice->id]));
        } catch(\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
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
        $invoice = Invoice::with(['customer', 'detail'])->find($id);
        return view('invoice.edit', compact('invoice'));
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

        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer'
        ]);

        try {
            $invoice = Invoice::find($id);
            $invoice_detail = $invoice->detail();
            if ($invoice_detail) {
                $invoice_detail->update([
                    'qty' => $invoice_detail->qty
                ]);
            } else {
                Invoice_detail::create([
                    'invoice_id' => $invoice->id,
                    'product' => $invoice_detail->product,
                    'price' => $invoice_detail->price,
                    'qty' => $invoice_detail->qty
                ]);
            }

            return redirect()->back()->with(['success' => 'SUCCES!']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
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
        $invoice = Invoice::find($id);
        $invoice->delete();
        return redirect()->back()->with(['success' => 'Data deleted!']);
    }

    public function generateInvoice($id)
    {
        $invoice = Invoice::with(['customer', 'detail',])->find($id);
        $pdf = PDF::loadView('invoice.print', compact('invoice'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
