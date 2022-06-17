<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\SpendController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('register',[UserController::class, 'register']);
Route::post('login',[UserController::class, 'login']);
Route::post('logout',[UserController::class, 'logout']);

Route::group(['prefix' => 'spend', 'middlewar' => 'auth:santum'], function(){
    Route::get('/', [SpendController::class, 'index']);
    Route::post('/add', [SpendController::class, 'add']);
    Route::post('/edit/{id}', [SpendController::class, 'edit']);
    Route::post('/update/{id}', [SpendController::class, 'update']);
    Route::delete('/delete/{id}', [SpendController::class, 'delete']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
