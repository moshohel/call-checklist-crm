<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public $fillable = [
        'phone_number',
        'name',
        'caller_id',
        'sex',
        'age',
        'occupation',
        'socio_economic_status',
        'location',
        'hearing_source',
        'caller_description'
    ];
}
