<div class="card" style="border:0;">

    <div class="card-header " >
        <div style="width: 35px; border-radius: 900px; overflow: hidden; height: 35px; float: left; margin-right:20px;">

            @if($image->user->image)
                <img src="{{route('user.avatar',['filename'=>$image->user->image])}}" style="width: 100%; height: 100%">
            @endif
        </div>

        <div style=" line-height: 35px;">
            <a href="{{route('profile',['id'=>$image->user->id])}}" style="text-decoration: none; color: black ;font-weight: bold;">
                {{'@'.$image->user->nick}}
            </a>

        </div>
    </div>

    <div class="card-body" style="padding: 0px">
        <div style="max-height: 1000px; overflow: hidden; width: 100%; ">
            <a href="{{route('image.detail',['id'=>$image->id])}}">
                <img src="{{route('image.file',['filename'=>$image->image_path])}}" style="width: 100%; ">
            </a>
        </div>



        <div style="margin: 20px;  ">
            <span style="color: grey">{{'@'.$image->user->nick}}</span>

            <p>{{$image->description}}</p>
        </div>

        <div style=" float: right; padding-right: 15px; color: grey">
            {{\FormatTime::LongTimeFilter($image->created_at)}}
        </div>

        <div style="padding: 20px; padding-bottom: 0; padding-top: 0;padding-right: 5px; float: left">

            <!--Comprobar si el usuario le ha dado like a la imagen-->

            <?php $user_like=false;?>

            @foreach($image->likes as $like)

                @if($like->user->id==Auth::user()->id)

                    <?php $user_like=true;?>

                @endif

            @endforeach

            @if($user_like)
                <img src="{{asset('image/likeRojo.png')}}" data-id="{{$image->id}}" style="width: 20px; " class="btn-dislike">
            @else
                <img src="{{asset('image/likeNegro.png')}}" data-id="{{$image->id}}" style="width: 20px; " class="btn-like">
            @endif
            <span style="color: grey; font-size: 11px">{{count($image->likes)}}</span>

        </div>

        <div >
            <a  class="btn btn-sm btn-warning" href="{{route('image.detail',['id'=>$image->id])}}" style="margin:20px; margin-top: 0; margin-left: 5px ">Comentarios ({{count($image->comments)}})</a>
        </div>




    </div>
</div>
