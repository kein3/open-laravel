<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Crée les rôles si nécessaire
        $admin   = Role::firstOrCreate(['name' => 'admin']);
        $manager = Role::firstOrCreate(['name' => 'manager']);
        $employe = Role::firstOrCreate(['name' => 'employe']);

        // Crée quelques permissions
        $viewArticles   = Permission::firstOrCreate(['name' => 'view articles']);
        $editArticles   = Permission::firstOrCreate(['name' => 'edit articles']);
        $manageUsers    = Permission::firstOrCreate(['name' => 'manage users']);
        $manageDocs     = Permission::firstOrCreate(['name' => 'manage documents']);

        // Attribue les permissions aux rôles
        $admin->syncPermissions([$viewArticles, $editArticles, $manageUsers, $manageDocs]);
        $manager->syncPermissions([$viewArticles, $editArticles, $manageDocs]);
        $employe->syncPermissions([$viewArticles]);
    }
}
