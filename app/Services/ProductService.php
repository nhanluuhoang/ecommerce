<?php

namespace App\Services;

use App\Models\VariantValue;

class ProductService {

    /**
     * Create variant value
     * @param $productId
     * @param $variantValues
     * @return void
     */
    public function createVariantValue($productId, $variantValues)
    {
        foreach ($variantValues as $item) {
            $item['product_id'] = $productId;
            $item['sku'] = strtoupper(uniqid());

            VariantValue::query()->create($item);
        }
    }

    public function updateVariantValue($productId, $variantValues)
    {
        $tmpVariantValues = [];
        foreach ($variantValues as $item) {
            if (isset($item['id'])) {
                $variantValues = VariantValue::query()->findOrFail($item['id']);
                $variantValues->update($item);
                $tmpVariantValues[] = $item['id'];
            } else {
                $item['product_id'] = $productId;
                $item['sku'] = strtoupper(uniqid());
                $variantValue = VariantValue::query()->create($item);
                $tmpVariantValues[] = $variantValue->id;
            }
        }

        // delete variant values
        $variantValuesOld = VariantValue::query()
            ->select('id')
            ->where('product_id', $productId)
            ->get()
            ->pluck('id');
        $arrDiff = array_diff($tmpVariantValues, $variantValuesOld->toArray());
        VariantValue::query()->whereIn('id', $arrDiff)->delete();
    }
}
