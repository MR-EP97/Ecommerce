<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class AdminController extends Controller
{
   public function login(AdminLoginRequest $request)
   {
       if (!Auth::guard('admin')->attempt($request->safe()->only('email', 'password'))) {
           return Response::json([
               'status' => 'error',
               'message' => 'Wrong Email/Password',
           ], HttpResponse::HTTP_FORBIDDEN);
       }
       return Response::json([
           'status' => 'success',
           'message' => 'Admin Login Successfully',
           'access_token' => Auth::guard('admin')->user()->createToken('Admin Token')->plainTextToken,
           'token_type' => 'Bearer'
       ], HttpResponse::HTTP_OK);   }
}
