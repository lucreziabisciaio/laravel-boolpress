@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">
                    Dettagli utente
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method("patch")

                        <div class="mb-3">
                            <label>Nome</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Inserisci il nome dell'utente" value="{{ old('name', $user->name) }}"
                                required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Inserisci l'email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Telefono</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                placeholder="Numero di telefono"
                                value="{{ old('phone', $user->infoUser->phone ?? null) }}">
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Indirizzo</label>
                            <input type="text" name="address"
                                class="form-control @error('address') is-invalid @enderror"
                                placeholder="Inserisci l'indirizzo"
                                value="{{ old('address', $user->infoUser->address ?? null) }}">
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Immagine profilo</label>
                            <input type="text" name="avatar" class="form-control @error('avatar') is-invalid @enderror"
                                value="{{ old('avatar', $user->infoUser->avatar ?? null) }}">
                            <!--value="{{ old('avatar', $user->infoUser && $user->infoUser->avatar ? $user->infoUser->avatar : null) }}" required>-->
                            @error('avatar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-secondary">Annulla</a>
                            <button type="submit" class="btn btn-success">Salva post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection