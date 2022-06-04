<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'image',
        'approved_by',
        'uploaded_by',
        'deleted_by',
        'event_date',
        'organized_by',
        'uploaded_by ',
        'status',
    ];

    public function uploadedBy()
    {
        return $this->belongsTo(User::class);
    }
}
