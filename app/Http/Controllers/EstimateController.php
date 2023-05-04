<?php

namespace App\Http\Controllers;

use App\Models\Estimate;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class EstimateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function all()
    {
        session()->forget('isEditing');
        $estimates = estimate::with(['orders','customer'])->orderByDesc('id')->get();
        foreach ($estimates as $estimate) {
            $estimate['total'] = $estimate->getEstimateTotal($estimate->id);
        }
        return view('app.sales',compact('estimates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createEstimate()
    {
        return view('app.create-estimate');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function downloadEstimate(Estimate $estimate)
    {
        
        $estimate->load('customer','orders.item');
        $estimate['total'] = $estimate->getEstimateTotal($estimate->id);
        
        $pdf = Pdf::loadView('pdf.estimate',compact('estimate'));
        return $pdf->download($estimate->estimate_no.'.pdf');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estimate $estimate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estimate $estimate)
    {
        session()->put('estimate', $estimate);
        session()->put('isEditing', true);
        return view('app.edit-estimate');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estimate $estimate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estimate $estimate)
    {
        //
    }
}
