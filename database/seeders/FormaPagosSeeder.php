<?php

namespace Database\Seeders;

use App\Models\create_forma_pago;
use Illuminate\Database\Seeder;

class FormaPagosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        create_forma_pago::create(['forma'=>'Efectivo']);
        create_forma_pago::create(['forma'=>'Transferencia']);
        create_forma_pago::create(['forma'=>'Cheque']);
    }
}
