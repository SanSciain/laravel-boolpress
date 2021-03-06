@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="card">
            @if ($post->thumb)
                <img src="{{ asset('storage/' . $post->thumb) }}" class="card-img-top" alt="">
            @endif
            <div class="card-body">
                <h4 class="card-title">Title: {{ $post->title }}</h4>
                <h5>Slug: {{ $post->slug }}</h5>
                <h6>Category: {{ $post->category ? $post->category->name : 'None' }}</h6>
                <h6>Tags:
                    @forelse ($post->tags as $item)
                        {{ $item->name }}{{ $loop->last ? '' : ', ' }}
                    @empty
                        Nessun Tag
                    @endforelse
                </h6>
                <p class="card-text">{{ $post->content }}</p>
                <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
