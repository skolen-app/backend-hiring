<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlanetRequest extends FormRequest
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
            'name' => 'required|max:100',
            'dimension' => 'required|regex:/^[0-9]+$/i',
            'number_of_moons' => 'required|regex:/^[0-9]+$/i',
            'light_years_from_the_main_star' => 'required|regex:/^[0-9]+$/i'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'dimension.required' => 'O campo dimensão é obrigatório.',
            'dimension.regex' => 'O campo dimensão é inválido.',
            'number_of_moons.required' => 'O campo número de luas é obrigatório.',
            'number_of_moons.regex' => 'O campo número de luas é inválido.',
            'light_years_from_the_main_star.required' => 'O campo anos-luz da estrela principal é obrigatório.',
            'light_years_from_the_main_star.regex' => 'O campo anos-luz da estrela principal é inválido.'
        ];
    }
}
