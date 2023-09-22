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
    Route::get('/',[BoardController::class, 'get']);
    Route::post('/',[BoardController::class, 'create']);
    Route::delete('/{id}',[BoardController::class, 'delete']);
    Route::get('/{id}', [BoardController::class, 'getById']);
    Route::put('/{id}', [BoardController::class, 'update']);
});

Route::prefix('/board/{boardId}/post')->group(function(){
    Route::get('/',[PostController::class, 'get']);
    Route::post('/',[PostController::class, 'create']);
    Route::delete('/{postId}',[PostController::class, 'delete']);
    Route::get('/{postId}', [PostController::class, 'getById']);
    Route::put('/{postId}', [PostController::class, 'update']);
});