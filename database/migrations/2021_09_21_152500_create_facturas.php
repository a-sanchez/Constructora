<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->string('folio_prefactura');
            $table->decimal('monto_total',12,2);
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->decimal('importe_estimacion',12,2);
            $table->decimal('anticipo',12,2);
            $table->decimal('sub_total',12,2);
            $table->decimal('iva',5,2);
            $table->decimal('subtotal_iva',12,4);
            $table->decimal('total_estimacion',12,2);
            $table->decimal('ivyc',5,2);
            $table->decimal('monto_ivyc',12,5);
            $table->decimal('icic',5,2);
            $table->decimal('monto_icic',12,5);
            $table->decimal('total_retenciones',12,2);
            $table->decimal('neto',12,2);
            $table->integer("status")->default(1);
            $table->string('concepto');

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
