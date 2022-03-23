<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Queries\Query;
use Illuminate\Http\Request;

class CategoryController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\InvalidFilterQuery
     * @throws \App\Exceptions\InvalidSortQuery
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $query = new Query(Category::class);
        $query = $query
            ->getColumn(['name', 'slug', 'sort_order'])
            ->filterBy([
                'name' => 'partial'
            ])
            ->customQuery([
                $query->getQuery()->isPublic()
            ])
            ->sortFieldsBy(['name', 'sort_order'])
            ->allowPaginate();

        return $this->httpOK($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateCategoryRequest $request)
    {
        $categories = Category::query()->create($request->validated());
        return $this->httpCreated($categories);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Category $category)
    {
        return $this->httpOK($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->slug = null;
        $category->update($request->validated());

        return $this->httpOK($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->httpNoContent();
    }
}
