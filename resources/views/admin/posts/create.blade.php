@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">
                    Aggiunta di un nuovo post
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        {{-- titolo --}}
                        <div class="mb-3">
                            <label>Titolo</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                placeholder="Inserisci il titolo" value="{{ old('title') }}" required>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Immagine --}}
                        <div class="mb-3">
                            <label>Immagine di copertina</label>
                            <input type="file" name="cover" class="form-control @error('cover') is-invalid @enderror">
                            {{-- <span>{{ $post->cover }}</span> --}}
                            @error('cover')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- contenuto del post --}}
                        <div class="mb-3">
                            <label>Contenuto</label>
                            <textarea name="content" rows="10"
                                class="form-control @error('content') is-invalid @enderror"
                                placeholder="Inizia a scrivere qualcosa..." required>{{ old('content') }}</textarea>
                            @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Categoria</label>
                            <select name="category_id" class="form-select">
                                <option value="">-- nessuna categoria --</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if (old('category_id')===$category->id) selected
                                    @endIf>
                                    {{ $category->code }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Tags</label><br>
                            @foreach ($tags as $tag)
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    value="{{ $tag->id }}"
                                    id="tag_{{ $tag->id }}"
                                    name="tags[]"
                                    >

                                <label
                                    class="form-check-label"
                                    for="tag_{{ $tag->id }}"
                                    >
                                    {{ $tag->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Annulla</a>
                            <button type="submit" class="btn btn-success">Salva post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection