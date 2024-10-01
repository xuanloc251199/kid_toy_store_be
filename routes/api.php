<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CartController;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request){
    return $request->user();
});

## Auth ##

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

## User ##

// Route để hiển thị danh sách người dùng (có thể không cần bảo mật nếu bạn muốn)
// Route::get('/users', [UserController::class, 'index'])->middleware('auth:sanctum');

// Route để hiển thị thông tin người dùng hiện tại
Route::get('/user', [UserController::class, 'show'])->middleware('auth:sanctum');

// Route để thêm người dùng mới (có thể không cần bảo mật)
Route::post('/user/store', [UserController::class, 'store']);

// Route để cập nhật người dùng
Route::put('/user/update', [UserController::class, 'update'])->middleware('auth:sanctum');

// Route để xóa người dùng
Route::delete('/user/{id}', [UserController::class, 'destroy'])->middleware('auth:sanctum');


## Category ##

// Route để hiển thị danh sách danh mục
Route::get('/categories', [CategoryController::class, 'index']);

// Route để thêm danh mục mới
Route::post('/categories/store', [CategoryController::class, 'store']);

// Route để cập nhật danh mục
Route::put('/categories/update/{id}', [CategoryController::class, 'update']);

// Route để xóa danh mục
Route::delete('/categories/destroy/{id}', [CategoryController::class, 'destroy']);

// Route để hiển thị sản phẩm theo danh mục
Route::get('/categories/{id}/products', [CategoryController::class, 'getProductsByCategory']);

## Product ##

// Route để hiển thị danh sách sản phẩm
Route::get('/products', [ProductController::class, 'index']);

// Route để thêm sản phẩm mới
Route::post('/products/store', [ProductController::class, 'store']);

// Route để cập nhật sản phẩm
Route::put('/products/update/{id}', [ProductController::class, 'update']);

// Route để xóa sản phẩm
Route::delete('/products/destroy/{id}', [ProductController::class, 'destroy']);

## Tickets ##

// Route để hiển thị danh sách vé
Route::get('/tickets', [TicketController::class, 'index']);

// Route để thêm vé mới
Route::post('/tickets/store', [TicketController::class, 'store']);

// Route để cập nhật vé
Route::put('/tickets/update/{id}', [TicketController::class, 'update']);

// Route để xóa vé
Route::delete('/tickets/destrou/{id}', [TicketController::class, 'destroy']);

## Review ##

// Route để hiển thị danh sách đánh giá
Route::get('/reviews', [ReviewController::class, 'index']);

// Route để thêm đánh giá mới
Route::post('/reviews/store', [ReviewController::class, 'store']);

// Route để cập nhật đánh giá
Route::put('/reviews/update/{id}', [ReviewController::class, 'update']);

// Route để xóa đánh giá
Route::delete('/reviews/destroy/{id}', [ReviewController::class, 'destroy']);

## Cart ##

// Route để hiển thị giỏ hàng
Route::get('/cart', [CartController::class, 'index'])->middleware('auth:sanctum');

// Route để thêm sản phẩm vào giỏ hàng
Route::post('/cart/store', [CartController::class, 'store'])->middleware('auth:sanctum');

// Route để cập nhật số lượng sản phẩm trong giỏ hàng
Route::put('/cart/update/{id}', [CartController::class, 'update'])->middleware('auth:sanctum');

// Route để xóa sản phẩm khỏi giỏ hàng
Route::delete('/cart/destroy/{id}', [CartController::class, 'destroy'])->middleware('auth:sanctum');
