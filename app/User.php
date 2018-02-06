<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //HasApiTokens 用于passport的一个Trait
    use HasApiTokens, Notifiable;

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

    // 用户文章列表
    public function posts()
    {
        return $this->hasMany('App\Post', 'user_id');
    }

    // 关注我的人
    public function fans()
    {
        return $this->hasMany('App\Fan', 'star_id');
    }

    // 我关注人
    public function stars()
    {
        return $this->hasMany('App\Fan', 'fan_id');
    }

    //关注某人
    public function doFan($uid)
    {
        $fan = new \App\Fan();
        $fan->star_id = $uid;

        return $this->stars()->save($fan);
    }

    //取消关注
    public function doUnFan($uid)
    {
        $fan = new \App\Fan();
        $fan->star_id = $uid;

        return $this->stars()->delete($fan);
    }

    // 当前用户关注了uid
    public function hasStar($uid)
    {
        return $this->stars()->where('star_id', $uid)->count();
    }

    // 当前用户是否被uid关注了
    public function hasFan($uid)
    {
        return $this->fans()->where('fan_id', $uid)->count();
    }
}
