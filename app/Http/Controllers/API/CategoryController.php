<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Queries\Query;
use Illuminate\Support\Facades\DB;

class CategoryController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\InvalidFilterQuery
     * @throws \App\Exceptions\InvalidSortQuery
     */
    public function index()
    {
        $query = new Query(Category::class);
        $query = $query
            ->getColumn(['title', 'sort_order', 'is_public', 'parent_id'])
            ->customQuery([
                $query->getQuery()->orderBy('sort_order', 'asc')
            ])
            ->allowPaginate();

        $categories = $this->buildTree($query);

        return $this->httpOK($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            Category::query()->create($request->validated());
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->httpBadRequest(['message' => $exception->getMessage()]);
        }

        return $this->httpNoContent();
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Category $category)
    {
        $category = Category::query()->with('parent')->findOrFail($category->id);
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
        DB::beginTransaction();
        try {
            $category->slug = null;
            $category->update($request->validated());
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->httpBadRequest(['message' => $exception->getMessage()]);
        }

        return $this->httpNoContent();
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

    /**
     * @param $src_arr
     * @param int $parent_id
     * @return array
     */
    private function buildTree($src_arr, int $parent_id = 0): array
    {
        $tree = array();
        foreach($src_arr as $idx => $row) {
            if($row['parent_id'] == $parent_id) {
                $subTree = $this->buildtree($src_arr, $row['id']);
                if (count($subTree) > 0) {
                    $row['children'] = $subTree;
                }
                $tree[] = $row;
                unset($src_arr[$idx]);
            }
        }
        return $tree;
    }
}
