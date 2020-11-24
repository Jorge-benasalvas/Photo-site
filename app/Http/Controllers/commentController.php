<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class commentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request){

        //Validación del formulario
        $validate= $this->validate($request,[
            'image_id'=>'integer|required',
            'content'=> 'string|required'
        ]);

        //Recoger datos
        $user= \Auth::user();
        $content = $request->input('content');
        $image_id=$request->input('image_id');

        $comment= new Comment();
        $comment->user_id=$user->id;
        $comment->image_id=$image_id;
        $comment->content=$content;

        //Guardar en la base de datos
        $comment->save();


        return redirect()->route('image.detail',['id' => $image_id])
            ->with([
                'message'=> 'Se ha publicado tu comentario correctamente!!'
            ]);


    }

    public function delete($id){
        //Recoger datos del usuario identificado
        $user=\Auth::user();

        //Datos del comentario
        $comment= Comment::find($id);

        //Comprobar si soy el dueño del comentario o de la publicacion

        if($user && ($comment->user_id == $user->id || ($comment->image->id == $user->id || $user->role=='Admin'))){

            $comment->delete();

            return redirect()->route('image.detail',['id' => $comment->image->id])
                ->with([
                    'message'=> 'Comentario eliminado correctamente!!'
                ]);

        }else{

            return redirect()->route('image.detail',['id' => $comment->image->id])
                ->with([
                    'message'=> 'EL COMENTARIO NO SE HA ELIMINADO'
                ]);

        }
    }
}
