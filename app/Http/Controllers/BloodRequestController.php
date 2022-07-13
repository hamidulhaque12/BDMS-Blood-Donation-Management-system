<?php

namespace App\Http\Controllers;

use App\Models\BloodRequest;
use App\Http\Requests\StoreBloodRequestRequest;
use App\Http\Requests\UpdateBloodRequestRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;

class BloodRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function pending()
    {
        $bloodRequests = BloodRequest::whereNull('approved_by')->whereNull('status')->whereNull('rejected_by')->latest()->get();
        return view('backend/blood/not-approved', compact('bloodRequests'));
    }
  

    public function approve($id)
    {
        $bloodRequest = BloodRequest::findOrFail($id);
        // $bloodRequest['approved_by'] = auth()->user()->id;
       $done= $bloodRequest->update([
            'approved_by' => Auth::id()
        ]);
        // sending mail to seekers;
        if($done){
            $data=[
                'request_no'=> $bloodRequest['request_no'],
                'patient_name'=>$bloodRequest['patient_name'],
                'blood_group' => $bloodRequest['blood_group'],
                'hospital_name'=>$bloodRequest['hospital_name'],
                'contact_name' => $bloodRequest['contact_name'],
              ];
              $user['to'] = $bloodRequest['email'];
              Mail::send('mail.request-approve',$data,function($messages) use ($user){
                $messages->to( $user['to']);
                $messages->subject('Your Request has been Approved');
              });
        }
        
        return redirect()->back()->withMessage('Successfully Approved! To assign donor please visit approved blood requests');
        

    }


    public function reject($id)
    {
        $bloodRequest = BloodRequest::findOrFail($id);
        // $bloodRequest['approved_by'] = auth()->user()->id;
       $done=$bloodRequest->update([
            'rejected_by' => Auth::id()
        ]);

        //sending mail
        if($done){
            $data=[
                'request_no'=> $bloodRequest['request_no'],
                'patient_name'=>$bloodRequest['patient_name'],
                'blood_group' => $bloodRequest['blood_group'],
                'hospital_name'=>$bloodRequest['hospital_name'],
                'contact_name' => $bloodRequest['contact_name'],
              ];
              $user['to'] = $bloodRequest['email'];
              Mail::send('mail.request-reject',$data,function($messages) use ($user){
                $messages->to( $user['to']);
                $messages->subject('Your Request has been Rejected');
              });
        }
        return redirect()->back()->withMessage('Rejected!');
    }


    public function allRequests()
    {
        $bloodRequests = BloodRequest::whereNotNull('approved_by')->latest()->get();
        return view('backend/blood/all', compact('bloodRequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function assignIndex(BloodRequest $bloodRequest)
    {
        $donationAvail = Carbon::parse(Carbon::now()->subMonths(3));

        $blood_group = $bloodRequest['blood_group'];
        // dd($blood_group);

        $donors = User::where([
                            ['blood_group', $blood_group],
                            ['last_donated', '<=', $donationAvail],
                       ])
                       ->orWhere([
                            ['blood_group', $blood_group],
                            ['rejected_by', null],
                            ['last_donated', null]
                       ])
                       ->whereNull('status')
                       ->latest()
                       ->get();    
                       
        return view('backend.blood.assign-index', compact('donors', 'bloodRequest'));
    }


    public function assignDonor(Request $request, BloodRequest $bloodRequest)
    {
        // dd($request);
        // $bloodRequest->donor()->attach( $request->donor_ids);
         $bloodRequest->donors()->attach($request->donor_ids);
         $bloodRequest->update([
            'status' => 1
        ]);
        return redirect()->route('blood-request-all')->withMessage('Successfully Assigned!');         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBloodRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BloodRequest  $bloodRequest
     * @return \Illuminate\Http\Response
     */
    public function show(BloodRequest $bloodRequest)
    {
        return view('backend/blood/view', compact('bloodRequest'));
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
