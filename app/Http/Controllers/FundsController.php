<?php

namespace App\Http\Controllers;

use App\Models\Funds;
use App\Models\User;
use Illuminate\Http\Request;

class FundsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('app.create-fund',compact('users'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Funds::checkAndCollect($request);
        $record = Funds::create($data);
        return $record
        ? redirect(route('setting'))->with('success', 'Model created successfully!')
        : redirect()->with('error', 'Fail! Try again');
    }

    /**
     * Display the specified resource.
     */
    public function show(Funds $funds)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Funds $funds)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Funds $funds)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Funds $funds)
    {
        //
    }
}
