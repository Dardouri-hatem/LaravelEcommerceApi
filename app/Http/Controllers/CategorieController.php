<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecategorieRequest;
use App\Http\Requests\UpdatecategorieRequest;
use App\Models\categorie;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $categories = Category::latest()
            ->paginate(6)
            ->appends(request()->query());

        $categories = CategoryResource::collection($categories)
            ->response()
            ->getData(true);

        return $this->wrapResponse(Response::HTTP_OK, 'Success', $categories);
    }

    /**
     * Display the specified resource.
     *
     * @param  Category  $category
     * @return JsonResponse
     */
    public function show(Category $category): JsonResponse
    {
        $category = (new CategoryResource($category->load('products')))
            ->response()
            ->getData(true);

        return $this->wrapResponse(Response::HTTP_OK, 'Success', $category);
    }

    private function wrapResponse(int $code, string $message, ?array $resource = []): JsonResponse
    {
        $result = [
            'code' => $code,
            'message' => $message
        ];

        if (count($resource)) {
            $result = array_merge($result, ['data' => $resource['data']]);

            if (count($resource) > 1)
                $result = array_merge($result, ['pages' => ['links' => $resource['links'], 'meta' => $resource['meta']]]);
        }

        return response()->json($result, $code);
    }
}