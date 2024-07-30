<?php

namespace App\Http\Controllers;

use App\Http\Requests\Seller\LoginSellerRequest;
use App\Http\Requests\Seller\RegisterSellerRequest;
use App\Models\Customer;
use App\Models\Seller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class SellerController extends Controller
{
    public function registerSeller(RegisterSellerRequest $request): JsonResponse
    {
        $seller = Seller::query()->create($request->safe()->only(
            'email', 'password', 'shop_name', 'shop_description', 'phone_number'
        ));

        return Response::json([
            'status' => 'success',
            'message' => 'Seller Registered Successfully',
            'access_token' => $seller->createToken('Seller Token')->plainTextToken,
            'token_type' => 'Bearer'
        ], HttpResponse::HTTP_CREATED);
    }

    public function loginSeller(LoginSellerRequest $request): JsonResponse
    {
        if (!Auth::guard('seller')->attempt($request->safe()->only('email', 'password'))) {
            return Response::json([
                'status' => 'error',
                'message' => 'Wrong Email/Password',
            ], HttpResponse::HTTP_FORBIDDEN);
        }

        return Response::json([
            'status' => 'success',
            'message' => 'Seller Login Successfully',
            'access_token' => Auth::guard('seller')->user()->createToken('Seller Token')->plainTextToken,
            'token_type' => 'Bearer'
        ], HttpResponse::HTTP_OK);
    }
}
