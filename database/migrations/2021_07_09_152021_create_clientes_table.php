<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('cliente')->unique();
            $table->string('razon_social');
            $table->string('alias');
            $table->string('telefono');
            $table->string('telefono2');
            $table->string('email');
            $table->string('rfc');
            $table->string('contacto_pago');
            $table->string('localidad');
            $table->string('calle');
            $table->integer('numero');
            $table->string('colonia');
            $table->integer('cp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
