<?php

namespace App;

class Fan extends Model
{
    //粉丝用户
    public function fuser()
    {
        return $this->hasOne('App\User','fan_id');
    }

    //关注用户
    public function suser()
    {
        return $this->hasOne('App\User', 'star_id');
    }
}
