<?php

namespace App\Http\Controllers;

use App\Models\BloodRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\Return_;

class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function changePassword()
    {
        return view();
    }
    public function profile()
    {
        $user =  Auth::user();
        return view("backend.donor.profile", compact("user"));
    }
    public function profileUpdate(Request $request)
    {
        $user = Auth::user()->id;
    }

    public function list()
    {
        $donors = User::whereNotNull(
            [
                'appoved_by',
                'approval_status',
                'email_verified_at'
            ]
        )->whereNull('rejected_by')->latest()->get();

        return view('backend.donors-list', compact('donors'));
    }

    public function pendingDonorsRequest()
    {
        $pendingDonorsRequests = User::whereNull('approval_status')->whereNull('rejected_by')->get();
        return view('backend.donor-requests', compact('pendingDonorsRequests'));
    }
    public function acceptDonors($id)
    {
        try {
            $done = User::find($id)->update(
                [
                    'approval_status' => 1,
                    'appoved_by' => Auth::id()
                ]
            );
            //sending mail to donors
            $donor = User::where('id', $id)->get();

            $data = [
                'donor_name' => $donor->name,
            ];
            Mail::send('mail.donor-accept', $data, function ($messages) use ($donor) {
                $messages->to($donor->email);
                $messages->subject('Donor reqeust has been approved');
            });

            return redirect()->back()->withMessage('Successfully Approved!');
        } catch (QueryException $q) {
            return redirect()->back()->withErrors('Something Went Wrong!');
        }
    }
    public function rejectDonors(Request $request)
    {
        $request->validate(
            [
                'reject_reason' => ['required']
            ]
        );
        
        if ($request->reason || $request->reason2) {
            try {
                if ($request->reason2) {
                    $request->reason = $request->reason2;
                }
            
                User::findOrFail($request->id)->update(
                    [
                        'rejected_by' => Auth::id(),
                        'reject_reason' => $request->reason,
                    ]
                );
                $donor = User::where('id', $request->id)->get();
                //mail to donor
                $data = [
                    'donor_name' => $donor->name,
                    'reason' => $request->reason,
                ];
                Mail::send('mail.donor-reject', $data, function ($messages) use ($donor) {
                    $messages->to($donor->email);
                    $messages->subject('Donor reqeust has been rejected');
                });

                return redirect()->back()->withMessage('Successfully Declined!');
            } catch (QueryException $q) {
                return redirect()->back()->withErrors('Something Went Wrong!');
            }
        } else {
            return redirect()->back()->withErrors('NO REASON SPECIFIED!PLEASE MARK A REASON TO DECLINE');
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
        // status 3 is deactived
        $donor_id = Auth::id();
        //accepted
        DB::table('blood_request_user')->where('user_id', $donor_id)->where('blood_request_id', $id)->update(
            ['status' => 1]
        );


        //updating request status
        BloodRequest::find($id)->update([
            'status' => 2
        ]);

        //updating donor status
        DB::table('users')->where('id', $donor_id)->update(
            ['status' => 1]
        );

        //others are declined
        $others = DB::table('blood_request_user')
            ->where('user_id', $donor_id)
            ->whereNull('status')->get();
        if ($others) {
            foreach ($others as $other) {
                DB::table('blood_request_user')->where('user_id', $donor_id)->whereNull('status')->update(
                    ['status' => 0]
                );
            }
        }
        //request is removed from others
        $requests = DB::table('blood_request_id')
            ->where('user_id', $donor_id)
            ->whereNull('status')->get();
        if ($requests) {
            foreach ($requests as $request) {
                DB::table('blood_request_user')->where('blood_request_id', $id)->whereNull('status')->delete();
            }
        }

        $donor = User::Where('id', $donor_id)->get();
        $request = BloodRequest::where('id', $id)->get();
        $age = Carbon::parse($donor->profile->dob)->diff(Carbon::now())->y;
        $data = [
            'donor_name' => $donor->name,
            'donor_email' => $donor->email,
            'donor_age' => $age,
            'donor_number' => $donor->profile->phone,
            'donor_gender' => $donor->profile->gender,
            'request_no' => $request->request_no,
            'contact_name' => $request->contact_name,
        ];
        Mail::send('mail.request-donor-accept', $data, function ($messages) use ($request) {
            $messages->to($request->email);
            $messages->subject('Donor accepted your blood seeking request');
        });
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

        return redirect()->back()->withMessage('Marked as not donated');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function donationStore(Request $request)
    {  
        try{

        
        $request->validate([
            'total_donated' => 'required|numeric',
            'last_donated'=> 'required|date'
        ]);

       $user = Auth::id();
       User::findOrFail($user)->update(
        [
            'total_donated'=> $request->total_donated,
            'last_donated' => $request->last_donated
        ]
       );
       return redirect()->back()->withMessage('Successfully Updated!');
    }
    catch (QueryException $q) {
        return redirect()->back()->withInputs()->withErrors('Something went wrong');
    }

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
}
