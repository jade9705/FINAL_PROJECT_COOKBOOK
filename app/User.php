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
        'first_name', 'surname', 'email', 'password',
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
       //'current_user_id' is 'logged_user_id' and 'user_id' is 'profile_id'
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

    //new just for test
    public function createrecipes()
    {
        return $this->hasMany('App\Recipe');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
