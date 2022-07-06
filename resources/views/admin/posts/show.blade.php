@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <h6>{{ $post->slug }}</h6>
                <p class="card-text">{{ $post->content }}</p>
                <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Modific</a>
                <form action="{{ route('admin.posts.detroy', ['post' => $post->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
