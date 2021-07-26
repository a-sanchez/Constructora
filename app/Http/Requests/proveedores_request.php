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
            'rfc'=>'required|string',
            'razon_social'=>'required|string',
            'alias'=>'required|string',
            'localidad'=>'required|string',
            'banco'=>'required|string',
            'cuenta'=>'required|string',
            'contacto_ventas'=>'string'
            //'contacto_pagos'=>'string'
        ];
    }
}
