<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlatoUpdateRequest extends FormRequest
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
    * Get the error messages for the defined validation rules.
    *
     * @return array
     */
    public function messages()
    {
        return [
        'plt_nom.required' => 'Se requiere un nombre',
        'plt_nom.max' => 'No más de 255 caractéres',
        'plt_des.required' => 'Se requiere una descripción',
        'plt_iva.required' => 'Debe indicar si tiene IVA o NO',
        'plt_visbl.required' => 'Debe indicar si es visible o NO',
        'plt_pvp.regex' => 'Formato de precio nó valido',
    ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'plt_nom' => 'required|max:255',
            'plt_des' => 'required|max:255',
            'plt_pvp' => 'regex:/^\d{1,3}(\.\d{1,2})?$/',
            
        ];
    }
}
