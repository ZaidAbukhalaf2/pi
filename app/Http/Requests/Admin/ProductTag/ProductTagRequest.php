<?php

namespace App\Http\Requests\Admin\ProductTag;

use Illuminate\Foundation\Http\FormRequest;

class ProductTagRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_id' => 'required',
            'tag_id' => 'required'
        ];
    }
}
