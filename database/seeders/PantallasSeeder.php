<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\pantallas;

class PantallasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        pantallas::create(['nombre'=>'CLIENTES','url'=>"/clientes"]);
        pantallas::create(['nombre'=>'CONTRATOS','url'=>"/contratos"]);
        pantallas::create(['nombre'=>'ORDEN COMPRA','url'=>"/compras"]);
        pantallas::create(['nombre'=>'PREFACTURAS','url'=>"/facturas"]);
        pantallas::create(['nombre'=>'PAGOS','url'=>"/pagos_proveedores"]);
        pantallas::create(['nombre'=>'PROVEEDORES','url'=>"/proveedores"]);
        pantallas::create(['nombre'=>'CONFIGURACION','url'=>"/configuracion"]);
        

    }
}
