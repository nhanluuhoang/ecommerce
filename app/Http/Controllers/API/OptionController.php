<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Option\CreateOptionRequest;
use App\Models\Option;
use App\Queries\Query;

class OptionController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $option = new Query(Option::class);
        $option = $option->getColumn(['value'])->allowPaginate();
        return $this->httpOK($option);
    }

    /**
     * Display the specified resource.
     *
     * @param Option $option
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Option $option)
    {
     return $this->httpOK($option);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateOptionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateOptionRequest $request)
    {
        Option::query()->create($request->validated());
        return $this->httpNoContent();
    }
}
