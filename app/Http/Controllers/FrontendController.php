<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBloodRequestRequest;
use App\Models\BloodRequest;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Image;


class FrontendController extends Controller
{
  public function index()
  {
    return view('welcome');
  }
  public function events()
  {
    $events = Event::whereNotNull('status')->latest()->get();
    return view('events',compact('events'));
  }
  public function eventsView($id)
  {
    $event = Event::find($id);
    return view('events-view',compact('event'));
  }

  public function bloodRequestCreate()
  {
    return view('blood-request');
  }

  public function bloodRequestStore(StoreBloodRequestRequest $request)
  {
    

  
    $requestData = $request->all();

    $request_no = date('dmy').time();

    //image
    if ($request->hasFile('official_report')) {
      $file = $request->file('official_report');
      $fileName = $request_no. '.' . $file->getClientOriginalExtension();
      Image::make($request->file('official_report'))
        ->resize(300, 200)
        ->save(storage_path(). '/app/public/requests/' .$fileName);
      $requestData['official_report'] = $fileName;
    }
    //storing data;
    $requestData['request_no'] = $request_no;

    // dd($requestData);
    
    $bloodRequest = BloodRequest::create($requestData);
    

    // sending mail to blood seeker
    if($bloodRequest){
      $data=[
        'request_no'=> $request_no,
        'patient_name'=>$requestData['patient_name'],
        'blood_group' => $requestData['blood_group'],
        'hospital_name'=>$requestData['hospital_name'],
        'contact_name' => $requestData['contact_name'],
      ];
      $user['to'] = $requestData['email'];
      Mail::send('mail.request-mail',$data,function($messages) use ($user){
        $messages->to( $user['to']);
        $messages->subject('Thanks For Using BDMS');
      });

      //Sending mails to admins

      $admins = User::whereIn('role_id', [1, 2])->get();
      $total_requests = BloodRequest::whereNull('approved_by')->whereNull('status')->whereNull('rejected_by')->count();
      foreach ($admins as $admin){
        $data=[
          'admin_name' => $admin['name'],
          'total_requests' => $total_requests,
        ];

        Mail::send('mail.request-admin',$data,function($messages) use ($admin){
          $messages->to($admin['email']);
          $messages->subject('BDMS: New Blood Requests');
        });
      };
      
    }

    

    //returning back
    return redirect()->back()->withMessage('Your request is waiting for confirmation. We will mail you soon. Please note your request id: '.$request_no);
  }
}
