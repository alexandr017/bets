<?php

namespace App\Http\Requests\API\Football;

use Illuminate\Foundation\Http\FormRequest;

class FootballTourRequest extends FormRequest
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
            'football_category_id' => ['required', 'integer'],
            'tour_title' => ['required', 'max:255']
        ];
    }
}
