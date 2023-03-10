<?php

use App\Http\Controllers\api\AuthController;

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
Route::post('register',[AuthController::class,'resgister']);
Route::post('login',[AuthController::class,'login']);

Route::group(['middleware'=>'auth:sanctum'],function(){
    Route::get('logout',[AuthController::class,'logout']);
    Route::post('uploadImg',[AuthController::class,'upload_img']);
    Route::get('get_image',[AuthController::class,'get_image']);

});





