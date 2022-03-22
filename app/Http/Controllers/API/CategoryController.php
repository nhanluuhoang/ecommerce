<?php

namespace App\Http\Controllers\API;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
