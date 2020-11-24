@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
            @endif

            <div class="card " style="border: 0">

                <div class="card-header " style="background:white">
                    <div style="width: 35px; border-radius: 900px; overflow: hidden; height: 35px; float: left; margin-right:20px;">

                        @if($image->user->image)
                        <img src="{{route('user.avatar',['filename'=>$image->user->image])}}" style="width: 100%; height: 100%">

                        @endif

                    </div>

                    <div style=" line-height: 35px ">
                        <a href="{{route('profile',['id'=>$image->user->id])}}" style="text-decoration: none; color: black ;font-weight: bold;">
                            {{'@'.$image->user->nick}}
                        </a>

                    </div>
                </div>

                <div class="card-body" style="padding: 0px">
                    <div style="max-height: 1000px; overflow: hidden; width: 100%; ">
                        <img src="{{route('image.file',['filename'=>$image->image_path])}}" style="width: 100%; ">
                    </div>

                    <div style="margin: 20px;  ">
                        <span style="color: grey">{{'@'.$image->user->nick}}</span>
                        <p>{{$image->description}}</p>
                    </div>

                    <div style=" float: right; padding-right: 15px; color: grey">
                        {{\FormatTime::LongTimeFilter($image->created_at)}}
                    </div>


                    <div style="padding: 20px; padding-bottom: 0; padding-top: 0;padding-right: 5px;">
                        <!--Comprobar si el usuario le ha dado like a la imagen-->

                        <?php $user_like = false; ?>

                        @foreach($image->likes as $like)

                        @if($like->user->id==Auth::user()->id)

                        <?php $user_like = true; ?>

                        @endif

                        @endforeach

                        @if($user_like)
                        <img src="{{asset('image/likeRojo.png')}}" data-id="{{$image->id}}" style="width: 20px; " class="btn-dislike">
                        @else
                        <img src="{{asset('image/likeNegro.png')}}" data-id="{{$image->id}}" style="width: 20px; " class="btn-like">
                        @endif
                        <span style="color: grey; font-size: 11px">{{count($image->likes)}}</span>
                    </div>

                    @if((Auth::user() && Auth::user()->id==$image->user->id) || Auth::user()->role=='Admin')
                    <div style="margin: 10px">
                        <a class="btn btn-primary btn-sm" href="{{route('image.edit',['id'=>$image->id])}}">Editar</a>
                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">
                            Borrar
                        </button>

                        <!-- The Modal -->
                        <div class="modal" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">¿Estas seguro?</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        Si eliminas esta imagen nunca podras recuperarla, ¿Estas seguro de que quieres borrarla?
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                                        <a class="btn btn-danger " href="{{route('borrarImagen',['id'=> $image->id])}}">Borrar definitivamente</a>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    @endif



                    <div style="padding: 20px">
                        <h3>Comentarios ({{count($image->comments)}})</h3>
                        <hr>
                        <form method="post" action="{{route('subirComment')}}">
                            @csrf
                            <input type="hidden" name="image_id" value="{{$image->id}}">
                            <p>
                                <textarea class="form-control {{$errors->has('content') ? 'is-invalid': ''}}" name="content" id="content">

                                            </textarea>
                            </p>
                            @if($errors->has('content'))
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                            <br>
                            @endif

                            <button type="submit" class="btn btn-success">
                                Enviar
                            </button>
                        </form>
                        <hr>

                        @foreach($image->comments as $comment)
                        <div>
                            <div>
                                <span style="color: grey">{{'@'.$comment->user->nick}}</span>
                                <span style="color: grey">{{'| '.\FormatTime::LongTimeFilter($comment->created_at)}}</span>
                                <p>
                                    {{$comment->content}}
                                    <br>
                                    @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id || Auth::user()->role=='Admin'))
                                    <a class="btn btn-sm btn-danger" href="{{route('comment.delete',['id'=> $comment->id])}}">Eliminar</a>
                                    @endif
                                </p>
                            </div>

                        </div>

                        @endforeach

                    </div>
                </div>
        </div>

    </div>
</div>
</div>
@endsection