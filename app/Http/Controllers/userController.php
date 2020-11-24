<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\User;

class userController extends Controller
{

    public function index($search=null){

        if(!empty($search)){
            $users= User::where('nick','LIKE','%'.$search.'%')
                ->orWhere('name','LIKE','%'.$search.'%')
                ->orWhere('surname','LIKE','%'.$search.'%')
                ->orderBy('id','desc')
                ->paginate(5);
        }else {
            $users = User::orderBy('name', 'asc')->paginate();
        }

            return view('user.index', [
                'users' => $users
            ]);


    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function configuracion(){
        return view('user.configuracion');
    }

    public function contraseña(){
        return view('user.password');
    }

    public function updatePW(Request $request){
        //Obtener el usuario que esta identificado
        $user=\Auth::user();


        //Validación del formulario
        $validate=$this->validate($request, [
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $password= Hash::make($request->input('password'));

        $user->password=$password;

        //Ejecutar consulta

        $user->update();

        return redirect()->route('password')
            ->with(['message'=>'Usuario actualizado correctamente']);
    }

    public function update(Request $request)
    {
        //Obtener el usuario que esta identificado
        $user = \Auth::user();
        $id = \Auth::user()->id;

        //Validación del formulario
        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255', 'unique:users,nick,' . $id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
        ]);

        //recoger los datos del formulario
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        //Asignar nuevos valores al objeto del usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        //subir la imagen
        $imagen_path = $request->file('image_path');
        if ($imagen_path) {

            //Poner nombre unico
            $image_path_name = time() . $imagen_path->getClientOriginalName();

            //Guardar la imagen
            Storage::disk('users')->put($image_path_name, File::get($imagen_path));

            $user->image = $image_path_name;
        }

        //Ejecutar consulta

        $user->update();

        return redirect()->route('configuracion')
            ->with(['message' => 'Usuario actualizado correctamente']);


    }
    public function getImage($filename){

        $file= Storage::disk('users')->get($filename);
        return new Response($file,200);
    }
    public function profile($id){

        $user=User::find($id);
        return view('user.profile',[
            'user'=>$user
        ]);

    }

    public function delete($id){
        $user = \Auth::user();
        $user_delete = User::find($id);

        if($user->role=='Admin'){
            $user_delete->delete();
            $message=array('message'=>'El usuario se ha borrrado');
        }else{
            $message=array('message'=>'La usuario no se ha borrrado');
        }
        return redirect()->route('home')->with($message);
        
    }



}
