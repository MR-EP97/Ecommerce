<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductToCartRequest;
use App\Models\Cart;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Support\Facades\Response;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function addProductToCart(AddProductToCartRequest $request, $product_id): JsonResponse
    {
        $cart = $this->haveActiveCart($request);
        $cart->products()->attach($product_id);

        return Response::json([
            'status' => 'success',
            'message' => 'Add product to cart',
            'category' => $cart
        ], HttpResponse::HTTP_OK);

    }

    protected function haveActiveCart($request)
    {

        return Cart::query()->firstOrCreate([
            'status' => 'active',
            'customer_id' => $request->user()->id
        ]);


    }


}
