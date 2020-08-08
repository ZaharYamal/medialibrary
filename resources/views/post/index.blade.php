@extends('layouts.app')
@section('content')
@include('message')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">index posts</div>
                            <div class="col-md-8 text-right">
                                <a class="btn btn-outline-primary" href="{{ route('post.index') }}">на главную post</a>
                                <a class="btn btn-outline-primary" href="{{ route('post.create') }}">добавить запись</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5"></div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#id</th>
                                <th scope="col">title</th>
                                <th scope="col">description</th>
                                <th scope="col">image</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <th scope="row">{{ $post->id }}</th>
                                <td><a href="{{ route('post.edit', $post->id) }}">{{ $post->title }}</a></td>
                                <td>{{$post->content}}</td>
{{--                                {{ dd($post->getMedia('posts')) }}--}}
                                <td><img src="" alt=""></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
