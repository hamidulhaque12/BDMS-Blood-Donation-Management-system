<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
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
        $others = DB::table('blood_request_user')->where('user_id', $donor_id)->whereNull('status')->get();
    
       
        if($others){
            foreach($others as $other)
            {
                DB::table('blood_request_user')->where('user_id', $donor_id)->whereNull('status')->update(
                    ['status' => 0]
                );

            }
         
        }

        return redirect()->back()->withMessage('Blood request accepted!');


    }
    public function donated($id)
    {
        $donor_id = Auth::id();
       
        //donated
        DB::table('blood_request_user')->where('user_id', $donor_id)->where('blood_request_id',$id)->update(
            ['status' => 2]
        );

        //updating in donor table
        User::find($donor_id)->update(
            [
                'last_donated' => Carbon::now(),
                'total_donated'=> DB::raw('total_donated + 1'), 
            ]
        );

        return redirect()->back()->withMessage('Congrats! You can again donate after 3 months');
    }
    public function notDonated($id)
    {
        $donor_id = Auth::id();

        //donated
        DB::table('blood_request_user')->where('user_id', $donor_id)->where('blood_request_id',$id)->update(
            ['status' => 0]
        );

        //others are declined

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
