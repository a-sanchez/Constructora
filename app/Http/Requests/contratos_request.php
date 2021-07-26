<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class contratos_request extends FormRequest
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
        'id_cliente'=>'required|integer',
        /*'calle_contratante'=>'required|string',
        'numero_contratante'=>'required|integer',
        'colonia_contratante'=>'required|string',
        'cp_contratante'=>'required|integer',*/
        'folio'=>'required|string',
        'descripcion'=>'required|string',
        /*'anticipo'=>'required|regex:/^\d*(\.\d{2})?$/',
        'fecha_anticipo'=>'required|date',*/
        'monto'=>'required|regex:/^\d*(\.\d{2})?$/',
        'fecha_inicio'=>'required|date',
        'fecha_final'=>'required|date',
        'nombre_contraparte'=>'required|string',
        'calle_contraparte' =>'required|string',
        'numero_contraparte'=>'required|string',
        'colonia_contraparte' =>'required|string',
        'localidad'=>'required|string',
        'cp_contraparte'=>'required|string',
        'file'=>'required|file'
        ];
    }
}
