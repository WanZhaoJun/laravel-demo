@extends('layout.main')

@section('content')

        <div class="alert alert-success" role="alert">
            下面是搜索"中国"出现的文章，共3条
        </div>

        <div class="col-sm-8 blog-main">
            @foreach($posts as $post)
                <div class="blog-post">
                    <h2 class="blog-post-title"><a href="/posts/58" >自动放大舒服的撒</a></h2>
                    <p class="blog-post-meta">May 11, 2017 by <a href="#">Mark</a></p>

                    <p>我们坚持一个中国我们坚持一个中国我们坚持一个中国我们坚持一个中国我们坚持一个中国我们坚持一个中国我们坚持一个中国我们坚持一个中国我们坚持一个中国我们坚持一个中国我们坚持一个中国我们坚持一个中国我们坚持...</p>
                </div>
            @endforeach
        </div><!-- /.blog-main -->
<!-- /.row -->

@endsection