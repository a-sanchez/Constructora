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
}
