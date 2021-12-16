<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class credito_cuentas extends Model
{
    use HasFactory;
    protected $table = 'credito_cuentas';
    public $timestamps=true;
    protected $guarded=[];
}
