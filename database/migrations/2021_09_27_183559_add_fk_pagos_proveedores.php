<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkPagosProveedores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pagos_proveedores',function($table){
            $table->unsignedBigInteger('id_status');
            $table->foreign('id_status')->references('id')->on('estatus_facturas');
        });

        Schema::table('pagos_proveedores', function ( $table) {
            $table->unsignedBigInteger('id_contrato');
            $table->foreign('id_contrato')-> references('id')->on('contratos');

        });
        Schema::table('pagos_proveedores', function ( $table) {
            $table->unsignedBigInteger('id_orden');
            $table->foreign('id_orden')-> references('id')->on('orden_compras');

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
