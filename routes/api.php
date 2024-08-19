<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;


Route::post('/customer/register', [CustomerController::class, 'registerCustomer']);
Route::post('/customer/login', [CustomerController::class, 'loginCustomer']);


Route::post('/seller/register', [SellerController::class, 'registerSeller']);
Route::post('/seller/login', [SellerController::class, 'loginSeller']);

Route::apiResource('/products', ProductController::class);
Route::apiResource('/categories', CategoryController::class);
Route::apiResource('/features', FeatureController::class);

Route::post('/add-product-to-cart/{product_id}',[CartController::class, 'addProductToCart'])->middleware('auth:api');


