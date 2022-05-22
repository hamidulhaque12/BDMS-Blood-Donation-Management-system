<?php

namespace App\Http\Controllers;

use App\Models\Health_tips;
use App\Http\Requests\StoreHealth_tipsRequest;
use App\Http\Requests\UpdateHealth_tipsRequest;

class HealthTipsController extends Controller
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
     * @param  \App\Http\Requests\StoreHealth_tipsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHealth_tipsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Health_tips  $health_tips
     * @return \Illuminate\Http\Response
     */
    public function show(Health_tips $health_tips)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Health_tips  $health_tips
     * @return \Illuminate\Http\Response
     */
    public function edit(Health_tips $health_tips)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHealth_tipsRequest  $request
     * @param  \App\Models\Health_tips  $health_tips
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHealth_tipsRequest $request, Health_tips $health_tips)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Health_tips  $health_tips
     * @return \Illuminate\Http\Response
     */
    public function destroy(Health_tips $health_tips)
    {
        //
    }
}
