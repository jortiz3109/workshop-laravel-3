<?php

namespace App\Http\Requests\Admin\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'code' => [
                'required',
                'string',
                'size:6',
                Rule::unique('products')->ignoreModel($this->route('product'))
            ],
            'name' => [
                'required',
                'string',
                'min:2',
                'max:80',
                Rule::unique('products')->ignoreModel($this->route('product'))
            ],
            'price' => [
                'required',
                'numeric'
            ],
        ];
    }
}
