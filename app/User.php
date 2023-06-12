<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */

    protected $table = "vicidial_users";
    protected $primaryKey = "user";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'user', 'pass', 'user_level', 'full_name', 'user_group', 'image', 'user_id', 'email', 'age', 'gender', 'designation', 'job_location', 'contact_number', 'contact_number_has_whatsapp', 'e_signature', 'bmdc_reg_number',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pass', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->pass;
    }
}
