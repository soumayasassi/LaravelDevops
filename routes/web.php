<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Http\Request ;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/page1', function () {
    return view('page1', ["title"=> 'my first page']);
});

Route::get('/page2/{nom}/{id}', function ($nom , $id ) {
    return view('page2',["name"=>$nom, "id"=>$id]);
})->where('id','[0-9]+');
Route::get('/message/{nom?}', function ($nom =null ) {
    return view('message',["name"=>$nom]);
})->where('nom','[a-zA-Z]+');


Route::get('/home',[\App\Http\Controllers\HomeController::class,'index']) ;
Route::get('/welcome',[\App\Http\Controllers\HomeController::class,'welcome']) ;
Route::get('/show',[\App\Http\Controllers\HomeController::class,'show']) ;
Route::get('/trimstring',[\App\Http\Controllers\HomeController::class,'trimstring']) ;
Route::get('/result', function (Request $request ) {
    return 'La valeur sans espace  '. $request->nom;
})->name('resultname');


Route::get('/verif/{age}', function ( Request $request ) {
    return  $request->age  ;
})->middleware(\App\Http\Middleware\VerifAge::class);
Route::middleware([\App\Http\Middleware\VerifAge::class])->group(function()
{
    Route::get('/verif/{age}', function ( Request $request ) {
        return  $request->age  ;
    });

    Route::get('/verif/{age}', function ( Request $request ) {
        return  $request->age  ;
    }) ;
}

) ;
