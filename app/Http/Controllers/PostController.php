<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    /**
     * 文章列表
     * 
     * @return view
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        
        return view('post/index', compact('posts'));
    }

    //文章详情
    public function show(Post $post)
    {
        return view('post/show', compact('post'));
    }

    //创建文章
    public function create()
    {
        return view('post/create');
    }

    public function store()
    {
        $this->validate(request(), [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10'
        ]);

        $post = Post::create(request(['title', 'content']));

        return redirect('/posts');
    }

    //文章编辑
    public function edit(Post $post)
    {
        return view('post/edit', compact('post'));
    }

    public function update(Request $request,Post $post)
    {
        $this->validate($request,[
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);


        $post->update($request->only('title','content'));

        return redirect("/posts/{$post->id}");
    }

    //文章删除
    public function destory(Post $post)
    {
        //TODO 用户身份验证

        $post->delete();

        return redirect('/posts');
    }

    //图片上传
    public function imageUpload(Request $request)
    {

        dd($request->all());
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/'. $path);
    }
}
