<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
