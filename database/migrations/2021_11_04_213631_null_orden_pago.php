<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NullOrdenPago extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pagos_proveedores2s', function (Blueprint $table) {
            $table->unsignedBigInteger("id_status")->nullable()->change();
            $table->unsignedBigInteger("id_contrato")->nullable()->change();
            $table->unsignedBigInteger("id_forma")->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
