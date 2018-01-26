<?php

namespace App\Http\Controllers;

use App\Zan;
use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class PostController extends Controller
{
    /**
     * 文章列表
     * 
     * @return view
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->withCount(['comments','zans'])->paginate(6);
        
        return view('post/index', compact('posts'));
    }

    //文章详情
    public function show(Post $post)
    {
        $post->load('comments');
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

        $user_id = \Auth::id();
        $params = array_merge(request(['title','content']),compact('user_id'));

        $post = Post::create($params);

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

        //权限判断
        $this->authorize($post);

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

        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/'. $path);
    }

    //提交评论
    public function comment(Post $post)
    {
        //验证
        $this->validate(request(),[
            'content' => 'required|min:3'
        ]);

        //逻辑
        $comment = new Comment();
        $comment->user_id = \Auth::id();
        $comment->content = request('content');
        $post->comments()->save($comment);

        //返回
        return back();
    }

    //点赞
    public function zan(Post $post)
    {
        $param = [
            'user_id' => \Auth::id(),
            'post_id' => $post->id
        ];

        Zan::firstOrCreate($param);

        return back();
    }

    //取消赞
    public function unzan(Post $post)
    {
        $post->zan(\Auth::id())->delete();

        return back();
    }
}
