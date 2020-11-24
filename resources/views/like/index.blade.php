@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center">Mis imagenes favoritas</h1> 
                @foreach($likes as $like)

                    @include('includes.image',['image'=>$like->image])
                    <br>
                    <br>
                @endforeach
                    </div>
        </div>
    </div>
@endsection
