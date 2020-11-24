@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-8 ">
            <div class="center-block ">
                <h2 class="center-block" style="left: 45%; position: relative">Perfiles</h2>
            </div>
            @foreach($users as $user)
            <div style="margin-bottom: 40px; height: 200px;">
                <hr>
                <div style="width: 200px; border-radius: 900px; overflow: hidden; height: 200px; float: left ">
                    @if($user->image)
                    <a href="{{route('profile',['id'=>$user->id])}}" style="text-decoration: none">
                        <img src="{{route('user.avatar',['filename'=>$user->image])}}" style="width: 100%; height: 100%">
                    </a>
                    @endif
                </div>

                <div style="padding-left: 30px; float: left; padding-top: 30px">
                    <a href="{{route('profile',['id'=>$user->id])}}" style="text-decoration: none; color:white">
                        <h2>{{'@'.$user->nick}}</h2>
                        <h2>{{$user->name.' '. $user->surname}}</h2>
                    </a>
                    <p>{{'Se unió: '.\FormatTime::LongTimeFilter($user->created_at)}}</p>

                    @if(Auth::user()->role=='Admin')
                    <a class="btn btn-sm btn-danger" href="{{route('user.delete',['id'=> $user->id])}}">Eliminar Usuario</a>
                    @endif

                </div>
            </div>
            <div class="clearfix"></div>
            @endforeach
        </div>
    </div>
</div>
@endsection