<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_productos', function (Blueprint $table) {
            $table->id();
            $table->string("concepto");
            $table->string("unidad");
            $table->float("cantidad");
            $table->float("precio_unitario");
            $table->float("importe");
            $table->unsignedBigInteger("orden_id");
            $table->foreign("orden_id")->references("id")->on("orden_compras");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden_productos');
    }
}
