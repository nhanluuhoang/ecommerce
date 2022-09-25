<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'email'                => 'sometimes|email|unique:users,email',
            'full_name'            => 'sometimes|string',
            'phone'                => 'sometimes|alpha_num|digits_between:10,11|unique:users,phone',
            'gender'               => ['sometimes', 'string', Rule::in(['male', 'female'])],
            'address'              => 'sometimes',
            'address.*.address'     => 'required_with:address|string',
            'address.*.province_id' => 'required_with:address|integer|exists:addresses,id',
            'address.*.district_id' => 'required_with:address|integer|exists:addresses,id',
            'address.*.ward_id'     => 'required_with:address|integer|exists:addresses,id',
            'address.*.default'     => 'required_with:address|boolean',
        ];
    }
}
