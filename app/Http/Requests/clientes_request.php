<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class clientes_request extends FormRequest
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
        'cliente'=>'required|string',
        'razon_social'=>'required|string',
        'alias'=>'required|string',
        'localidad'=>'required|string',
        'calle'=>'required|string',
        'numero'=>'required|string',
        'colonia'=>'required|string',
        'cp'=>'string',
        'contacto_cliente'=>'string'
        //'contacto_pagos'=>'string'
        ];
    }
}
