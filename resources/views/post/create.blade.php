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
                <form method="post" enctype="multipart/form-data" action="{{ route('post.store') }}">
                    @csrf
                    <input type="text" name="title" class="form-control">
                    <input type="file" name="image[]" class="form-control" multiple>
                    <textarea name="content" class="form-control"></textarea>
                    <div class="mt-3"></div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-outline-success">save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
