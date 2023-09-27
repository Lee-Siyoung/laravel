<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('app');
})
->name('application');

Route::prefix('/board')->group(function(){
    Route::get('/',[BoardController::class, 'index']);
    Route::post('/',[BoardController::class, 'store']);
    Route::delete('/{id}',[BoardController::class, 'destroy']);
    Route::get('/{id}', [BoardController::class, 'show']);
    Route::put('/{id}', [BoardController::class, 'update']);
});

Route::prefix('/board/{boardId}/post')->group(function(){
    Route::get('/',[PostController::class, 'index']);
    Route::post('/',[PostController::class, 'store']);
    Route::delete('/{postId}',[PostController::class, 'destroy']);
    Route::get('/{postId}', [PostController::class, 'show']);
    Route::put('/{postId}', [PostController::class, 'update']);
});