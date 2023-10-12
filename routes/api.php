<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\RestaurentController;
use App\Http\Controllers\UserController;
use App\Models\Restaurent;
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

Route::middleware('auth:sanctum')->get('/user-check', function (Request $request) {
    return $request->user();
});
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});
Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{sid}', [UserController::class, 'find']);
    Route::delete('/{sid}', [UserController::class, 'deleteById']);
    Route::put('/', [UserController::class, 'update']);
});
Route::prefix('restaurent')->group(function () {
    Route::get('/', [RestaurentController::class, 'index']);
    Route::get('/{sid}', [RestaurentController::class, 'find']);
    Route::delete('/{sid}', [RestaurentController::class, 'deleteById']);
    Route::put('/', [RestaurentController::class, 'update']);
    Route::post('/create',[RestaurentController::class,'createRestaurent']);
    Route::post('/get-all-by-user-id',[RestaurentController::class,'getByUserId']);
});
Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{sid}', [CategoryController::class, 'find']);
    Route::delete('/{sid}', [CategoryController::class, 'deleteById']);
    Route::put('/', [CategoryController::class, 'update']);
});
Route::prefix('food')->group(function () {
    Route::get('/', [FoodController::class, 'index']);
    Route::get('/{sid}', [FoodController::class, 'find']);
    Route::delete('/{sid}', [FoodController::class, 'deleteById']);
    Route::put('/', [FoodController::class, 'update']);
    Route::post('/created-by-restaurent-id', [FoodController::class, 'createFoodByRestaurentId']);
    Route::post('/get-by-res-id',[FoodController::class,'fetchListFoodByRestaurentId']);
});
Route::prefix('order')->group(function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::get('/{sid}', [OrderController::class, 'find']);
    Route::delete('/{sid}', [OrderController::class, 'deleteById']);
    Route::put('/', [OrderController::class, 'update']);
    Route::post('/create-new-order',[OrderController::class,'createNewOrder']);
});
Route::prefix('order-detail')->group(function () {
    Route::get('/', [OrderDetailController::class, 'index']);
    Route::get('/{sid}', [OrderDetailController::class, 'find']);
    Route::delete('/{sid}', [OrderDetailController::class, 'deleteById']);
    Route::put('/', [OrderDetailController::class, 'update']);
    Route::post('/create-order-detail-by-order-id',[OrderDetailController::class,'createOrderDetailByOrderId']);
    Route::post('/get-by-order-id-with-food',[OrderDetailController::class,'getByOrderIdWithFood']);
});
Route::prefix('policy')->group(function () {
    Route::get('/', [PolicyController::class, 'index']);
    Route::get('/{sid}', [PolicyController::class, 'find']);
    Route::delete('/{sid}', [PolicyController::class, 'deleteById']);
    Route::put('/', [PolicyController::class, 'update']);
});
Route::prefix('comment')->group(function () {
    Route::get('/', [CommentController::class, 'index']);
    Route::get('/{sid}', [CommentController::class, 'find']);
    Route::delete('/{sid}', [CommentController::class, 'deleteById']);
    Route::put('/', [CommentController::class, 'update']);
});
