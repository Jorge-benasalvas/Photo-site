<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    Protected $table='likes';

    //Relación muchos a uno
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    //Relación muchos a uno
    public function image(){
        return $this->belongsTo('App\Image','image_id');
    }
}
