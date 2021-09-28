<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsPagosProveedores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pagos_proveedores', function (Blueprint $table) {
            $table->string("folio_factura")->nullable();
            $table->date("fecha_emision")->nullable();
            $table->date("fecha_vencimiento")->nullable();
            $table->decimal("sub_total",12,2)->nullable();
            $table->decimal("impuestos",12,2)->nullable();
            $table->decimal("total",12,2)->nullable();
            
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
