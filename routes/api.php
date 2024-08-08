<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::post('/test',function (){
//    return 0;
//});


Route::post('/customer/register',[CustomerController::class,'registerCustomer']);
Route::post('/customer/login',[CustomerController::class,'loginCustomer']);


Route::post('/seller/register',[SellerController::class,'registerSeller']);
Route::post('/seller/login',[SellerController::class,'loginSeller']);

Route::apiResource('/products',ProductController::class);
