<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Queries\Query;
use App\Services\ProductService;
use App\Services\UploadFileService;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProductController extends ApiBaseController
{

    private $productService;

    private $uploadFileService;

    public function __construct()
    {
        $this->productService = new ProductService();
        $this->uploadFileService = new UploadFileService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $query = new Query(Product::class);
        $products = $query->filterBy([
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
        $images = Arr::get($data, 'images', []);
        $dataProduct = Arr::except($data, 'thumbnails');

        DB::beginTransaction();
        try {
            $product = Product::query()->create($dataProduct);
            $thumbnails = $this->uploadFileService->createImageBase64($product->id, $data['thumbnails'], Product::class, false);

            $product->thumbnails = $thumbnails;
            $product->save();

            $this->productService->createVariantValue($product->id, $variantValues);

            $this->uploadFileService->createImageBase64($product->id, $images, Product::class);

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
        $productID = $product->id;
        $product = Product::query()
            ->where('id', $productID)
            ->with([
                'options'       => function ($query) use ($productID) {
                    return $query->select('options.id', 'options.value')
                        ->with('optionValues', function ($query) use ($productID) {
                            return $query->select('option_values.id', 'option_values.value')
                                ->where('product_id', $productID);
                        });
                },
                'variantValues' => function ($query) {
                    $query->select(
                        'id',
                        'product_id',
                        'option_id',
                        'value_id',
                        'product_value_name',
                        'sku',
                        'quantity',
                        'price'
                    );
                },
                'images'        => function ($query) {
                    $query->select('id', 'attachable_id', 'attachable_type', 'path');
                }
            ])
            ->first();

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
            $this->productService->updateVariantValue($product->id, $variantValues);

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
