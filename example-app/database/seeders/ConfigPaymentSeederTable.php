<?php

namespace Database\Seeders;

use App\Models\MasterData\ConfigPayment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigPaymentSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //create static data here
       $config_payment = [
           [
               'fee' => '15000',
               'vat' => '20', // vat is a percentage value
               'created_at' => date('Y-m-d H:i:s'),
               'updated_at' => date('Y-m-d H:i:s'),
           ],
       ];

        //Insert array data $specialist into table specialist
        ConfigPayment::insert($config_payment);
    }
}
