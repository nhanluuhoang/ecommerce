<?php

namespace App\Http\Requests\Category;

use App\Enums\CategoryTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'title'      => 'required|string',
            'sort_order' => 'integer|min:0|required',
            'is_public'  => 'boolean|required',
            'type'       => ['required', Rule::in(CategoryTypeEnum::getValues())]
        ];
    }
}
