<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Psy\Util\Json;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $categories = Category::with('products')->paginate(5);

        return Response::json([
            'status' => 'success',
            'message' => 'Show all categories ',
            'category' => $categories
        ], HttpResponse::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $category = Category::query()->create($request->safe()->only('name', 'parent_id', 'description'));
        return Response::json([
            'status' => 'success',
            'message' => 'Category created successfully',
            'product' => CategoryResource::make($category),
        ], HttpResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): JsonResponse
    {
        return Response::json([
            'status' => 'success',
            'message' => 'Show Category',
            'category' => CategoryResource::make($category),
        ], HttpResponse::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {

        $category->update(
            $request->safe()->only('name', 'description', 'parent_id')
        );

        return Response::json([
            'status' => 'success',
            'message' => 'Product updated successfully',
            'product' => CategoryResource::make($category),
        ], HttpResponse::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        return Response::json([
            'status' => 'success',
            'message' => 'Product deleted successfully',
        ], HttpResponse::HTTP_NO_CONTENT);
    }
}
