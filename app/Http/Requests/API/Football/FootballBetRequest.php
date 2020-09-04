<?php

namespace App\Http\Requests\API\Football;

use Illuminate\Foundation\Http\FormRequest;

class FootballBetRequest extends FormRequest
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
            'football_match_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
            'sum_in' => ['required', 'numeric'],
            'sum_out' => ['required', 'numeric'],
            'to_player' => ['required','integer'],
            'status' => ['required','integer']
        ];
    }
}
