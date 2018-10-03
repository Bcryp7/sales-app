<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ArticleRequest
 *
 * @package App\Http\Requests
 */
class ArticleRequest extends FormRequest
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
            'category_id' => 'required|int|exists:categories,id',
            'code' => 'required|string',
            'name' => 'required|string|unique:articles,name',
            'price' => 'required|numeric',
            'stock' => 'required|int',
            'description' => 'required|string',
        ];
    }
}
