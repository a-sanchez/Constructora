<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\proveedor_contacto_ventas;
use App\Models\proveedor_contacto_pagos;

class proveedor extends Model
{
    use HasFactory;

    protected $table ="proveedores";

    public $timestamps = false;
    
    /*protected $fillable = [
        "nombre_empresa",
        "alias",
        "razon_social",
        "localidad",
        "telefono",
        "telefono2",
        "email",
        "email2",
        "contacto_ventas",
        "contacto_pagos"
    ];*/
    protected $guarded =[
        'contacto_pagos',
        'contacto_ventas'
    ];

    public static function contactos($id_proveedor,$venta_contactos,$venta_pagos){
        $venta_contactos=json_decode($venta_contactos);
        foreach($venta_contactos as $venta){
        proveedor_contacto_ventas::create([
            'email'=>$venta->email,
            'telefono'=>$venta->telefono,
            'id_proveedor'=>$id_proveedor
        ]);
    
        }
        $venta_pagos=json_decode($venta_pagos);
        foreach($venta_pagos as $pago){
            proveedor_contacto_pagos::create([
                'email'=>$pago->email,
                'telefono'=>$pago->telefono,
                'id_proveedor'=>$id_proveedor
            ]);

        }

      
        
    }
}
