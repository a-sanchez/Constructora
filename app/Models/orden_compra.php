<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\contrato;
use App\Models\proveedor;

class orden_compra extends Model
{
    use HasFactory;
    protected $table='orden_compras';
    public $timestamps = false;
    protected $guarded =["productos"];

    public static function setFile($adjunto_compra)
    {
        $ruta="public/docs/ordenes_adjuntos";
        $filename=$adjunto_compra->hashName();
        $adjunto_compra->store($ruta);
        return $filename;

    }


    public static function setProductos($productos,$id){
        $productos = json_decode($productos);
        foreach ($productos as $value) {
            OrdenProducto::create([
                "concepto"=>$value->concepto,
                "unidad"=>$value->unidad,
                "cantidad"=>$value->cantidad,
                "precio_unitario"=>$value->precio_unitario,
                "importe"=> ($value->cantidad*$value->precio_unitario),
                "orden_id"=>$id
            ]);
        }
    }


    public function contrato()
    {
        return $this->belongsTo(contrato::class,"id_contrato");
    }

    public function proveedor()
    {
        return $this->belongsTo(proveedor::class,"id_proveedor");
    }

}
