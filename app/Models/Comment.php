<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
     //
     protected $fillable = ['text'];
    
     
    /*Se usa un facade para poder acceder a la clase User desde el modelo Article
    y asignarle el atributo user_id*/
    
    public static function boot(){
        parent::boot();
        static::creating(function($comment){
            $comment->user_id = Auth::id();
        });
    }


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function article(){
        return $this->belongsTo(Article::class);
    }
  
}
