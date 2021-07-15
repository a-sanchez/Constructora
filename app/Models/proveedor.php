<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    protected $guarded =[];
}
