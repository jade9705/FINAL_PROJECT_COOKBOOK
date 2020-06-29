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
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function to_follow()
    {
        return $this->belongsToMany('App\User', 'followers', 'current_user_id', 'user_id');
    }

    public function user_followers()
    {
        return $this->belongsToMany('App\User', 'followers', 'user_id', 'current_user_id');
    }

    public function recipes()
    {
        return $this->belongsToMany('App\Recipe');
    }
}
