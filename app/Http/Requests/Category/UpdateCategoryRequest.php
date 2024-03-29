<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
                'sometimes',
                'nullable',
                'numeric',
                'exists:categories,id',
            ],
            'title'       => 'sometimes|string',
            'sort_order' => 'sometimes|integer|min:0',
            'is_public'  => 'sometimes|boolean'
        ];
    }
}
