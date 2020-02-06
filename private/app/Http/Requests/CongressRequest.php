<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Support\Facades\Auth;

class CongressRequest extends FormRequest
{
    
    public function attributes() {
        return [
            'title'        => '"Titulo Congreso"',
            'description'  => '"Descripción Congreso"',
            'date'         => '"Fecha Congreso"',
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }
    
    public function messages() {
        $required   = 'El campo :attribute es obligatorio';
        $min        = 'La longitud mínima del campo :attribute es :min';
        $max        = 'La longitud máxima del campo :attribute es :max';
        $unique     = 'Ya existe un Pokemon con el nombre :value.';
        
        return [
            'title.required'        => $required,
            'title.min'             => $min,
            'title.max'             => $max,
            'title.unique'          => $unique,
            'description.required'  => $required,
            'date.required'         => $required,
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
            'title'         => 'required|min:10|max:100|unique:congress,title',
            'description'   => 'required',
            'date'          => 'required',
        ];
    }
}
