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
        Permission::create(['name' => 'create-clients']);
        Permission::create(['name' => 'update-clients']);
        Permission::create(['name' => 'delete-clients']);

        //crud plans
        Permission::create(['name' => 'create-plans']);
        Permission::create(['name' => 'update-plans']);
        Permission::create(['name' => 'delete-plans']);

        //crud Agendas
        Permission::create(['name' => 'create-agendas']);
        Permission::create(['name' => 'update-agendas']);
        Permission::create(['name' => 'delete-agendas']);

        //crud Sessions
        Permission::create(['name' => 'create-sessions']);
        Permission::create(['name' => 'update-sessions']);
        Permission::create(['name' => 'delete-sessions']);

        //create, update feedback
        Permission::create(['name' => 'create-feedbacks']);
        Permission::create(['name' => 'update-feedbacks']);

        //create, update coaching notes
        Permission::create(['name' => 'create-coaching-notes']);
        Permission::create(['name' => 'update-coaching-notes']);
    }
}
