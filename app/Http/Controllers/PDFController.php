<?php

namespace App\Http\Controllers;

use App\Models\BloodRequest;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;



class PDFController extends Controller
{


    //protecting datas
    private function donor()
    {
        $role_id = 3;
        if (Auth::user()->role_id == $role_id) {
            return true;
        } else {
            return false;
        }
    }
    protected function protect()
    {
        if ($this->donor()) {
            abort(404);
        };
    }

    // $this->protect();

    // download seeker profile
    public function seekerProfile($id)
    {
        $profile = DB::table('blood_requests')->where('id', $id)->get()->first();
        $pdf = PDF::loadView('pdf.seeker', compact('profile'));
        return $pdf->download('seekerprofile.pdf');
    }

    //monthly report
    public function monthReport()
    {
        $this->protect();
        $date = \Carbon\Carbon::now();

        $lastMonth =  $date->subMonth()->format('m');
        $lastMonthName =  $date->subMonth()->format('m/Y');
        $bloodReports = BloodRequest::whereMonth('created_at', '=', $lastMonth)
            ->whereNotNull('approved_by')
            ->orWhereNotNull('rejected_by')->get();
        // a+ 
        $aP_blood = BloodRequest::whereMonth('created_at', '=', $lastMonth)

            ->where('blood_group', 'A+')
            ->get();
        // b+
        $bP_blood = BloodRequest::whereMonth('created_at', '=', $lastMonth)

            ->where('blood_group', 'B+')
            ->get();
        // o+
        $oP_blood = BloodRequest::whereMonth('created_at', '=', $lastMonth)

            ->where('blood_group', 'O+')
            ->get();
        // ab+
        $abP_blood = BloodRequest::whereMonth('created_at', '=', $lastMonth)
            ->whereNotNull('approved_by')
            ->orWhereNotNull('rejected_by')
            ->where('blood_group', 'AB+')
            ->get();
        // a-                        
        $aN_blood = BloodRequest::whereMonth('created_at', '=', $lastMonth)

            ->where('blood_group', 'A-')
            ->get();
        // b-
        $bN_blood = BloodRequest::whereMonth('created_at', '=', $lastMonth)

            ->where('blood_group', 'B-')
            ->get();
        // o-
        $oN_blood = BloodRequest::whereMonth('created_at', '=', $lastMonth)

            ->where('blood_group', 'O-')
            ->get();


        // ab-
        $abN_blood = BloodRequest::whereMonth('created_at', '=', $lastMonth)

            ->where('blood_group', 'AB-')
            ->get();

        // a+
        $aP_donor = User::whereMonth('created_at', '=', $lastMonth)

            ->where('blood_group', 'A+')
            ->get();
        // a+
        $bP_donor = User::whereMonth('created_at', '=', $lastMonth)
            ->where('blood_group', 'A+')
            ->get();
        // ab+
        // o+
        $oP_donor = User::whereMonth('created_at', '=', $lastMonth)

            ->where('blood_group', 'O+')
            ->get();
        // ab+
        $abP_donor = User::whereMonth('created_at', '=', $lastMonth)

            ->where('blood_group', 'AB+')
            ->get();
        // a-                        
        $aN_donor = User::whereMonth('created_at', '=', $lastMonth)

            ->where('blood_group', 'A-')
            ->get();
        // b-
        $bN_donor = User::whereMonth('created_at', '=', $lastMonth)

            ->where('blood_group', 'B-')
            ->get();
        // o-
        $oN_donor = User::whereMonth('created_at', '=', $lastMonth)

            ->where('blood_group', 'O-')
            ->get();


        // ab-
        $abN_donor = User::whereMonth('created_at', '=', $lastMonth)

            ->where('blood_group', 'AB-')
            ->get();


        $eventReports = Event::whereNotNull('approved_by')->whereMonth('created_at', '=', $lastMonth)->get();
        $donorReports = User::whereMonth('created_at', '=', $lastMonth)
            ->whereNotNull('appoved_by')
            ->orWhereNotNull('rejected_by')->get();
        //generating pdf
        $pdf = PDF::loadView('pdf.monthly-report', compact(
            'bloodReports',
            'aP_blood',
            'bP_blood',
            'oP_blood',
            'abP_blood',
            'aN_blood',
            'bN_blood',
            'oN_blood',
            'abN_blood',
            'aP_donor',
            'bP_donor',
            'oP_donor',
            'abP_donor',
            'aN_donor',
            'bN_donor',
            'oN_donor',
            'abN_donor',
            'donorReports',
            'eventReports',
            'lastMonthName'
        ));

        $pdf->setPaper('A4', 'portait');
        $name = 'bdms-report' . $date->subMonth()->format('F') . $date->format('Y') . '.pdf';
        return $pdf->download($name);
    }

    //total report
    public function totalReport()
    {
        $this->protect();
        $bloodReports = BloodRequest::all();
        $donorReports = User::all();
        $eventReports = Event::all();
        $pdf = PDF::loadView('pdf.total-report', compact('bloodReports','eventReports', 'donorReports'));
        $name = 'bdms-total-report'.Carbon::now()->format('d/m/Y').'.pdf';
        return $pdf->download($name);
    }
    //yearly report
    public function yearReport()
    {
        $date = \Carbon\Carbon::now();
        $lastYear =  $date->subYear()->format('Y');
        $bloodReports = BloodRequest::whereYear('created_at', '=', $lastYear)
            ->whereNotNull('approved_by')
            ->orWhereNotNull('rejected_by')->get();
        $donorReports = User::whereYear('created_at', '=', $lastYear)
            ->whereNotNull('appoved_by')
            ->orWhereNotNull('rejected_by')->get();
        $eventReports = Event::whereYear('created_at', '=', $lastYear)
            ->whereNotNull('approved_by')
            ->orWhereNotNull('deleted_by')->get();

        $name = 'bdms-year-report' .$lastYear . '.pdf';
        $pdf = PDF::loadView('pdf.yearly-report', compact('bloodReports','eventReports', 'donorReports','lastYear'));
        return $pdf->download($name);
    }

    //my donation report
    public function myDonation()
    {
        $date = \Carbon\Carbon::now()->format('d-m-Y');
        
        $user = Auth::user();
        $user_id = Auth::id();
        $donations = BloodRequest::where('donor_id',$user_id)->get()->all();
        
        $pdf = PDF::loadView('pdf.myprofile-report', compact('user','donations'));
        $pdf->setPaper('A4', 'protrait');
        $name = 'report-'.'profile-'.'@bdms'.'.pdf';
        return $pdf->download($name);
    }
}
