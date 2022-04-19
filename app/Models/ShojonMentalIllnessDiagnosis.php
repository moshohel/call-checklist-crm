<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShojonMentalIllnessDiagnosis extends Model
{
    protected $table = 'shojon_mental_illness_diagnosis';

    protected $fillable = ['illness'];
}
