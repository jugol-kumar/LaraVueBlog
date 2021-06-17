<?php

use App\Http\Controllers\admin\TagController;
use Illuminate\Support\Facades\Route;



//Route::post('app/create_tag',[TagController::class, 'Test'] );
Route::post('app/create_tag',[TagController::class, 'addTag'] );
Route::get('app/allTag', [TagController::class, 'allTag']);
Route::post('app/edit-tag', [TagController::class, 'editTag']);
Route::post('app/delete-tag', [TagController::class, 'deleteTag']);


Route::get('/', function (){
   return view('welcome');
});

Route::any('{slug}', function(){
   return view('welcome');
});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
