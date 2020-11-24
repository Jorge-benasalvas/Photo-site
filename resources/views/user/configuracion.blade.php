@extends('layouts.app')
@section('content')
<div class="container">
    @if(session('message'))
    <div class="alert " style="background:rgba(40,57,101,.9);">
        {{session('message')}}
    </div>
    @endif
    <form method="POST" action="{{route('user.update')}}" enctype="multipart/form-data">
        @csrf
        <div class="login-wrap-config">
            <div class="login-html">
                <input id="tab-2" type="radio" name="tab" class="sign-up" checked><label for="tab-2" class="tab">Configuración</label>
                <div class="login-form">

                    <div class="sign-up-htm">
                        <div class="group">
                            <label for="name" class="label">Nombre</label>
                            <input id="name" name="name" type="text" class="input form-control @error('name') is-invalid @enderror" value="{{Auth::user()->name}}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="group">
                            <label for="surname" class="label">Apellidos</label>
                            <input id="surname" name="surname" type="text" class="input form-control @error('surname') is-invalid @enderror" value="{{Auth::user()->surname}}">
                            @error('surname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="group">
                            <label for="nick" class="label">Usuario</label>
                            <input id="nick" type="text" name="nick" class="input form-control @error('nick') is-invalid @enderror" value="{{Auth::user()->nick}}">
                            @error('nick')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="group">
                            <label for="email" class="label">Email</label>
                            <input id="email" name="email" type="text" class="input form-control @error('email') is-invalid @enderror" value="{{Auth::user()->email}}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="group">
                            <label for="image_path" class="label">Avatar</label>
                            <div class="col justify-content-center">
                                <input id="image_path" type="file" style="width: 80%;" class="form-control-file @error('image_path') is-invalid @enderror " name="image_path">
                                <br>
                                <div style="width:80px; border-radius: 400px; overflow: hidden; height: 80px; " class="rounded align-items-center">

                                    @if(Auth::user()->image)
                                    <img src="{{route('user.avatar',['filename'=>Auth::user()->image])}}" style="width: 100%; height: 100%;" class="">
                                    @endif
                                </div>
                                @error('image_path')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
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