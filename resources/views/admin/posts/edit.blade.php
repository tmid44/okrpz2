@extends('admin.layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Редагування постів</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right mr-3">
                            <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Головна</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.post.index')}}">Пости</a> </li>
                            <li class="breadcrumb-item active">Редагування</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <form action="{{route('admin.post.update', $post->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group w-25">
                                <input type="text" name="title" class="form-control" placeholder="Введіть назву"
                                       value="{{$post->title}}">
                                @error('title')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <textarea id="summernote" name="content">
                                    {{$post->content}}
                                </textarea>
                                @error('content')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="row w-75">
                                <div class="form-group w-25 mr-5">
                                    <label>Оберіть категорію</label>
                                    <select name="category_id" class="form-control">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"
                                                {{$category->id == $post->category_id ? 'selected' : ''}}
                                            >{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group w-50">
                                    <label>Теги</label>
                                    <select class="select2" name="tag_ids[]" multiple="multiple" data-placeholder="Виберіть теги"
                                            style="width: 100%;">
                                        @foreach($tags as $tag)
                                            <option {{is_array($post->tags->pluck('id')->toArray()) && in_array($tag->id, $post->tags->pluck('id')->toArray()) ? ' selected' : ''}}
                                                    value="{{$tag->id}}">{{$tag->title}}</option>
                                        @endforeach
                                    </select>
                                    @error('tag_ids')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group w-50">
                                <label for="exampleInputFile">Головне зображення</label>
                                <div class="w-50 mb-2">
                                    <img src="{{asset('storage/' . $post->main_image)}}" alt="main_image" class="w-50">
                                </div>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="main_image">
                                        <label class="custom-file-label" for="exampleInputFile">Виберати
                                            зображення</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Завантажити зображення</span>
                                    </div>
                                </div>

                                @error('main_image')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group w-50">
                                <label for="exampleInputFile">Додаткове зображення</label>
                                @if(isset($post->additional_image))
                                <div class="w-50 mb-2">
                                    <img src="{{asset('storage/' . $post->additional_image)}}" alt="additional_image" class="w-50">
                                </div>
                                @endif
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="additional_image">
                                        <label class="custom-file-label" for="exampleInputFile">Виберати
                                            зображення</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Завантажити зображення</span>
                                    </div>

                                </div>
                                @error('additional_image')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Обновити">
                            </div>
                        </form>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
