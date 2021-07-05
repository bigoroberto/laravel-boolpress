@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
            {{ $post->title}}
        </h1>

        <h3>
            @if($post->category)
            Categoria: {{ $post->category->name }}
            @else
            Nessuna categoria associata
            @endif
            </h3>

        <p>{{ $post->content }}</p>

        <div>
            <a class="btn btn-info" href="{{ route('admin.posts.edit', $post) }}">EDIT</a>
            <a class="btn btn-success" href="{{ route('admin.posts.index', $post) }}">BACK</a>
        </div>
    </div>
@endsection
