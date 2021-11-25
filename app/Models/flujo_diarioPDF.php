<?php

namespace App\Models;

use PDF;
use App\Models\add_new_cuenta;
use App\Models\create_forma_pago;
use App\Models\historial_cuentas;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class flujo_diarioPDF extends Model
{
    use HasFactory;
    public static function create($id){
        $historial=historial_cuentas::find($id);
        $formas=create_forma_pago::all();
        $ingresos_egresos = add_new_cuenta::getEgresosAtrribute($id);
        $cuentas = DB::table('add_new_cuentas')
                    ->join('forma_pagos','add_new_cuentas.id_forma','=','forma_pagos.id')
                    ->where('add_new_cuentas.id_costo','=',$id)->get();
        PDF::AddPage('P', 'Letter');
        $view = \View::make("cuentas.flujo_diarioPDF",compact("historial","formas","ingresos_egresos","cuentas"));
        $html = $view->render();
        PDF::SetFont('helvetica', '',12);
        //OBTIENE INSERTA EL HTML EN EL PDF
        PDF::writeHTMLCell('0','0','10','10',$html);
        PDF::Output();
    }
}
