<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Notifications\EmailVerificationNotification;
use App\Notifications\sendProfileRegisterNotification;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use Notifiable;
    use Uuids;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName','lastName', 'email', 'password','verificationToken','dob','street_address','city','state'
    ];
 /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'verificationToken',
    ];


    public function sendEmailVerificationNotification()
    {
        $this->notify(new EmailVerificationNotification($this->verificationToken));
    }
    public function sendProfileRegisterNotification()
    {
        $this->notify(new sendProfileRegisterNotification($this->verificationToken));
    }


}
