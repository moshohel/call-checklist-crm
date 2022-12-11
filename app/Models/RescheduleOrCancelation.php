<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RescheduleOrCancelation extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'unique_id',
        'phone_number',
        'reason',
        'previous_session_time',
        'previous_session_date',
        'requested_session_time',
        'requested_session_date',
        'reshedule_request',
        'cancelation_request',
        'therapist_or_psychiatrist',
        'therapist_or_psychiatrist_user_id',
        'status',
    ];
}
