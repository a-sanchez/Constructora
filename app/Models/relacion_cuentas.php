<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class relacion_cuentas extends Model
{
    
    use HasFactory;
    protected $table='relacion_cuentas';
    public $timestamps = true;
    protected $guarded = [];

    public function setTotalTotalAttributes()
    {
        $this->attributes['total_total'] = floatval($this->attributes['monto']) - floatval($this->attributes['programado']);
        $this->save();
    }

    public static function setSumaMonto($cuenta_id){

        $proveedores =relacion_cuentas::where("cuenta_id",$cuenta_id)->get();

        $suma_monto=0;
        foreach ($proveedores as $proveedor) {
            $suma_monto += $proveedor->monto;
        }
        return number_format($suma_monto,2);
    }

    public static function setSumaProgramado($cuenta_id){

        $proveedores =relacion_cuentas::where("cuenta_id",$cuenta_id)->get();

        $suma_programado=0;
        foreach ($proveedores as $proveedor) {
            $suma_programado += $proveedor->programado;
        }
        return number_format($suma_programado,2);
    }

    public static function setSumaTotal($cuenta_id){
        $proveedores = relacion_cuentas::where("cuenta_id",$cuenta_id)->get();
        $suma_total = 0;
        foreach ($proveedores as $proveedor) {
            $suma_total += $proveedor->total_total;
        }
        return number_format($suma_total,2);
    }


}
