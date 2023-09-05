<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSolarSystemRequest extends FormRequest
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
            'dimension' => 'required|regex:/^[-]?[0-9]+$/i',
            'number_of_planets' => 'required|regex:/^[-]?[0-9]+$/i',
            'main_star' => 'required|max:100'
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
            'number_of_planets.required' => 'O campo número de planetas é obrigatório.',
            'number_of_planets.regex' => 'O campo número de planetas é inválido.',
            'main_star.required' => 'O campo estrela principal é obrigatório.',
        ];
    }
}
