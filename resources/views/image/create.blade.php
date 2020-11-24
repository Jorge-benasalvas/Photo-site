@extends('layouts.app')
@section('content')
<div class="container">
    <form method="post" action="{{route('subirImagen')}}" enctype="multipart/form-data">
        @csrf
        <div class="login-wrap-subirFoto">
            <div class="login-html">
                <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Subir Imagen</label>
                <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
                <div class="login-form">
                    <div class="sign-in-htm">
                        <div class="group">
                            <label for="image_path" class="label">Elergir foto</label>
                            <input id="image_path" type="file" name="image_path" class="input form-control-file {{$errors->has('image_path') ? 'is-invalid': ''}}">
                            @if($errors->has('image_path'))
                            <span class="invalid-feedback d-block" role="alert"><strong>{{$errors->first('image_path')}}</strong></span>
                            @endif
                        </div>
                        <div class="group">
                            <label for="description" class="label">Descripción</label>
                            <textarea id="description" name="description" class="input form-control {{$errors->has('description') ? 'is-invalid': ''}}"></textarea>
                            @if($errors->has('description'))
                            <span class="invalid-feedback d-block" role="alert"><strong>{{$errors->first('description')}}</strong></span>
                            @endif
                        </div>

                        <div class="group">
                            <button type="submit" value="Subir imagen" class="button">
                                Subir Imagen
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cloud-arrow-up-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146l-2-2a.5.5 0 0 0-.708 0l-2 2a.5.5 0 1 0 .708.708L7.5 6.707V10.5a.5.5 0 0 0 1 0V6.707l1.146 1.147a.5.5 0 0 0 .708-.708z" />
                                </svg></button>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
@endsection