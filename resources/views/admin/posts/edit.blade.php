@extends('layouts.dashboard')

@section('content')
    <h1>Edit Post</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="title"
                value="{{ old('title') ? old('title') : $post->title }}">
        </div>
        <div class="from-group mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id">
                <option value="">None</option>
                @foreach ($categories as $item)
                    <option value="{{ $item->id }}"
                        {{ $post->category && old('category_id', $post->category->id) == $item->id ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea type="text" class="form-control" name="content" id="content"> {{ old('content') ? old('content') : $post->content }} </textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
