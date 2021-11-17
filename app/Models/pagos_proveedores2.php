<?php

namespace App\Models;

use App\Models\orden_compra;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class pagos_proveedores2 extends Model
{
    use HasFactory;
    protected $table='pagos_proveedores2s';
    public $timestamps = true;
    protected $guarded=[];
     protected $appends =["status","contrato","forma_pago"];
    public function getStatusAttribute(){
         $status = status::where("id",$this->id_status)->first();
         return $status;
     }
     
     public function getContratoAttribute(){
         $contrato= contrato::where("id",$this->id_contrato)->first();
         return $contrato;
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
