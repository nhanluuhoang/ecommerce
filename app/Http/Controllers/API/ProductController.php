<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Models\VariantValue;
use App\Queries\Query;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProductController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = new Query(Product::class);
        $products = $products->filterBy([
            'category_id' => '=',
            'title'       => 'partial',
            'sku'         => 'partial',
            'status'      => '='
        ])
            ->sortFieldsBy(['title', 'price'])
            ->allowPaginate();

        return $this->httpOK($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateProductRequest $request)
    {
        $data = $request->validated();
        $data['sku'] = strtoupper(uniqid());
        $variantValues = Arr::get($data, 'variant_values', []);

        DB::beginTransaction();
        try {
            $product = Product::query()->create($data);

            foreach ($variantValues as $item) {
                $item['product_id'] = $product->id;
                $item['sku'] = strtoupper(uniqid());

                VariantValue::query()->create($item);
            }

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->httpBadRequest(['message' => $exception->getMessage()]);
        }

        return $this->httpNoContent();
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product)
    {
        $product = Product::query()->where('id', $product->id)->with([
            'category'      => function ($query) {
                $query->select('id', 'name', 'slug');
            },
            'options'       => function ($query) {
                $query->select('options.id', 'options.option_name');
            },
            'optionValues'  => function ($query) {
                $query->select('option_values.id', 'option_values.value_name');
            },
            'variantValues' => function ($query) {
                $query->select('id', 'product_id', 'option_id', 'value_id', 'variant_value_name', 'sku', 'quantity', 'price');
            }
        ])->first();

        return $this->httpOK($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $variantValues = Arr::get($data, 'variant_values', []);

        DB::beginTransaction();
        try {
            $product->update($data);

            $tmpVariantValues = [];
            foreach ($variantValues as $item) {
                if (isset($item['id'])) {
                    $variantValues = VariantValue::query()->findOrFail($item['id']);
                    $variantValues->update($item);
                    $tmpVariantValues[] = $item['id'];
                } else {
                    $item['product_id'] = $product->id;
                    $item['sku'] = strtoupper(uniqid());
                    $variantValue = VariantValue::query()->create($item);
                    $tmpVariantValues[] = $variantValue->id;
                }
            }

            // delete variant values
            $variantValuesOld = VariantValue::query()
                ->select('id')
                ->where('product_id', $product->id)
                ->get()
                ->pluck('id');
            $arrDiff = array_diff($tmpVariantValues, $variantValuesOld->toArray());
            VariantValue::query()->whereIn('id', $arrDiff)->delete();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->httpBadRequest(['message' => $exception->getMessage()]);
        }
        return $this->httpNoContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return $this->httpOK($product);
    }
}
