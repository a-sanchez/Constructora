<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proveedor_contacto_ventas extends Model
{
    use HasFactory;
    protected $table ="proveedor_contacto_ventas";

    public $timestamps = false;

    protected $guarded =[];
}
