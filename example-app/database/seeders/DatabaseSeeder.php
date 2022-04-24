<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TypeUserSeederTable::class,
            ConsultationSeederTable::class,
            ConfigPaymentSeederTable::class,
            SpecialistSeederTable::class,
            UserSeederTable::class,
            DetailUserSeederTable::class,
            PermissionSeederTable::class,
            RoleSeederTable::class,
            PermissionRoleSeederTable::class,
            RoleUserSeederTable::class,
        ]);
    }
}
