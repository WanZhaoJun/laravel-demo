<?php

namespace App\Http\Controllers;


class LoginController extends Controller
{
    //登陆页面
    public function index()
    {
        return view('login.index');
    }

    //登陆行为
    public function login()
    {
        //验证
        $this->validate(request(),[
            'email' => 'required|email',
            'password' => 'required|min:5|max:10',
            'is_remember' => 'integer'
        ]);
        //逻辑
        $user = request(['email','password']);
        $remember = request('is_remember');

        if (\Auth::attempt($user,$remember))
        {
            return redirect('/posts');
        }

        return \Redirect::back()->withErrors('用户名密码错误');
    }

    //登陆行为
    public function logout()
    {
        \Auth::logout();
        return redirect('/login');
    }
}
