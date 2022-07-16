<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\emailController;
use App\Http\Resources\emailRessource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/addmail',[emailController::class,'store']);
Route::get('retrieve-emails/{id}',[emailController::class,'show']);
Route::get('/getEmails',[emailController::class,'index']);
Route::post('/addApplication',[ApplicationController::class,'create']);
Route::get('/getApps',[ApplicationController::class,'index']);
