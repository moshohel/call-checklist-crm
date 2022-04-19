<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KprSecondaryReasonForCalling extends Model
{
    protected $table = 'kpr_secondary_reason_for_calling';

    protected $fillable = ['reason'];
}
