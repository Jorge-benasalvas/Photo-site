@extends('layouts.app')

@section('content')
<div class="container">

    @if(session('message'))
    <div class="alert " style="background:rgba(40,57,101,.9);">
        {{session('message')}}
    </div>
    @endif
    <form method="POST" action="{{ route('user.updatePW') }}">
        @csrf
        <div class="login-wrap-password">
            <div class="login-html">
                <input id="tab-2" type="radio" name="tab" class="sign-up" checked><label for="tab-2" class="tab">Configuración <svg  width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-key-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                    </svg></label>
                <div class="login-form">

                    <div class="sign-up-htm">
                        <div class="group">
                            <label for="password" class="label">Password</label>
                            <input id="password" name="password" type="password" class="input form-control @error('password') is-invalid @enderror" data-type="password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="group">
                            <label for="password-confirm" class="label">Confirma contraseña</label>
                            <input id="password-confirm" name="password_confirmation" type="password" class="input form-control" data-type="password">
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Guardar">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection