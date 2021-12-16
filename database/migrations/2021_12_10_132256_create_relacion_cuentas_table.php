<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelacionCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relacion_cuentas', function (Blueprint $table) {
            $table->id();
            $table->decimal("monto",12,2)->nullable();
            $table->decimal("programado",12,2)->nullable();
            $table->decimal("total",12,2)->nullable();
            $table->string('proveedor')->nullable();
            $table->unsignedBigInteger('cuenta_id')->nullable();
            $table->foreign('cuenta_id')->references('id')->on('credito_cuentas');
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
        Schema::dropIfExists('relacion_cuentas');
    }
}
