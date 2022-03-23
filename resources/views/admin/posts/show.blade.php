@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">
                    <a href="{{ route('admin.posts.index') }}" class="me-2"><</a>

                    {{ $post->title }}

                    <a class="ms-auto" href="{{ route('admin.posts.edit', $post->slug) }}">Modifica</a>
                </div>

                <div class="card-body">

                    @if ($post->cover)
                        <img src="{{ asset('storage/' . $post->cover) }}" alt="" class="img-fluid">
                    @else
                        <img src="https://via.placeholder.com/1024x480" alt="" class="img-fluid">
                    @endif

                    <p class="lead">
                        {!! $post->content !!}
                    </p>

                    <div class="my-3">
                        @php
                        // use Carbon\Carbon;
                        $dateFormat = 'd/m/Y H:i';
                        @endphp

                        Data creazione: {{ $post->created_at->format($dateFormat) }}
                        <br>
                        Data ultima modifica: {{ $post->updated_at->format($dateFormat) }}
                        ({{ $post->updated_at->diffForHumans(date(0)) }})
                        <br>
                        Slug: {{ $post->slug }}
                    </div>

                    <div class="my-3">
                        Utente: {{ $post->user->name }}
                        <br>
                        Email: {{ $post->user->email }}
                    </div>

                    @if ($post->category !== null)
                    <div class="my-3">
                        Categoria: {{ $post->category->code }}
                        <br>
                        Descrizione: {{ $post->category->description }}
                    </div>
                    @endif

                    @if ($post->tags !== null)
                    <div class="my-3">
                        tags:
                        @foreach ($post->tags as $tag)
                        <span class="bg-light">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection