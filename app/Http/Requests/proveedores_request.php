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
            'alias'=>'required|string',
            'razon_social'=>'required|string',
            'localidad'=>'required|string',
            'telefono'=>'required|string',
            'email'=>'required|string'
        ];
    }
}
