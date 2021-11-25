<?php

namespace App\Models;

use App\Models\create_forma_pago;
use App\Models\historial_cuentas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class add_new_cuenta extends Model
{
    use HasFactory;
    protected $table='add_new_cuentas';
    public $timestamps = true;
    protected $guarded=['total','costo'];
    protected $appends=["forma_pago","gasto"];

    public function getFormaPagoAttribute(){
        $forma= create_forma_pago::where("id",$this->id_forma)->first();
        return $forma;
    }
    public function getGastoAttribute(){
        $costo= historial_cuentas::where("id",$this->id_costo)->first();
        return $costo;
    }

    public static function getEgresosAtrribute($id){
        $egresos = 0;
        $ingresos=0;
        $cuentas=add_new_cuenta::where("id_costo",$id)->get();
        foreach ($cuentas as $cuenta) {
            if (str_contains($cuenta->saldo,'-')) {
                $egresos+=floatval($cuenta->saldo);
            }
            else{
                $ingresos+=floatval($cuenta->saldo);
            }
        }
        return collect(['egresos'=>$egresos,'ingresos'=>$ingresos]);
    }
}
