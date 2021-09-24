<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class create_forma_pago extends Model
{
    use HasFactory;
    protected $table='forma_pagos';
    public $timestamps=true;
    protected $guarded=[];
}
