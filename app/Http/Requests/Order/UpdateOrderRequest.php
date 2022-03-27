<?php

namespace App\Http\Requests\Order;

use App\Enums\OrderStatusCodeEnum;
use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrderRequest extends FormRequest
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
            'user_id'                            => 'sometimes|integer|exist:users,id',
            'total_amount'                       => 'sometimes|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0',
            'total_discount'                     => 'sometimes|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0',
            'order_status_code'                  => [
                'sometimes',
                Rule::in([OrderStatusCodeEnum::DRAFT, OrderStatusCodeEnum::SUBMITTED])
            ],
            'note'                               => 'sometimes|string',
            'order_items'                        => 'sometimes',
            'order_items.*.id'                   => 'sometimes|integer|exists:order_items,id',
            'order_items.*.product_id'           => 'required_with:order_items|integer|exists:products,id',
            'order_items.*.product_title'        => 'required_with:order_items|string',
            'order_items.*.product_variant_name' => 'required_with:order_items|string',
            'order_items.*.quantity'             => 'required_with:order_items|integer',
            'order_items.*.price'                => 'required_with:order_items|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0',
            'order_items.*.discount_amount'      => 'required_with:order_items|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0',
            'shipments'                          => 'sometimes',
            'shipments.full_name'                => 'required_with:shipments|string',
            'shipments.phone'                    => 'required_with:shipments|alpha_num|digits_between:10,11',
            'shipments.address'                  => 'required_with:shipments',
            'shipments.address.address'          => 'required_with:shipments.address|string',
            'shipments.address.address_id'       => 'required_with:shipments.address|string',
        ];
    }
}
