@extends('layouts.app')

@section('content')
<div class="container">

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="login-wrap">
            <div class="login-html">
                <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Iniciar Sesión</label>
                <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
                <div class="login-form">
                    <div class="sign-in-htm">
                        <div class="group">
                            <label for="email" class="label">Email</label>
                            <input id="email" type="text" name="email" class="input form-control @error('email') is-invalid @enderror" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="group">
                            <label for="password" class="label">Contraseña</label>
                            <input id="password" name="password" type="password" class="input form-control @error('password') is-invalid @enderror" data-type="password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="group">
                            <input type="checkbox" class="check" name="remember" id="remember">
                            <label for="remember"><span class="icon"></span> Recuerdame</label>
                        </div>
                        <div class="group">

                            <button type="submit" class="button">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </form>




</div>
@endsection