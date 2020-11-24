<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class likeController extends Controller
{

    public function index(){
        $user=\Auth::user();
        $likes=Like::where('user_id',$user->id)->orderBy('id','desc')
                            ->paginate(5);

        return view('like.index',[
            'likes' => $likes
        ]);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function like($image_id){
        //Recoger datos del usuario y de la imagen
        $user=\Auth::user();

        //Comprobar que no se repite el like
        $issetLike= Like::where('user_id',$user->id)
                        ->where('image_id',$image_id)
                        ->count();
        if($issetLike==0){

            $like= new Like();
            $like->user_id=$user->id;
            $like->image_id=(int)$image_id;

            //Guardar en la base de datos
            $like->save();

            return response()->json([
                'like'=>$like
            ]);

        }else{

            return response()->json([
                'message'=>'Ya esta dado like'
            ]);

        }
    }


    public function dislike($image_id){

        //Recoger datos del usuario y de la imagen
        $user=\Auth::user();

        //Comprobar que no se repite el like
        $Like= Like::where('user_id',$user->id)
            ->where('image_id',$image_id)
            ->first();

        if($Like){
            //Eliminar de la base de datos
            $Like->delete();

            return response()->json([
                'like'=>$Like,
                'message'=>'Has dado dislike'
            ]);

        }else{

            return response()->json([
                'message'=>'El like no existe'
            ]);

        }
    }



}
