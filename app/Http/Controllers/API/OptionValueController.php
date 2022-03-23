<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\OptionValue\CreateOptionValueRequest;
use App\Models\OptionValue;
use App\Queries\Query;

class OptionValueController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $optionValue = new Query(OptionValue::class);
        $optionValue = $optionValue->getColumn(['value_name'])->allowPaginate();
        return $this->httpOK($optionValue);
    }

    /**
     * Display the specified resource.
     *
     * @param OptionValue $optionValue
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(OptionValue $optionValue)
    {
        return $this->httpOK($optionValue);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateOptionValueRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateOptionValueRequest $request)
    {
        OptionValue::query()->create($request->validated());
        return $this->httpNoContent();
    }
}
