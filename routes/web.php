<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\TagController;
use App\Http\Controllers\admin\UserConttoller;
use Illuminate\Support\Facades\Route;


//tag controller and all tag routes
//Route::post('app/create_tag',[TagController::class, 'Test'] );
Route::post('app/create_tag',            [TagController::class, 'addTag'] );
Route::get('app/allTag',                 [TagController::class, 'allTag']);
Route::post('app/edit-tag',              [TagController::class, 'editTag']);
Route::post('app/delete-tag',            [TagController::class, 'deleteTag']);


//category controller and all category routes
Route::post('/app/category-image/upload',[CategoryController::class, 'uploadImage']);
Route::post('app/category/delete-image', [CategoryController::class, 'deleteImage']);
Route::post('/app/add-category',         [CategoryController::class, 'addCategory']);
Route::get('/app/all-category',          [CategoryController::class, 'allCategory']);
Route::post('app/delete-category',       [CategoryController::class, 'deleteCategory']);
Route::post('app/update-cateogry',       [CategoryController::class, 'updateCategory']);


//user controller and all user routes
Route::post('/app/user-image/upload',    [UserConttoller::class, 'uploadUserImage']);
Route::post('/app/user/delete-image',    [UserConttoller::class, 'deleteUserImage']);
Route::post('/app/add-user',             [UserConttoller::class, 'addUser']);
Route::get('/app/all-user',              [UserConttoller::class, 'index']);
Route::post('app/delete-user',           [UserConttoller::class, 'deleteUser']);


//auth controller and all auth system
Route::post('auth/login',                [AuthController::class, 'login']);

Route::get('/', function (){
   return view('welcome');
});

Route::any('{slug}', function(){
   return view('welcome');
});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
