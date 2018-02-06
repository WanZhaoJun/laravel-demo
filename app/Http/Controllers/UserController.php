<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //个人设置页面
    public function setting()
    {
        return view('user.setting');
    }

    //个人设置页面操作
    public function settingStore()
    {

    }

    //个人中心页面
    public function show(User $user)
    {
        // 个人信息 关注数, 粉丝数, 文章数
        $user = $user->withCount(['posts', 'fans', 'stars'])->find($user->id);

        // 文章列表 取创建最新的前十条
        $posts = $user->posts()->orderby('created_at','desc')->take(10)->get();


        // 关注列表 被关注人的信息 关注数, 粉丝数, 文章数
        $stars = $user->stars;
        $susers = User::whereIn('id',$stars->pluck('star_id'))->withCount(['posts', 'fans', 'stars'])->get();


        // 粉丝列表 粉丝的信息, 关注数, 粉丝数, 文章数
        $fans = $user->fans;
        $fusers = User::whereIn('id',$fans->pluck('fan_id'))->withCount(['posts', 'fans', 'stars'])->get();

//        return $posts;
        return view('user/show',compact('user', 'posts', 'susers', 'fusers'));
    }

    // 关注用户
    public function fan()
    {
        return ;
    }

    // 取消关注
    public function unfan()
    {
        return ;
    }
}
