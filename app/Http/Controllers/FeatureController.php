<?php

namespace App\Http\Controllers;

use App\Http\Requests\Feature\StoreFeatureRequest;
use App\Http\Requests\Feature\UpdateFeatureRequest;
use App\Models\Feature;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class FeatureController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeatureRequest $request): JsonResponse
    {
        $feature = Feature::query()->create($request->safe()->only('name'));

        return Response::json([
            'status' => 'success',
            'message' => 'Feature created successfully',
            'feature' => $feature,
        ], HttpResponse::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeatureRequest $request, Feature $feature): JsonResponse
    {
        $feature->update($request->safe()->only('name'));
        return Response::json([
            'status' => 'success',
            'message' => 'Feature updated successfully',
            'feature' => $feature
        ], HttpResponse::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $feature): JsonResponse
    {
        $feature->delete();
        return Response::json([
            'status' => 'success',
            'message' => 'Feature deleted successfully',
        ], HttpResponse::HTTP_NO_CONTENT);
    }
}
