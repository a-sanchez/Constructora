<?php

namespace App\Models;

use App\Models\status;
use App\Models\contrato;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class factura extends Model
{
    use HasFactory;
    protected $table='facturas';
    public $timestamps=true;
    protected $guarded=[];
    protected $appends =["status","contrato"];

    public function getStatusAttribute(){
        $status = status::where("id",$this->id_status)->first();
        return $status->status;
    }

    public function getContratoAttribute(){
        $contrato= contrato::where("id",$this->id_contrato)->first();
        return $contrato;
    }
    public function getClienteAttribute(){
        $contrato= contrato::where("id",$this->id_contrato)->first();
        return $contrato;
    }
    

}
