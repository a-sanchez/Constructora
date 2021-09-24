<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\cliente;
use Illuminate\Support\Facades\Storage;

class contrato extends Model
{
    use HasFactory;
    protected $table='contratos';
    public $timestamps = false;

    protected $guarded =[""];
    public function cliente(){
        return $this->belongsTo(cliente::class,"id_cliente");
    }

    

    public function setFile($file)
    {
        if( $this->attributes["file"] != null){
            Storage::delete($this->getRuta()."/".$this->attributes["file"]);
        }
        $filename =$file->hashName();
        $file->store($this->getRuta());
        $this->attributes["file"] = $filename;
        $this->save();
        //return $filename;
    }

    public function setFile2($file)
    {
        if( $this->attributes["file2"] != null){
            Storage::delete($this->getRuta()."/".$this->attributes["file2"]);
        }
        $filename =$file->hashName();
        $file->store($this->getRuta());
        $this->attributes["file2"] = $filename;
        $this->save();
        //return $filename;
    }

    public function setFile3($file)
    {
        if( $this->attributes["file3"] != null){
            Storage::delete($this->getRuta()."/".$this->attributes["file3"]);
        }
        $filename =$file->hashName();
        $file->store($this->getRuta());
        $this->attributes["file3"] = $filename;
        $this->save();
        //return $filename;
    }

    public function setFile4($file)
    {
        if( $this->attributes["file4"] != null){
            Storage::delete($this->getRuta()."/".$this->attributes["file4"]);
        }
        $filename =$file->hashName();
        $file->store($this->getRuta());
        $this->attributes["file4"] = $filename;
        $this->save();
        //return $filename;
    }

    public function getRuta()
    {
        $ruta ="public/docs/contrato_adjuntos/".$this->attributes["folio"];
        return $ruta;
    }
}
