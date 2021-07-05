@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
            Nuovo post
            <span class="badge bg-danger rounded-pill">New</span>
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
            <form action="{{ route('admin.posts.store') }}" method="POST">
                @csrf
                @method('POST')

                <div class="mb-3">
                    <label class="label-control" for="title">Titolo</label>
                    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid  @enderror"
                        value="{{ old('title') }}">
                    {{-- se esiste l'errore title --}}
                    @error('title')
                        {{-- stampa un messaggio di errore --}}
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="label-control" for="category_id">Categoria</label>
                    <select class="form-control @error('category_id') is-invalid @enderror"
                    name="category_id" id="category_id">
                        <option value=""> - selezionare una categoria - </option>
                        @foreach($categories as $category)
                            <option
                            @if(old('category_id') == $category->id)  selected @endif
                            value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-3">
                    <label class="label-control" for="content">Contenuto</label>
                    <textarea type="text" id="content" name="content"
                        class="form-control @error('content') is-invalid  @enderror" rows="6">
                        {{ old('content') }}
                        {{-- @error('content') is-invalid  @enderror genera un campo rosso intorno all'input se c'è un errore --}}
                        {{-- {{ old('content') }} fa si che se c'è un errore in un altro campo, questo qui invece rimane pieno con quello ch era già stato scritto --}}
                    </textarea>
                    {{-- se esiste l'errore content --}}
                    @error('content')
                        {{-- stampa un messaggio di errore --}}
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <button class="btn btn-primary" type="submit">
                        INVIO
                    </button>
                    <button class="btn btn-secondary" type="reset">
                        RESET
                    </button>
                    <a class="btn btn-success" href="{{ route('admin.posts.index') }}">BACK</a>
                </div>
            </form>
        </div>
    @endsection
