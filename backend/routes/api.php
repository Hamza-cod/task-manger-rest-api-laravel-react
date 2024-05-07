<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/',function(){
    return response()->json([
        "app"=>"task manager",
    ]);
});
Route::post('login',[AuthController::class,'login'])->name('login');
Route::post('register',[AuthController::class,'register']);
Route::middleware('auth:sanctum')->group(function (){
    Route::apiResource('tasks',TaskController::class);
    Route::apiResource('projects',ProjectController::class);
    Route::post('projects/{project}/add_member',[ProjectController::class,'addMember']);
});