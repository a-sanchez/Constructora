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
            'id_proveedor'=>"required|integer",
            'solicitado'=>'required|string',
            'vobo'=>"required|string",
            'autorizacion'=>"required|string",
            'fecha_orden'=>'required|date',
            'fecha_entrega'=>"required|date",
            'descripcion_orden'=>'required|string',
            'observaciones'=>"string",
            'id_contrato'=>'required|integer',
            'productos'=>'string',
            'iva'=>"required|numeric"
        ];
    }
}
