<?php

namespace App\Http\Controllers;

use App\Models\BloodRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackendController extends Controller
{
   
    public function index()
    {   
        $donationAvail = Carbon::parse(Carbon::now()->subMonths(3));

       

        $availableDonors = User::whereNull('last_donated')->orWhereDate('last_donated', '<=', $donationAvail)
                        ->count();  
        // dd($availableDonors)  ;

        $bloodRequests = BloodRequest::whereNull('approved_by')->whereNull('status')->whereNull('rejected_by')->count();
        $totalDonors = User::count();
          
        // dd($totalDonors);
        $ongoing = Auth::user()->bloodRequests()->wherePivot('status',1)->first();
        $usersBloodRequests = Auth::user()->bloodRequests()->wherePivotNull('status')->count();
        return view('backend/dashboard',compact(
            
        'usersBloodRequests',
        'ongoing',
        'bloodRequests',
        'totalDonors',
        'availableDonors'
    ));
    }
}
