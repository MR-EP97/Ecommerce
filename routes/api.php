<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::post('/test',function (){
//    return 0;
//});


Route::post('/customer/register',[CustomerController::class,'registerCustomer']);
Route::post('/customer/login',[CustomerController::class,'loginCustomer']);
