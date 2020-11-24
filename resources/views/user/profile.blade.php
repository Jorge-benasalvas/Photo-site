@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div style="margin-bottom: 40px; height: 200px">

                <div style="width: 200px; border-radius: 900px; overflow: hidden; height: 200px; float: left ">

                    @if($user->image)
                    <img src="{{route('user.avatar',['filename'=>$user->image])}}" style="width: 100%; height: 100%">
                    @endif
                </div>

                <div style="padding-left: 30px; float: left; padding-top: 30px">
                    <h2>{{'@'.$user->nick}}</h2>
                    <h2>{{$user->name.' '. $user->surname}}</h2>
                    <p>{{'Se unió: '.\FormatTime::LongTimeFilter($user->created_at)}}</p>
                    @if(Auth::user()->role=='Admin')
                    <a class="btn btn-sm btn-danger" href="{{route('user.delete',['id'=> $user->id])}}">Eliminar Usuario</a>
                    @endif
                </div>
            </div>
            <hr>
            <br>
            <div class="clearfix"></div>
            @foreach($user->images as $image)

            @include('includes.image',['image'=>$image])
            <br>
            <br>

            @endforeach

        </div>
    </div>
</div>
@endsection