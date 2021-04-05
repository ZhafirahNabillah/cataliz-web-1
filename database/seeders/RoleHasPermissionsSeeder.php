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
        $role_coach = Role::where('name', 'coach')->first();

        //give permission to coach to create,update,delete clients
        $role_coach->givePermissionTo(['list-user', 'detail-user']);
        //give permission to coach to create,update,delete plans
        $role_coach->givePermissionTo(['list-plan', 'create-plan', 'update-plan', 'delete-plan', 'detail-plan']);
        //give permission to coach to create,update,delete agendas
        $role_coach->givePermissionTo(['list-agenda', 'create-agenda', 'update-agenda', 'delete-agenda', 'detail-agenda']);

        $role_admin = Role::where('name', 'admin')->first();

        //give permission to admin to create,update,delete clients
        $role_admin->givePermissionTo(['list-user', 'create-user', 'update-user', 'delete-user', 'detail-user']);
        //give permission to admin to see plans
        $role_admin->givePermissionTo(['list-plan', 'detail-plan']);
        //give permission to admin to see agendas
        $role_admin->givePermissionTo(['list-agenda', 'detail-agenda']);
        //give permission to admin to create,update,delete role
        $role_admin->givePermissionTo(['list-role', 'create-role', 'update-role', 'delete-role']);
        //give permission to admin to create,update,delete permission
        $role_admin->givePermissionTo(['list-permission', 'create-permission', 'update-permission', 'delete-permission']);
        //give permission to admin to see,create,update class
        $role_admin->givePermissionTo(['list-class', 'create-class', 'detail-class']);

        $role_coachee = Role::where('name', 'coachee')->first();

        //give permission to coachee see coaches
        $role_coachee->givePermissionTo(['list-user', 'detail-user']);
        //give permission to coachee see plans
        $role_coachee->givePermissionTo(['list-plan', 'detail-plan']);
        //give permission to coachee see agendas
        $role_coachee->givePermissionTo(['list-agenda', 'detail-agenda']);

        $role_mentor = Role::where('name', 'mentor')->first();
        $role_trainer = Role::where('name', 'trainer')->first();
    }
}
