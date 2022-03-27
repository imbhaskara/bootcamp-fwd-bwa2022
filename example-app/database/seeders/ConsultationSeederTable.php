<?php

namespace Database\Seeders;

use App\Models\MasterData\Consultation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsultationSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create static data here
       $consultation = [
           [
               'name' => 'Jantung Sesak',
               'created_at' => date('Y-m-d H:i:s'),
               'updated_at' => date('Y-m-d H:i:s'),
           ],
           [
               'name' => 'Tekanan Darah Tinggi',
               'created_at' => date('Y-m-d H:i:s'),
               'updated_at' => date('Y-m-d H:i:s'),
           ],
           [
               'name' => 'Gangguan Irama Jantung',
               'created_at' => date('Y-m-d H:i:s'),
               'updated_at' => date('Y-m-d H:i:s'),
           ],
       ];

        //Insert array data $consultation into table consultation
        Consultation::insert($consultation);
    }
}
