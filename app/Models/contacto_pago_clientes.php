<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contacto_pago_clientes extends Model
{
    use HasFactory;
    protected $table ='contacto_pago_clientes';
    public $timestamps=false;
    protected $guarded=[];
}
