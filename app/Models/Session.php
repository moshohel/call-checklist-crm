<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $primaryKey = "id";

    protected $fillable = [
        'referr_to',
        'referr_from',
        'name',
        'unique_id',
        'age',
        'phone_number',
        'phone_number',
        'phone_number_two',
        'reason_for_therapy',
        'call_data',
        'call_status',
        'session_time',
        'session_date',
        'communication_medium',
        'appointment_status_flag',
        'reshedule_request',
        'cancelation_request',
        'Session_Number',
        'appointment_status',
        'appointment_decline_reason',
        'appointment_other_reason',
        'referred_therapist_or_psychiatrist',
        'referred_therapist_or_psychiatrist_user_name',
        'referred_therapist_or_psychiatrist_user_id',
        'session_taken'
    ];

    public function patient()
    {
        return $this->hasOne('App\Patient', 'unique_id', 'unique_id');
    }
}
