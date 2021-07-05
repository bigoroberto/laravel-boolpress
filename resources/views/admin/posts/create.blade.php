@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Nuovo post</h1>

        {{-- verifico l'esistenza di errori --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                       <li> {{ $error }} </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div>
            <form action="{{ route('admin.posts.store') }}" method="POST">
                @csrf
                @method('POST')

                <div class="mb-3">
                    <label class="label-control" for="title">Titolo</label>
                    <input type="text" id="title" name="title"
                           value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror">
                    {{-- controlla se fra gli errori esiste quello che ti passo come parametro
                        e passa in $message l'errore--}}
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="label-control" for="content">Content</label>
                    <textarea type="text" id="content" name="content"
                              class="form-control  @error('content') is-invalid @enderror"  rows="5">
                              {{ old('content') }}
                    </textarea>
                    @error('content')
                    <p class="text-danger">{{ $message }}</p>
                   @enderror
                </div>

                <div class="mb-3">
                    <label class="label-control" for="category_id">Categoria</label>
                    <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                        <option value="">Selezionare una categoria</option>
                        @foreach ($categories as $category)
                            <option
                                @if (old('category_id') == $category_id) selected @endif
                                value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p class="text-danger">{{ $message }}</p>
                   @enderror
                </div>

                <div>
                    <button class="btn btn-primary" type="submit">Invio</button>
                    <button class="btn btn-secondary" type="reset">Reset</button>
                </div>
            </form>
        </div>
    </div>
@endsection
