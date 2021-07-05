<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id('numero_factura');
            $table->bigInteger('numero_contrato')->unsigned();
            $table->foreign('numero_contrato')->references('numero_contrato')->on('contratos');
            $table->string('nombre_contratante');
            $table->string('calle_contratante');
            $table->integer('numero_contratante');
            $table->string('colonia_contratante');
            $table->integer('cp_contratante');
            $table->string('nombre_contraparte');
            $table->string('calle_contraparte');
            $table->integer('numero_contraparte');
            $table->string('colonia_contraparte');
            $table->integer('cp_contraparte');
            $table->dateTime('fecha_cnstruccion');
            $table->string('nombre_construccions');
            $table->string('calle_construccion');
            $table->integer('numero_cnstruccion');
            $table->string('colonia_construccion');
            $table->integer('cp_construccion');
            $table->integer('pago_construccion'); //se lo trae del contrato
            $table->integer('importe_construccion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturas');
    }
}
