<?php

namespace App\Http\Requests\API\Football;

use Illuminate\Foundation\Http\FormRequest;

class FootballCategoryRequest extends FormRequest
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
            'category_title' => ['required', 'unique:football_categories', 'max:255']
        ];
    }

    /*
    public function attributes()
    {
        return [
            'category_title' => 'Категория'
        ];
    }
    */


}
