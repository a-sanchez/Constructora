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
            $table->id('id_proveedor');
            $table->string('nombre_empresa');
            $table->string('alias');
            $table->string('razon_social');
            $table->string('calle');
            $table->integer('numero');
            $table->string('colonia');
            $table->integer('cp');
            $table->bigInteger('numero_factura')->unsigned();
            $table->foreign('numero_factura')->references('numero_factura')->on('facturas');
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
