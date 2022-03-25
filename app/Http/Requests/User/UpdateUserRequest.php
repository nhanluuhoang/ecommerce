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
            'password'             => 'sometimes|string|min:8',
            'full_name'            => 'sometimes|string',
            'phone'                => 'sometimes|alpha_num|digits_between:10,11|unique:users,phone',
            'gender'               => ['sometimes', 'string', Rule::in(['male', 'female'])],
            'address'              => 'sometimes',
            'address.*.address'    => 'required_with_all:address|string',
            'address.*.address_id' => 'required_with_all:address|string',
            'address.*.default'    => 'required_with_all:address|boolean',
        ];
    }
}
