<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //crud clients
        Permission::create(['name' => 'list-client']);
        Permission::create(['name' => 'create-client']);
        Permission::create(['name' => 'update-client']);
        Permission::create(['name' => 'detail-client']);
        Permission::create(['name' => 'delete-client']);

        //crud plans
        Permission::create(['name' => 'list-plan']);
        Permission::create(['name' => 'create-plan']);
        Permission::create(['name' => 'update-plan']);
        Permission::create(['name' => 'detail-plan']);
        Permission::create(['name' => 'delete-plan']);

        //crud agendas
        Permission::create(['name' => 'list-agenda']);
        Permission::create(['name' => 'create-agenda']);
        Permission::create(['name' => 'update-agenda']);
        Permission::create(['name' => 'detail-agenda']);
        Permission::create(['name' => 'delete-agenda']);

        //crud role
        Permission::create(['name' => 'list-role']);
        Permission::create(['name' => 'create-role']);
        Permission::create(['name' => 'update-role']);
        Permission::create(['name' => 'delete-role']);

        //crud permission
        Permission::create(['name' => 'list-permission']);
        Permission::create(['name' => 'create-permission']);
        Permission::create(['name' => 'update-permission']);
        Permission::create(['name' => 'delete-permission']);
    }
}
