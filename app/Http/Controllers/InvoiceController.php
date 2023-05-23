<?php

namespace App\Http\Controllers;

use App\Models\Estimate;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function createInvoice(Estimate $estimate)
    {
        $estimate->load(['customer','orders']);
        $invoice = new Invoice();
        $invoice->inv_no = $this->generateEstimateNo();
        $invoice->customer_id = $estimate->customer->id;
        $invoice->tax = $estimate->customer->tin?$this->getTaxForInv($estimate):0;
        $invoice->status = 'PENDING';
        $invoice->save();
        foreach($estimate->orders as $order){
            $order->update(['invoice_id'=>$invoice->id]);
        }
        return redirect(route('view-invoice',$invoice));
    }
    protected function getTaxForInv($estimate)
    {
        $total = $estimate->getEstimateTotal($estimate->id);
        $tax = $total * 0.08;
        return $tax * 100;
    }

    protected function generateEstimateNo()
    {
        $lastEstimate = Invoice::orderByDesc('inv_no')->first();
        $lastCodeNumber = 0;
        
        if ($lastEstimate) {
            $lastCodeNumber = (int)substr($lastEstimate->inv_no, -6);
        }
        
        $newCodeNumber = $lastCodeNumber + 1;
        $newCode = 'RNX-INV-' . str_pad($newCodeNumber, 6, '0', STR_PAD_LEFT);
        
        return $newCode;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function viewInvoice(Invoice $invoice)
    {
        $invoice->load(['customer','orders']);
        dd($invoice);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
