@extends('layouts.main')

@section('content')

<main class="blog" style="border-top: 1px solid #c0c1c6">
    <div class="container" >
        <h1 class="edica-page-title" data-aos="fade-up">Список електроніки</h1>
        <section class="featured-posts-section">
            <div class="row">
                @foreach($posts as $post)
                <div class="col-md-4 fetured-post blog-post mb-4" data-aos="fade-up">
                    <div class="blog-post-thumbnail-wrapper">
                        <img src="{{'storage/' . $post->main_image }}" alt="blog post">
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="blog-post-category">{{$post->category->title}}</p>
                        @auth()
                        <form action="{{route('post.like.store', $post->id)}}" method="POST">
                            @csrf
                            <span>{{$post->liked_user_count}}</span>
                            <button type="submit" class="border-0 bg-transparent">
                                @if(auth()->user()->likedPosts->contains($post->id))
                                    <i class="fas fa-heart"></i>
                                @else
                                    <i class="far fa-heart"></i>
                                @endif
                            </button>
                        </form>
                        @endauth
                        @guest()
                            <div>
                                <span>{{$post->liked_user_count}}</span>
                                <i class="far fa-heart"></i>
                            </div>

                        @endguest
                    </div>
                    <a href="{{route('post.show', $post->id)}}" class="blog-post-permalink">
                        <h6 class="blog-post-title">{{$post->title}}</h6>
                    </a>
                </div>
                @endforeach

            </div>
            <div class="row">
                <div class="mx-auto" style="margin-top: -50px; margin-bottom: 100px">
                    {{$posts->links()}}
                </div>
            </div>
        </section>
        <div class="row">
            <div class="col-md-8">
                <section>
                    <div class="row blog-post-row">
                        @foreach($randomPosts as $post)
                        <div class="col-md-6 blog-post" data-aos="fade-up">
                            <div class="blog-post-thumbnail-wrapper">
                                <img src="{{'storage/' . $post->main_image}}" alt="blog post">
                            </div>
                            <p class="blog-post-category">{{$post->category->title}}</p>
                            <a href="{{route('post.show', $post->id)}}" class="blog-post-permalink">
                                <h6 class="blog-post-title">{{$post->title}}</h6>
                            </a>
                        </div>
                        @endforeach
{{--                        <div class="col-md-6 blog-post" data-aos="fade-up">--}}
{{--                            <div class="blog-post-thumbnail-wrapper">--}}
{{--                                <img src="{{asset('assets/images/blog_5.jpg')}}" alt="blog post">--}}
{{--                            </div>--}}
{{--                            <p class="blog-post-category">Blog post</p>--}}
{{--                            <a href="{{route('post.show', $post->id)}}" class="blog-post-permalink">--}}
{{--                                <h6 class="blog-post-title">Front becomes an official Instagram Marketing Partner</h6>--}}
{{--                            </a>--}}
{{--                        </div>--}}
                    </div>
                </section>
            </div>
            <div class="col-md-4 sidebar" data-aos="fade-left">
                <div class="widget widget-post-list">
                    <h5 class="widget-title text-center">Остання додана електроніка</h5>
                    <ul class="post-list">
                        @foreach($likedPosts as $post)
                        <li class="post" style="border-bottom: 1px solid #c0c1c6">
                            <a href="{{route('post.show', $post->id)}}" class="post-permalink media">
                                <img src="{{'storage/' . $post->main_image}}" alt="blog post">
                                <div class="media-body">
                                    <h6 class="post-title">{{$post->title}}</h6>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
{{--                <div class="widget">--}}
{{--                    <h5 class="widget-title">Categories</h5>--}}
{{--                    <img src="{{asset('assets/images/blog_widget_categories.jpg')}}" alt="categories" class="w-100">--}}
{{--                </div>--}}
            </div>
        </div>
    </div>

</main>

@endsection
