<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Psy\Util\Json;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return Response::json([
            'status' => 'success',
            'message' => 'Show all products',
            'products' => ProductCollection::make(Product::all()),
        ], HttpResponse::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = Product::query()->create(
            $request->only('name', 'seller_id')
        );

        return Response::json([
            'status' => 'success',
            'message' => 'Product created successfully',
            'product' => ProductResource::make($product),
        ], HttpResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): JsonResponse
    {
        return Response::json([
            'status' => 'success',
            'message' => 'show specifics product',
            'product' => ProductResource::make($product),
        ], HttpResponse::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $product->update(
            $request->safe()->only('name', 'seller_id')
        );

        return Response::json([
            'status' => 'success',
            'message' => 'Product updated successfully',
            'product' => ProductResource::make($product),
        ], HttpResponse::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return Response::json([
            'status' => 'success',
            'message' => 'Product deleted successfully',
        ], HttpResponse::HTTP_NO_CONTENT);
    }
}
