<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Article;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get('/articles', function () {
     return Article::all();
    });
    
    Route::get('/articles/{id}', function ($id) {
        return Article::find($id);
    });
    
    Route::post('/articles', function (Request $request) {
        return Article::create($request->all());
    });
    
    Route::put('/articles/{id}', function ($id, Request $request) {
        //return Article::findOrFail($id)->update($request->all());  retorna 1 si se crea correctamente
        $article = Article::findOrFail($id);
        $article->update($request->all());
        return $article;
    });
    
    Route::delete('/articles/{id}', function ($id) {
        Article::find($id)->delete();
        return 204;
    });
    
    
    