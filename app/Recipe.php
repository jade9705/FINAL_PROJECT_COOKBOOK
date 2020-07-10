<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public function ingredients()
    {
        return $this->belongsToMany('App\Ingredient')->withPivot(['amount']);
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function steps()
    {
        return $this->hasMany('App\Step');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    public function author()
    {
        return $this->belongsToMany('App\User');
    }
}
