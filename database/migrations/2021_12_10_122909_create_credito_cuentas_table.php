<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditoCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credito_cuentas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date("fecha_inicio");
            $table->date("fecha_final"); 
            $table->decimal("monto",12,2)->nullable();
            $table->decimal("programado",12,2)->nullable();
            $table->decimal("total",12,2)->nullable();
            $table->unsignedBigInteger('id_proveedor')->nullable();
            $table->foreign('id_proveedor')->references('id')->on('proveedores');
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
        Schema::dropIfExists('credito_cuentas');
    }
}
