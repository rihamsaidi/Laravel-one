@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>{{ $post->title }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Description:</strong></p>
            <p>{{ $post->description }}</p>

            @if ($post->image)
                <div class="mb-3">
                    <p><strong>Image:</strong></p>
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image">
                </div>
            @else
                <p><strong>Image:</strong> No image uploaded.</p>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
        </div>
    </div>
@endsection
