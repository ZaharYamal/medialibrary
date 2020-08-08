@extends('layouts.app')
@section('content')
@include('message')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">Article: "{{ $post->title }}"</div>
                            <div class="col-md-8 text-right">
                                <form onsubmit="if(confirm('Удалить запись ?')){ return true }else{ return false }" action="{{ route('post.destroy',$post->id) }}" method="post">
                                    @csrf @method('DELETE')
                                    <a class="btn btn-outline-primary" href="{{ route('post.index') }}">на главную post</a>
                                    <a class="btn btn-outline-primary" href="{{ route('post.create') }}">добавить запись</a>
                                    <button type="submit" class="delete btn btn-outline-danger">удалить post</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">

                <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
                    @csrf @method('PATCH')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <label for="title">title</label>
                                    <input type="text" name="title" class="form-control" value="{{$post->title}}">
                                    <label for="content">content</label>
                                    <textarea name="content" class="form-control">{{$post->content}}</textarea>
                                    <label for="image">get image</label>
                                    @if($post->getMedia('posts')->count())
                                    @foreach($post->getMedia('posts')->all() as $image)
{{--                                        {{ dd($image->getFullUrl('thumb')) }}--}}
                                        <div class="text-center">
                                            <img class="w-25" src="{{ asset($image->getFullUrl('origin'))  }}" alt=""><br>
                                            <span class="text-danger">original</span> size: <span class="text-danger">{{ $image->size }} </span> Байт
                                            <a class="delete btn btn-danger" href="{{url('/post/delete-image/'.$image->id)}}">удалить</a>
                                        </div>

                                    @endforeach
{{--                                    {{ dd() }}--}}
{{--                                        <img class="w-100" src="{{$post->getMedia('posts')->first()->getUrl('origin')}}" alt="">--}}
                                    @endif
                                    <label for="">upload images</label>
                                    <input type="file" name="images[]" class="form-control" multiple>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <label for="">created at</label>
                                    <input type="text" class="form-control" value="{{$post->created_at}}" readonly>
                                    <label for="">updated at</label>
                                    <input type="text" class="form-control" value="{{$post->updated_at}}" readonly>
                                    <div class="mt-5"></div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-outline-primary">update post</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
