@extends('layouts.dashboard')

@section('content')
    <h1>Create New Post</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
        </div>
        <div class="from-group mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id">
                <option value="">None</option>
                @foreach ($categories as $item)
                    <option value="{{ $item->id }}" {{ $item->id == old('category_id') ? 'selected' : '' }}>
                        {{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            @foreach ($tags as $item)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $item->id }}" name="tags[]"
                        id="tag-{{ $item->id }}" {{ in_array($item->id, old('tags', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="tag-{{ $item->id }}">
                        {{ $item->name }}
                    </label>
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea type="text" class="form-control" name="content" id="content"> {{ old('content') }} </textarea>
        </div>

        <div class="div">
            <label for="image">Upload image</label>
            <input type="file" id="image" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
