<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'parent_id'  => [
                'nullable',
                'numeric',
                'exists:categories,id'
            ],
            'name'       => 'required|string',
            'sort_order' => 'integer|min:0',
            'is_public'  => 'boolean'
        ];
    }
}
