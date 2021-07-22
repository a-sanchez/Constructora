<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\contacto_cliente_clientes;
use App\Models\contacto_pago_clientes;

class cliente extends Model
{
    use HasFactory;
    protected $table='clientes';
    public $timestamps=false;

    /*protected $fillable=[
        'cliente',
        'razon_social',
        'alias',
        'telefono',
        'telefono2',
        'email',
        'rfc',
        'contacto_pago',
        'localidad',
        'calle',
        'numero',
        'colonia',
        'cp'
    ];*/

    protected $guarded=[
        'contacto_cliente',
        'contacto_pagos'
    ];

    public static function contactos($id_cliente,$contacto_cliente,$contacto_pagos){
        $contacto_cliente=json_decode($contacto_cliente);
        foreach($contacto_cliente as $cliente){
            contacto_cliente_clientes::create([
                'email'=>$cliente->email,
                'telefono'=>$cliente->telefono,
                'id_cliente'=>$id_cliente
            ]);

        }

        $contacto_pagos=json_decode($contacto_pagos);
        foreach($contacto_pagos as $pago){
            contacto_pago_clientes::create([
                'email'=>$pago->email,
                'telefono'=>$pago->telefono,
                'id_cliente'=>$id_cliente
            ]);
        }
    }
}
