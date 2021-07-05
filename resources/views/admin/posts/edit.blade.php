@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
            Modifica
            <a href="{{ route('admin.posts.show', $post) }}">{{ $post->title }}</a>
        </h1>
        {{-- gestore degli errori: verifica l'esistenza di errori --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div>
            <form action="{{ route('admin.posts.update', $post) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label class="label-control" for="title">Titolo</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}"
                        class="form-control @error('title') is-invalid @enderror">
                    {{-- se esiste l'errore title --}}
                    @error('title')
                        {{-- stampa un messaggio di errore --}}
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="label-control" for="content">Contenuto</label>
                    <textarea type="text" id="content" name="content"
                        class="form-control @error('content') is-invalid  @enderror"
                        rows="6">{{ old('content', $post->content) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="label-control" for="category_id">Categoria</label>
                    <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                        <option value="">Selezionare una categoria</option>
                        @foreach ($categories as $category)
                            <option
                                @if (old('category_id', $post->category_id) == $category_id) selected @endif
                                value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p class="text-danger">{{ $message }}</p>
                   @enderror
                </div>

                <div>
                    <button class="btn btn-primary" type="submit">
                        invio
                    </button>
                    <button class="btn btn-secondary" type="reset">
                        reset
                    </button>
                </div>
            </form>
        </div>
    @endsection
