<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_name',
        'contact_name',
        'gender',
        'blood_group',
        'blood_unit',
        'hospital_name',
        'division',
        'district',
        'thana',
        'postOffice',
        'postCode',
        'email',
        'phone',
        'phone2',
        'additional',
        'reason',
        'completed_at',
        'status',
        'request_no',
        'appoved_by',
        'require_date',
        'official_report'
    ];
}
