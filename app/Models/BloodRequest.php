<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BloodRequest extends Model
{
    use HasFactory;
    use SoftDeletes;
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
        'approved_by',
        'require_date',
        'official_report',
        'rejected_by'
    ];
   
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function donors()
    {
       return $this->belongsToMany(User::class)->withTimestamps();
    }
    
}
