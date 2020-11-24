@extends('layouts.app')

@section('content')

    <div class="container" style="padding-top:0">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session('message'))
                    <div class="alert " style="background:rgba(40,57,101,.9);">
                        {{session('message')}}
                    </div>
                @endif
               
                        @foreach($images as $image)

                            @include('includes.image',['image'=>$image])
                           <br>
                           <br>

                        @endforeach

                    </div>


              
        </div>
    </div>
@endsection
