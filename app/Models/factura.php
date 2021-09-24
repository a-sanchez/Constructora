<?php

namespace App\Models;

use App\Models\status;
use App\Models\contrato;
use App\Models\create_forma_pago;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class factura extends Model
{
    use HasFactory;
    protected $table='facturas';
    public $timestamps=true;
    protected $guarded=[];
    protected $appends =["status","contrato","forma_pago"];

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
    public function getFormaPagoAttribute(){
        $forma= create_forma_pago::where("id",$this->id_forma)->first();
        return $forma;
    }

    public function setFile($file)
    {
        
        $filename =$file->hashName();
        $file->store($this->getRuta());
        $this->attributes["pdf_oficial"] = $filename;
        $this->save();
        //return $filename;
    }

    public function setFile2($file)
    {
        
        $filename =$file->hashName();
        $file->store($this->getRuta());
        $this->attributes["xml_oficial"] = $filename;
        $this->save();
        //return $filename;
    }

    public function getRuta()
    {
        $ruta ="public/docs/facturas_oficiales/".str_replace("/","_",$this->attributes["folio_prefactura"]);
        return $ruta;
    }
}
