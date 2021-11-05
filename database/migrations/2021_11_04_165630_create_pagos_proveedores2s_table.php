<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosProveedores2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_proveedores2s', function (Blueprint $table) {
            $table->id();
            $table->string('folio_factura');
            $table->date('fecha_emision');
            $table->date('fecha_vencimiento');
            $table->decimal('sub_total',12,2);
            $table->decimal('impuestos',12,2);
            $table->decimal('total',12,2);
            $table->string('comentarios')->nullable();
            $table->date('fecha_pago',12,2)->nullable();
            $table->string('referencia')->nullable();
            $table->decimal('importe',12,2)->nullable();
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
        Schema::dropIfExists('pagos_proveedores2s');
    }
}
