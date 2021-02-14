<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleHasPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role = Role::where('name','coach')->first();

        //give permission to coach to create,update,delete clients
        $role->givePermissionTo(['create-clients','update-clients','delete-clients']);
        //give permission to coach to create,update,delete plans
        $role->givePermissionTo(['create-plans','update-plans','delete-plans']);
        //give permission to coach to create,update,delete agendas
        $role->givePermissionTo(['create-agendas','update-agendas','delete-agendas']);
        //give permission to coach to create,update,delete sessions
        $role->givePermissionTo(['create-sessions','update-sessions','delete-sessions']);
        //give permission to coach to create,update feedbacks
        $role->givePermissionTo(['create-feedbacks','update-feedbacks']);
        //give permission to coach to create,update coaching notes
        $role->givePermissionTo(['create-coaching-notes','update-coaching-notes']);
    }
}
