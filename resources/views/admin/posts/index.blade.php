@extends('layouts.dashboard')

@section('content')
    <div class="row justify-content-center">
        @foreach ($posts as $item)
            <div class="card m-3" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->title }}</h5>
                    <a href="{{ route('admin.posts.show', ['post' => $item->id]) }}" class="btn btn-primary">Read Post</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
