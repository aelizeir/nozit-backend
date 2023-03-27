<?php

use App\Http\Controllers\NotesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware' => ['auth:sanctum']], function () {


    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/notes', [NotesController::class, 'store']);

    Route::post('auth/logout', [AuthController::class, 'logout']);

    //Route::get('/employees/{userId}', [EmployeeController::class, 'index']);
    Route::get('/notes/{userId}', [NotesController::class, 'show']);

    Route::put('/notes{id}', [NotesController::class, 'update']);
    Route::delete('/notes{id}', [NotesController::class, 'destroy']);


});
