<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orden_compra extends Model
{
    use HasFactory;
    protected $table='orden_compras';
    public $timestamps = false;
    protected $guarded =[];

    public static function setFile($adjunto_compra)
    {
        $ruta="public/docs/ordenes_adjuntos";
        $filename=$adjunto_compra->hashName();
        $adjunto_compra->store($ruta);
        return $filename;

    }

}
