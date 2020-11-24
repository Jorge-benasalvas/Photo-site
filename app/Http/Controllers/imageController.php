<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Image;
use App\Comment;
use App\Like;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class imageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        return view('image.create');
    }

    public function saveImg(Request $request){

        //Validación
        $validate=$this->validate($request,[
            'description'=>'required',
            'image_path'=>'required|image'
        ]);


        //Recogemos los datos
        $image_path=$request->file('image_path');
        $description= $request->input('description');

        //Asginar valores al objeto
        $user=\Auth::user();
        $image=new Image();
        $image->user_id=$user->id;

        $image->description=$description;

        //Subir el fichero
        if($image){
            $image_name=time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_name,File::get($image_path));
            $image->image_path=$image_name;

        }
        //Guarda la imagen
        $image->save();


        return redirect()->route('home')->with([
            'message'=>'La foto se ha subido correctamente'
        ]);
    }

    public function getImage($filename){
        $file= Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function detail($id){
        $image = Image::find($id);

        return view('image.detail',[
            'image'=> $image
        ]);
    }

    public function delete($id){

        $user= \Auth::user();
        $image=Image::find($id);
        $comments= Comment::where('image_id',$id)->get();
        $likes=Like::where('image_id',$id)->get();

        if($user&& $image && ($image->user->id == $user->id || $user->role =='Admin')){

            //Eliminar comentarios
            if($comments && count($comments)>=1){
                foreach ($comments as $comment){
                    $comment->delete();
                }
            }

            //Eliminar likes
            if($likes && count($likes)>=1){
                foreach ($likes as $like){
                    $like->delete();
                }
            }

            //Eliminar ficheros asociados
            Storage::disk('images')->delete($image->image_path);

            //Eliminar registro de la imagen
            $image->delete();
            $message=array('message'=>'La imagen  se ha borrrado');
        }else{
            $message=array('message'=>'La imagen no se ha borrrado');
        }
        return redirect()->route('home')->with($message);


    }

    public function edit($id){
        $user= \Auth::user();
        $image=Image::find($id);

        if($user&& $image && ($image->user->id == $user->id || $user->role =='Admin')){

            return view('image.edit',['image'=>$image]);
        }else{
            return redirect()->route('home');
        }

    }

    public function update(Request $request){

        $image_id= $request->input('image_id');
        $description= $request->input('description');

        //Validación
        $validate=$this->validate($request,[
            'description'=>'required',
            'image_id'=>'required'
        ]);



        if($validate){
            $image=Image::find($image_id);
            $image->description=$description;
            $image->update();

            return redirect()->route('image.detail',['id'=>$image_id])->with(['message'=>'La foto se ha actualizado']);
        }





    }
}
