<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $pendingRequests= Auth::user()->bloodRequests()->wherePivot('status', 1)->orWherePivot('status', 2)->orWherePivotNull('status')->get();
        return view('backend.donor.pending-blood-requests', compact('pendingRequests'));
    }

    public function accept($id)
    {
        // status 0 is declined
        // status 1 is accepted
        // status2 is donated
        $donor_id = Auth::id();

        //accepted
        DB::table('blood_request_user')->where('user_id', $donor_id)->where('blood_request_id',$id)->update(
            ['status' => 1]
        );

        //others are declined
        $others = DB::table('blood_request_user')->where('user_id', $donor_id)->whereNull('status')->first();
        if($others){
            DB::table('blood_request_user')->where('user_id', $donor_id)->whereNull('status')->update(
                ['status' => 0]
            );
        }

        return redirect()->back()->withMessage('Blood request accepted!');


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

    public function activeDonors()
    {
        return view('backend/active-donors');
    }
}
