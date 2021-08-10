<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeBigIntMontoContrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< HEAD
        Schema::table('contratos',function($table){
            $table->dropColumn('monto');
        });
       Schema::table('contratos', function (Blueprint $table) {
           $table->double("monto",10,2);
=======
       Schema::table('contratos', function (Blueprint $table) {
           $table->decimal("monto",10,2)->change();
>>>>>>> a63a0e2f773cc75f2e8db49a6f4850912881b32e
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
