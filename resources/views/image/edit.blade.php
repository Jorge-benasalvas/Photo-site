@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar imagen</div>
                    <div class="card-body">
                        <form method="post" action="{{route('image.update')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{$image->id}}" name="image_id">
                            <div class="form-group row">
                                <label for="image_path"  class="col-md-3 col-form-label text-md-right">Imagen</label>
                                <div class="col-md-7">
                                    <div style="width: 100px;  overflow: hidden; height: 100px; float: left; margin-right:20px; margin-bottom: 20px">

                                        @if($image->user->image)
                                            <img src="{{route('image.file',['filename'=>$image->image_path])}}" style="width: 100%; height: 100%">

                                        @endif

                                    </div>


                                    @if($errors->has('image_path'))
                                        <span class="invalid-feedback d-block" role="alert"><strong>{{$errors->first('image_path')}}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description"  class="col-md-3 col-form-label text-md-right">Descripción</label>
                                <div class="col-md-7">
                                    <textarea id="description"  name="description" class="form-control {{$errors->has('description') ? 'is-invalid': ''}}" >{{$image->description}}</textarea>
                                    @if($errors->has('description'))
                                        <span class="invalid-feedback d-block" role="alert"><strong>{{$errors->first('description')}}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-6 offset-md-3">
                                    <input type="submit" value="Editar imagen" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
