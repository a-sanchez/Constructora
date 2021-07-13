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

    public static function setFile($file)
    {
        $ruta = "docs/contrato_adjuntos";
        $filename =$file->hashName();
        $file->store($ruta);
        return $filename;
    }
}
