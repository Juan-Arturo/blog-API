<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Article;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/users/register', [UserController::class, 'register']);
Route::post('/users/login', [UserController::class, 'authenticate']);
Route::get('/articles', [ArticleController::class, 'index']);


Route::group(['middleware' => 'jwt.verify'], function () {
    Route::get('/user', [UserController::class, 'getAuthenticatedUser']);
    Route::get('/articles/{article}', [ArticleController::class, 'show']);
    Route::post('/articles', [ArticleController::class, 'store']);
    Route::put('/articles/{article}', [ArticleController::class, 'update']);
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy']);
});
    



    
