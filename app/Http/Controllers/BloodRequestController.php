<?php

namespace App\Http\Controllers;

use App\Models\BloodRequest;
use App\Http\Requests\StoreBloodRequestRequest;
use App\Http\Requests\UpdateBloodRequestRequest;
use Illuminate\Support\Facades\Auth;

class BloodRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bloodRequests = BloodRequest::whereNull('approved_by')->whereNull('rejected_by')->latest()->get();
        return view('backend/blood/not-approved',compact('bloodRequests'));
    }

    public function approve($id)
    {
        $bloodRequest = BloodRequest::findOrFail($id);
        // $bloodRequest['approved_by'] = auth()->user()->id;
        $bloodRequest->update([
            'approved_by' => Auth::id()
        ]);
        return redirect()->back()->withMessage('Successfully Approved!');
    }
    public function reject($id)
    {
        $bloodRequest = BloodRequest::findOrFail($id);
        // $bloodRequest['approved_by'] = auth()->user()->id;
        $bloodRequest->update([            
            'rejected_by' => Auth::id()
        ]);
        return redirect()->back()->withMessage('Rejected!');
    }


    public function allRequests()
    {
        $bloodRequests = BloodRequest::whereNotNull('approved_by')->whereNotNull('rejected_by')->latest()->get();
        return view('backend/blood/all',compact('bloodRequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBloodRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBloodRequestRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BloodRequest  $bloodRequest
     * @return \Illuminate\Http\Response
     */
    public function show(BloodRequest $bloodRequest)
    {
        return view('backend/blood/view',compact('bloodRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BloodRequest  $bloodRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(BloodRequest $bloodRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBloodRequestRequest  $request
     * @param  \App\Models\BloodRequest  $bloodRequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBloodRequestRequest $request, BloodRequest $bloodRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BloodRequest  $bloodRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(BloodRequest $bloodRequest)
    {
        //
    }
}
