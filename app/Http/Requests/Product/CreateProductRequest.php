<?php

namespace App\Http\Requests\Product;

use App\Rules\ExistOptionAndValueRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id'                         => 'required|integer|exists:categories,id',
            'title'                               => 'required|string|max:255',
            'descriptions'                        => 'required|string',
            'thumbnails.'                         => 'required|string|image64:jpeg,jpg,png|image64Size:' . config('ecommerce.file_size'),
            'price'                               => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0',
            'status'                              => 'required|boolean',
            'quantity'                            => 'required|integer|min:0',
            'options'                             => 'filled',
            'options.*.id'                        => 'required|integer|exists:options,id',
            'options.*.value'                     => 'required|string',
            'option_values'                       => 'filled',
            'option_values.*.id'                  => 'sometimes|integer|exists:option_values,id',
            'option_values.*.value'               => 'required|string',
            'variant_values'                      => 'required_if:options,option_values',
            'variant_values.*.option_id'          => [
                'required',
                'integer',
                new ExistOptionAndValueRule($this->get('options', []))
            ],
            'variant_values.*.value_id'           => [
                'required',
                'integer',
                new ExistOptionAndValueRule($this->get('option_values', []))
            ],
            'variant_values.*.product_value_name' => 'required|string',
            'variant_values.*.sku'                => 'required|string',
            'variant_values.*.price'              => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0',
            'variant_values.*.quantity'           => 'required|integer|min:0',
            'images'                              => 'required|array|max:8',
            'images.*'                            => 'required|string|image64:jpeg,jpg,png|image64Size:' . config('ecommerce.file_size'),
        ];
    }
}
