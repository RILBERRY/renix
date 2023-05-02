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
        $estimate = Estimate::all();
        return view('app.sales');
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
        
        $pdf = Pdf::loadView('pdf.estimate');
        return $pdf->download('invoice.pdf');
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
        //
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
