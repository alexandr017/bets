<?php

namespace App\Http\Requests\API\Football;

use Illuminate\Foundation\Http\FormRequest;

class FootballMatchRequest extends FormRequest
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
            'football_tour_id' => ['required', 'integer'],
            'player_1' => ['required', 'max:255'],
            'player_2' => ['required', 'max:255'],
            'win' => ['nullable', 'integer'],
            'player_1_goals' => ['nullable', 'integer'],
            'player_2_goals' => ['nullable', 'integer'],
            'game_date' => ['required','date'],
            'status' => ['required','integer']
        ];
    }
}
