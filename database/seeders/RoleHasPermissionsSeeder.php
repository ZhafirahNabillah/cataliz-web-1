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
        $role_coach = Role::where('name','coach')->first();

        //give permission to coach to create,update,delete clients
        $role_coach->givePermissionTo(['list-client','create-client','update-client','delete-client','detail-client']);
        //give permission to coach to create,update,delete plans
        $role_coach->givePermissionTo(['list-plan','create-plan','update-plan','delete-plan','detail-plan']);
        //give permission to coach to create,update,delete agendas
        $role_coach->givePermissionTo(['list-agenda','create-agenda','update-agenda','delete-agenda','detail-agenda']);
    }
}
