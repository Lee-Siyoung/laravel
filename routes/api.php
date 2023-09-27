<?php

use App\Http\Controllers\API\BoardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

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