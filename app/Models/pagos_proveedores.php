<?php

namespace App\Models;

use App\Models\status;
use App\Models\contrato;
use App\Models\proveedor;
use App\Models\orden_compra;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class pagos_proveedores extends Model
{
    use HasFactory;
    protected $table='pagos_proveedores';
    public $timestamps = true;
    protected $guarded=[];
    protected $appends =["status","contrato","orden","forma_pago"];

    public function getStatusAttribute(){
        $status = status::where("id",$this->id_status)->first();
        return $status->status;
    }
    public function getContratoAttribute(){
        $contrato= contrato::where("id",$this->id_contrato)->first();
        return $contrato;
    }

    public function getOrdenAttribute(){
        $orden= orden_compra::where("id",$this->id_orden)->first();
        return $orden;
    }
    public function getFormaPagoAttribute(){
        $forma= create_forma_pago::where("id",$this->id_forma)->first();
        return $forma;
    }
    public function getProveedorAttribute(){
        $proveedor = proveedor::where("id",$this->id_proveedor)->first();
        return $proveedor;
    }
}

