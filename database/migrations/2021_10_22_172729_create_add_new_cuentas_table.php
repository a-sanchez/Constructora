<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddNewCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_new_cuentas', function (Blueprint $table) {
            $table->id();
            $table->string("beneficiario");
            $table->string("pago");
            $table->date("fecha");
            $table->date("posfechadas");
            $table->string("deposito");
            $table->decimal("importe",12,2);
            $table->decimal("saldo",12,2);
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
        Schema::dropIfExists('add_new_cuentas');
    }
}
