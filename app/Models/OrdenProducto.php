<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenProducto extends Model
{
    use HasFactory;
    protected $table = "orden_productos";
    protected $guarded = [];
    public $timestamps = false;

    public function setImporte()
    {
        $this->attributes['importe'] = floatval($this->attributes["cantidad"] * $this->attributes["precio_unitario"]);
        $this->save();
    }
}
