<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class orden_request extends FormRequest
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
            'folio_orden'=>'required|string',
            'id_contrato'=>'required|integer',
            'solicitado'=>'required|string',
            'fecha_orden'=>'required|date',
            'descripcion_orden'=>'required|string',
            'importe_orden'=>'required|regex:/^\d*(\.\d{2})?$/',
            'adjunto_compra'=>'required|file'
        ];
    }
}
