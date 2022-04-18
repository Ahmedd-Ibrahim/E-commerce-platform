<?php

namespace App\Http\Controllers;

use App\Models\VariationType;
use App\Http\Requests\StoreVariationTypeRequest;
use App\Http\Requests\UpdateVariationTypeRequest;

class VariationTypeController extends Controller
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
     * @param  \App\Http\Requests\StoreVariationTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVariationTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VariationType  $variationType
     * @return \Illuminate\Http\Response
     */
    public function show(VariationType $variationType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VariationType  $variationType
     * @return \Illuminate\Http\Response
     */
    public function edit(VariationType $variationType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVariationTypeRequest  $request
     * @param  \App\Models\VariationType  $variationType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVariationTypeRequest $request, VariationType $variationType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VariationType  $variationType
     * @return \Illuminate\Http\Response
     */
    public function destroy(VariationType $variationType)
    {
        //
    }
}
