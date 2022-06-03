<?php

namespace App\Http\Controllers;

use App\Models\BloodRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
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

    public function pendingDonorsRequest()
    {
        $pendingDonorsRequests = User::whereNull('approval_status')->whereNull('rejected_by')->get();
        return view('backend.donor-requests', compact('pendingDonorsRequests'));
    }
    public function acceptDonors($id)
    {
        try {
            User::find($id)->update(
                [
                    'approval_status' => 1,
                    'appoved_by' => Auth::id()
                ]
            );
            return redirect()->back()->withMessage('Successfully Approved!');
        } catch (QueryException $q) {
            return redirect()->back()->withErrors('Something Went Wrong!');
        }
    }
    public function rejectDonors($id)
    {
        try {
            User::find($id)->update(
                [
                    'rejected_by' => Auth::id()
                ]
            );
            return redirect()->back()->withMessage('Successfully Declined!');
        } catch (QueryException $q) {
            return redirect()->back()->withErrors('Something Went Wrong!');
        }
    }


    public function index()
    {
        $pendingRequests = Auth::user()->bloodRequests()
            ->where(function ($q) {
                $q->where('blood_request_user.status', '>', 0)
                    ->orWhere('blood_request_user.status', null);
            })
            ->get();

        return view('backend.donor.pending-blood-requests', compact('pendingRequests'));
    }

    public function accept($id)
    {
        //blood:: status 1 = taken
        //blood:: status 2 = Donated
        //blood:: status 0 = Not donated 
        // status 0 is declined
        // status 1 is accepted
        // status2 is donated
        $donor_id = Auth::id();
        //accepted
        DB::table('blood_request_user')->where('user_id', $donor_id)->where('blood_request_id', $id)->update(
            ['status' => 1]
        );
        BloodRequest::find($id)->update([
            'status' => 2
        ]);
        DB::table('users')->where('id', $donor_id)->update(
            ['status' => 1]
        );

        //others are declined
        $others = DB::table('blood_request_user')->where('user_id', $donor_id)->whereNull('status')->get();


        if ($others) {
            foreach ($others as $other) {
                DB::table('blood_request_user')->where('user_id', $donor_id)->whereNull('status')->update(
                    ['status' => 0]
                );
            }
        }

        return redirect()->back()->withMessage('Blood request accepted!');
    }
    public function donated($id)
    {
        try {
            $donor_id = Auth::id();

            //donated
            DB::table('blood_request_user')->where('user_id', $donor_id)->where('blood_request_id', $id)->update(
                ['status' => 2]
            );
            BloodRequest::find($id)->update(
                ['status' => 3],
                ['donor_id' => $donor_id],
                ['completed_at' => Carbon::now()]
            );

            //updating in donor table
            User::find($donor_id)->update(
                [
                    'last_donated' => Carbon::now(),
                    'total_donated' => DB::raw('total_donated + 1'),
                    'status' => null
                ]
            );
            return redirect()->back()->withMessage('Congrats! You can again donate after 3 months');
        } catch (QueryException $q) {
            return redirect()->back()->withMessage();
        }
    }
    public function notDonated($id)
    {
        $donor_id = Auth::id();

        //donated
        DB::table('blood_request_user')->where('user_id', $donor_id)->where('blood_request_id', $id)->update(
            ['status' => 0]
        );
        Auth::user()->update(
            [
                'status' => null,
            ]
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
