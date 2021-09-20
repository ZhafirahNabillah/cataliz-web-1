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
        Permission::create(['name' => 'list-user']);
        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'update-user']);
        Permission::create(['name' => 'detail-user']);
        Permission::create(['name' => 'delete-user']);

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

        // crud class
        Permission::create(['name' => 'list-class']);
        Permission::create(['name' => 'create-class']);
        Permission::create(['name' => 'detail-class']);

        // crud exercise
        Permission::create(['name' => 'list-exercise']);
        Permission::create(['name' => 'create-exercise']);
        Permission::create(['name' => 'update-exercise']);
        Permission::create(['name' => 'detail-exercise']);
        Permission::create(['name' => 'delete-exercise']);

        // crud topic
        Permission::create(['name' => 'list-topic']);
        Permission::create(['name' => 'create-topic']);
        Permission::create(['name' => 'update-topic']);
        Permission::create(['name' => 'detail-topic']);
        Permission::create(['name' => 'delete-topic']);

        // crud result
        Permission::create(['name' => 'list-result']);
        Permission::create(['name' => 'create-result']);
        Permission::create(['name' => 'detail-result']);

        // crud category
        Permission::create(['name' => 'list-category']);
        Permission::create(['name' => 'create-category']);
        Permission::create(['name' => 'update-category']);
        Permission::create(['name' => 'delete-category']);

        // Activity Log
        Permission::create(['name' => 'activity-log']);

        // crud documentation
        Permission::create(['name' => 'list-docs']);
        Permission::create(['name' => 'update-docs']);
        Permission::create(['name' => 'detail-docs']);
        Permission::create(['name' => 'delete-docs']);
    }
}
