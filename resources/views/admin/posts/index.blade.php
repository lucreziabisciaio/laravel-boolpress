@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header d-flex">
                    Lista dei post

                    <a class="ms-auto" href="{{ route('admin.posts.create') }}">Aggiungi...</a>
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($posts as $post)
                        <li class="list-group-item d-flex align-items-center">
                            <div>
                                {{ $post->title }}
                                <br>
                                <small class="fst-italic">{{ $post->created_at }} - {{ $post->user->name }} -
                                    {{ isset($post->category) ? $post->category->code : 'senza categoria' }}
                                </small>

                                @if ($post->trashed())
                                    <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-danger">Cestino</span>
                                @endif
                            </div>

                            <div class="ms-auto">
                                <a class="me-3" href="{{ route('admin.posts.show', $post->slug) }}"
                                    title="Visualizza"><i class="fa-solid fa-eye"></i></a>
                                <a class="text-dark" href="{{ route('admin.posts.edit', $post->slug) }}"
                                    title="Modifica"><i class="fa-solid fa-edit"></i></a>
                                @include('partials.deleteBtn', [
                                'id' => $post->id,
                                'route' => 'admin.posts.destroy',
                                ])
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection