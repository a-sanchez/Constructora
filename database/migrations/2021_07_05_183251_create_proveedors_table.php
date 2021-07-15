<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('rfc')->unique();
            $table->string('razon_social');
            $table->string('alias');
            $table->string('localidad');
            $table->string('banco')->nullable();
            $table->string('cuenta')->nullable();
            $table->string('telefono');
            $table->string('email');
            $table->string('contacto_ventas')->nullable();
            $table->string('contacto_pagos')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedores');
    }
}
