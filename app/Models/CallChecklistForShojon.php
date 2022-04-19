<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallChecklistForShojon extends Model
{
    protected $table = 'call_checklist_for_shojon';

    protected $guarded = ['created_at','updated_at'];

   /* public function scopeDayType($query, $range_type)
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
