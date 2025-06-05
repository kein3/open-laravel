<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Appelle le RoleSeeder
        $this->call([
            RoleSeeder::class,
            // tu pourras ajouter d'autres seeders ici si besoin
        ]);
    }
}
