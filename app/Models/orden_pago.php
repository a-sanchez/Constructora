<?php

namespace App\Models;

use App\Models\orden_compra;
use App\Models\pagos_proveedores;
use App\Models\pagos_proveedores2;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class orden_pago extends Model
{
    use HasFactory;
    protected $table = 'orden_pagos';
    public $timestamps=false;
    protected $guarded=['id_contrato'];
    protected $appends=["orden","pago","status"];

    public function getOrdenAtrribute(){
        $orden = orden_compra::where("id",$this->id_orden)->first();
        return $orden;
    }

    public function orden(){
        return $this->belongsTo(orden_compra::class,"id_orden");
    }

    public function getPagoAttribute(){
        $pago=pagos_proveedores2::where("id",$this->id_pago)->first();
        return $pago;
    }

    public function getStatusAttribute(){
        $status = status::where("id",$this->id_status)->first();
        return $status->status;
    }
}
