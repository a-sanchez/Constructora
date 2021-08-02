<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contrato extends Model
{
    use HasFactory;
    protected $table='contratos';
    public $timestamps = false;

    protected $guarded =[];

    /*public static function setFile($file)
    {
        $ruta = "public/docs/contrato_adjuntos";
        $filename =$file->hashName();
        $file->store($ruta);
        return $filename;
    }*/


    public function setFile($file)
    {
        $filename =$file->hashName();
        $file->store($this->getRuta());
        $this->attributes["file"] = $filename;
        $this->save();
        //return $filename;
    }

    public function setFile2($file)
    {
        $filename =$file->hashName();
        $file->store($this->getRuta());
        $this->attributes["file2"] = $filename;
        $this->save();
        //return $filename;
    }

    public function setFile3($file)
    {
        $filename =$file->hashName();
        $file->store($this->getRuta());
        $this->attributes["file3"] = $filename;
        $this->save();
        //return $filename;
    }

    public function setFile4($file)
    {
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
