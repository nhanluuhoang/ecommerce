<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
            'email'                => 'required|email|unique:users,email',
            'password'             => 'required|string|min:8',
            'full_name'            => 'required|string',
            'phone'                => 'required|alpha_num|digits_between:10,11|unique:users,phone',
            'gender'               => ['required', 'string', Rule::in(['male', 'female'])],
            'address'              => 'required',
            'address.*.address'    => 'required_with_all:address|string',
            'address.*.address_id' => 'required_with_all:address|string',
            'address.*.default'    => 'required_with_all:address|boolean',
        ];
    }
}
