@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">
                    <a href="{{ route('admin.users.index') }}" class="me-2">
                        <i class="fas fa-chevron-left"></i>
                    </a>

                    <a class="ms-auto" href="{{ route('admin.users.edit', $user->id) }}">
                        <i class="fas fa-edit"></i>
                    </a>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-3 text-center">
                            <img src="{{ $user->infoUser->avatar ?? 'https://www.pngall.com/wp-content/uploads/5/User-Profile-PNG-Clipart.png' }}"
                                class="rounded-circle w-75">
                        </div>
                        <div class="col">

                            <h4>{{ $user->name }}</h4>
                            <h5>{{ $user->email }}</h5>

                            @if ($user->infoUser)
                            <div>{{ $user->infoUser->address }}</div>
                            <div>{{ $user->infoUser->phone }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex align-items-center">

                    </div>

                    <p class="lead">

                    </p>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection