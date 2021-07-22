<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contacto_cliente_clientes extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table='contacto_cliente_clientes';
    protected $guarded=[];
}
