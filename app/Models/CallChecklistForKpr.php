<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallChecklistForKpr extends Model
{
    protected $table = 'call_checklist_for_kpr';

    protected $fillable = [
        'referrence_id',
        'phone_number',
        'agent',
        'call_received',
        'call_started',
        'call_ended',
        'caller_name',
        'sex',
        'age',
        'occupation',
        'location',
        'call_type',
        'caller',
        'risk_level',
        'main_reason_for_calling',
        'secondary_reason_for_calling',
        'caller_experience',
        'client_referral',
        'caller_description',
        'is_synced',
        'sync_try_count'
    ];

  /*  public function scopeDayType($query, $range_type)
    {
        switch ($range_type) {
            case "all":
                return $query;
            case "last_day":
                return $query->lastDay();
            default:
                return $query->lastWeek();
        }
    }*/
}
