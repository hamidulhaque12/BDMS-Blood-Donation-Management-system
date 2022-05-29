<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBloodRequestRequest;
use App\Models\BloodRequest;
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
    return view('events');
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
    if ($request->hasFile('image')) {
      $file = $request->file('image');
      $fileName = $request_no. '.' . $file->getClientOriginalExtension();
      Image::make($request->file('image'))
        ->resize(300, 200)
        ->save(storage_path(). '/app/public/requests/' .$fileName);
      $requestData['image'] = $fileName;
    }
    //storing data;
    $requestData['request_no'] = $request_no;

    // dd($requestData);
    
    BloodRequest::create($requestData);

    //returning back
    return redirect()->back()->withMessage('Your request is waiting for confirmation. We will mail you soon <br> Please note your request id: '.'<mark>'.$request_no.'<mark/>');
  }
}
