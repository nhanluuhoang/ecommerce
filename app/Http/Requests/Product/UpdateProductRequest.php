<?php

namespace App\Http\Requests\Product;

use App\Rules\ExistOptionAndValueRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'category_id'                         => 'sometimes|integer|exists:categories,id',
            'title'                               => 'sometimes|string|max:255',
            'descriptions'                        => 'sometimes|string',
            'thumbnails'                          => 'sometimes|string',
            'price'                               => 'sometimes|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0',
            'status'                              => 'sometimes|boolean',
            'quantity'                            => 'sometimes|integer|min:0',
            'options'                             => 'filled',
            'options.*.id'                        => 'sometimes|integer|exists:options,id',
            'options.*.option_name'               => 'sometimes|string',
            'option_values'                       => 'filled',
            'option_values.*.id'                  => 'sometimes|integer|exists:option_values,id',
            'option_values.*.value_name'          => 'sometimes|string',
            'variant_values'                      => 'required_with_all:options,option_values',
            'variant_values.*.id'                 => 'sometimes|integer|exists:variant_values,id',
            'variant_values.*.option_id'          => [
                'sometimes',
                'integer',
                new ExistOptionAndValueRule($this->get('options'))
            ],
            'variant_values.*.value_id'           => [
                'sometimes',
                'integer',
                new ExistOptionAndValueRule($this->get('option_values'))
            ],
            'variant_values.*.variant_value_name' => 'sometimes|string',
            'variant_values.*.sku'                => 'sometimes|string',
            'variant_values.*.price'              => 'sometimes|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0',
            'variant_values.*.quantity'           => 'sometimes|integer|min:0',
        ];
    }
}
