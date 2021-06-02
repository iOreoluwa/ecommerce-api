<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\TagController;
use App\Http\Controllers\API\Auth\AuthController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Route::view('/', 'api') {};


Route::get('/', function () {
    return 'Ecommerce API';
});


// public routes
Route::group(['middleware' => ['cors', 'json.response']], function () {
    //  Route::post('register', ['App\Http\Controllers\API\Auth\AuthController','register'])->name('regsiter');
     Route::post('login', [AuthController::class, 'login'])->name('login');
     Route::post('register', [AuthController::class, 'register'])->name('register');

});

// protected auth routes
Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    // Route::apiResource('categories', CategoryController::class);
});

// protected admin routes
Route::group(['middleware' => ['auth:api','admin']], function() {
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('tags', TagController::class);
});

