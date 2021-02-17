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

        $role_admin = Role::where('name','admin')->first();

        //give permission to admin to create,update,delete clients
        $role_admin->givePermissionTo(['list-client','create-client','update-client','delete-client','detail-client']);
        //give permission to admin to see plans
        $role_admin->givePermissionTo(['list-plan','detail-plan']);
        //give permission to admin to see agendas
        $role_admin->givePermissionTo(['list-agenda','detail-agenda']);
        //give permission to admin to create,update,delete role
        $role_admin->givePermissionTo(['list-role','create-role','update-role','delete-role']);
        //give permission to admin to create,update,delete permission
        $role_admin->givePermissionTo(['list-permission','create-permission','update-permission','delete-permission']);
    }
}
