<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFkFormaFacturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facturas',function($table){
            $table->unsignedBigInteger('id_forma');
            $table->foreign('id_forma')->references('id')->on('forma_pagos')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facturas',function(Blueprint $table){
            $table->dropForeign(['id_forma']);
            });
    }
}
