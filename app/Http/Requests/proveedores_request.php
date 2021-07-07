<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class proveedores_request extends FormRequest
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
            'nombre_empresa'=> 'required|string',
            'alias'=>'required|string',
            'razon_social'=>'required|string',
            'calle'=>'required|string',
            'numero'=>'required|integer',
            'colonia'=>'required|string',
            'cp'=>'required|integer',
            'rfc'=>'required|string'
        ];
    }
}
