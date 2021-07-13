<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    use HasFactory;
    protected $table='clientes';
    public $timestamps=false;

    protected $fillable=[
        'cliente',
        'razon_social',
        'alias',
        'telefono',
        'telefono2',
        'email',
        'contacto_pago',
        'localidad',
        'calle',
        'numero',
        'colonia',
        'cp'
    ];
}
