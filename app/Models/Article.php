<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    protected $fillable = ['title','body',];


    /*Se usa un facade para poder acceder a la clase User desde el modelo Article
    y asignarle el atributo user_id*/
    
    public static function boot(){
        parent::boot();
        static::creating(function($article){
            $article->user_id = Auth::id();
        });
    }


    public function comments(){
        return $this->hasMany(Comment::class);
    }
 
    public function user(){
        return $this->belongsTo(User::class);
    }



     
}
