@extends('layout.main')

@section('content')
    <div class="col-sm-8">
        <blockquote>
            <p><img src="/storage/9f0b0809fd136c389c20f949baae3957/iBkvipBCiX6cHitZSdTaXydpen5PBiul7yYCc88O.jpeg" alt="" class="img-rounded" style="border-radius:500px; height: 40px"> {{$user->name}}
            </p>


            <footer>关注：{{$user->stars_count}}｜粉丝：{{$user->fans_count}}｜文章：{{$user->posts_count}}</footer>
        </blockquote>
    </div>
    <div class="col-sm-8 blog-main">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    @foreach($posts as $post)
                    <div class="blog-post" style="margin-top: 30px">
                        <?php \Carbon\Carbon::setLocale('zh');?>
                        <p class=""><a href="/user/{{$user->id}}">{{$user->name}}</a> {{$post->created_at->diffForHumans()}} </p>
                        <p class=""><a href="/posts/{{$post->id}}" >{{$post->title}}</a></p>


                        <p><p>{!! str_limit($post->content, 30, '......') !!}</p>
                    </div>
                    @endforeach
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    @foreach($susers as $suser)
                    <div class="blog-post" style="margin-top: 30px">
                        <p class="">{{$suser->name}}</p>
                        <p class="">关注：{{$suser->stars_count}} | 粉丝：{{$suser->fans_count}}｜ 文章：{{$suser->posts_count}}</p>

                        <div>
                            <button class="btn btn-default like-button" like-value="1" like-user="6" _token="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy" type="button">取消关注</button>
                        </div>

                    </div>
                    @endforeach
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                    @foreach($fusers as $fuser)
                        <div class="blog-post" style="margin-top: 30px">
                            <p class="">{{$fuser->name}}</p>
                            <p class="">关注：{{$fuser->stars_count}} | 粉丝：{{$fuser->fans_count}}｜ 文章：{{$fuser->posts_count}}</p>
                        </div>
                    @endforeach
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>


    </div><!-- /.blog-main -->
@endsection