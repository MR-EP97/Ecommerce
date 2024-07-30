<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customers\LoginCustomerRequest;
use App\Http\Requests\Customers\StoreCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function registerCustomer(StoreCustomerRequest $request): JsonResponse
    {

        $customer = Customer::query()->create($request->safe()->only(
            'email', 'password', 'first_name', 'last_name', 'phone_number', 'user_name', 'bio', 'profile_picture'
        ));

        return Response::json([
            'status' => 'success',
            'message' => 'User Registered Successfully',
            'access_token' => $customer->createToken('Customer Token')->plainTextToken,
            'token_type' => 'Bearer'
        ], HttpResponse::HTTP_CREATED);
    }

    public function loginCustomer(LoginCustomerRequest $request): JsonResponse
    {


        if (!Auth::guard('customer')->attempt($request->safe()->only('email', 'password'))) {
            return Response::json([
                'status' => 'error',
                'message' => 'Wrong Email/Password',
            ], HttpResponse::HTTP_FORBIDDEN);
        }

        return Response::json([
            'status' => 'success',
            'message' => 'User Login Successfully',
            'access_token' => Auth::guard('customer')->user()->createToken('Customer Token')->plainTextToken,
            'token_type' => 'Bearer'
        ], HttpResponse::HTTP_OK);

    }

    public function logoutCustomer()
    {

    }
}
