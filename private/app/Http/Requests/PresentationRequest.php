<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Support\Facades\Auth;

class PresentationRequest extends FormRequest
{
    public function attributes() {
        return [
            'title'         => '"Titulo Ponencia"',
            'description'   => '"Descripción Ponencia"',
            'extract'       => '"Extracto Ponencia"',
            'price'         => '"Precio Ponencia"',
            'hour'          => '"Hora Ponencia"',
            'id_speaker'    => '"Ponente"',
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
        $numeric    = 'El valor campo :attribute debe de ser numérico.';
        $gte        = 'El valor campo :attribute debe de ser mayor o igual que cero.';
        $lte        = 'El valor campo :attribute debe de ser mayor que uno.';
        $unique     = 'Ya existe un Pokemon con el nombre :value.';
        
        return [
            'title.required'        => $required,
            'title.min'             => $min,
            'title.max'             => $max,
            'title.unique'          => $unique,
            'description.required'  => $required,
            'extract.required'      => $required,
            'extract.min'           => $min,
            'extract.max'           => $max,
            'price.required'        => $required,
            'price.numeric'         => $numeric,
            'price.gte'             => $gte,
            'price.lte'             => $lte,
            'hour.required'         => $required,
            'hour.regex'            => 'Formato de hora incorrecto 00:00',
            'id_speaker.required'   => $required,
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
            'title'         => 'required|min:10|max:100|unique:presentation,title',
            'description'   => 'required',
            'extract'       => 'required|min:10|max:200',
            'price'         => 'required|numeric|gte:0|lte:9999.99',
            'hour'          => 'required|regex:/([0-2][0-9]):([0-5][0-9])/',
            'video_url'     => 'nullable',
            'id_speaker'    => 'required',
        ];
    }
}
