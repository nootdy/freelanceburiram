<?php

namespace App\Http\Controllers;

use App\Repeater;
use Illuminate\Http\Request;

class RepeaterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if ($request->has('pos')) {
           foreach ($request->input('pos') as $key => $repeater) {

               $repeaters = new Repeater;
               $repeaters->position = $repeater['position'];
               $repeaters->amount = $repeater['amount'];
               $repeaters->job_category = $repeater['job_category'];
               $repeaters->save();

           }
        }

        return redirect()->route('home')->with('success', 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Repeater  $repeater
     * @return \Illuminate\Http\Response
     */
    public function show(Repeater $repeater)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Repeater  $repeater
     * @return \Illuminate\Http\Response
     */
    public function edit(Repeater $repeater)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Repeater  $repeater
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repeater $repeater)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Repeater  $repeater
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repeater $repeater)
    {
        //
    }
}
