@extends('layouts.main')

@section('content')

    <main class="blog-post">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">{{$post->title}}</h1>
            <p class="edica-blog-post-meta" data-aos="fade-up"
               data-aos-delay="200">{{$date->translatedFormat('F')}} {{$date->day}}, {{$date->year}}
                • {{$date->format('H:i')}}</p>
            <section class="blog-post-featured-img" data-aos="fade-up" data-aos-delay="300">
                <img src="{{asset('storage/' . $post->main_image)}}" alt="featured image" class="w-100">
            </section>
            <section class="post-content">
                <div class="row">
                    <div class="col-lg-9 mx-auto">
                        {!! $post->content !!}
                    </div>
                </div>
            </section>

            <section class="text-center">
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

            </section>

            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <section class="comment-list mb-5 pt-3">
                        <h2 class="section-title mb-5" data-aos="fade-up">Коментарі ({{$post->comments->count()}})</h2>
                        @foreach($post->comments as $comment)
                            <div class="comment-text mb-3">
                <span class="username">
                <div>
                    <b>{{$comment->user->name}}</b>
                </div>

                  <span class="text-muted float-right">{{$comment->dateAsCarbon->diffForHumans()}}</span>
                </span><!-- /.username -->
                                {{$comment->message}}
                            </div>
                        @endforeach
                    </section>
                </div>
            </div>

            @auth()
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <section class="comment-section">
                        <h2 class="section-title mb-5" data-aos="fade-up">Залишити коментар</h2>
                        <form action="{{route('post.comment.store', $post->id)}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-12" data-aos="fade-up">
                                    <label for="comment" class="sr-only">Комент</label>
                                    <textarea name="message" class="form-control"
                                              placeholder="Прокоментуйте" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12" data-aos="fade-up">
                                    <input type="submit" value="Прокоментувати" class="btn btn-warning">
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
            @endauth
        </div>
    </main>

@endsection
