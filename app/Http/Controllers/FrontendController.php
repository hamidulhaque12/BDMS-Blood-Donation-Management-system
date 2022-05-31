<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBloodRequestRequest;
use App\Models\BloodRequest;
use App\Models\Event;
use Illuminate\Http\Request;
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
    $request_no = "80".time();

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
    
    BloodRequest::create($requestData);
    

    //returning back
    return redirect()->back()->withMessage('Your request is waiting for confirmation. We will mail you soon. Please note your request id: '.$request_no);
  }
}
