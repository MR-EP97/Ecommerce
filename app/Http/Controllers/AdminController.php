<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\AdminLoginRequest;
use App\Models\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class AdminController extends Controller
{
    public function __invoke(AdminLoginRequest $request): JsonResponse
    {

        $admin = Admin::query()->where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return Response::json([
                'status' => 'error',
                'message' => 'Wrong Email/Password',
            ], HttpResponse::HTTP_UNAUTHORIZED);
        }

        return Response::json([
            'status' => 'success',
            'message' => 'Admin Login Successfully',
            'access_token' => $admin->createToken('Admin Token')->plainTextToken,
            'token_type' => 'Bearer'
        ], HttpResponse::HTTP_OK);
    }
}
