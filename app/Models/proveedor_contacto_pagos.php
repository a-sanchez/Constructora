<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proveedor_contacto_pagos extends Model
{
    use HasFactory;
    protected $table ="proveedor_contacto_pagos";

    public $timestamps = false;

    protected $guarded =[];
}
