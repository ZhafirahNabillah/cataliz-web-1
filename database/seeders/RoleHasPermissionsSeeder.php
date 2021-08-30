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
        //give permission to coach to list and detail topic
        $role_coach->givePermissionTo(['list-topic', 'detail-topic']);
        //give permission to coach to list and detail exam
        $role_coach->givePermissionTo(['list-exercise', 'detail-exercise']);
        //give permission to coach to list and detail result
        $role_coach->givePermissionTo(['list-result', 'detail-result']);
        //give permission to coach to activity log
        $role_coach->givePermissionTo(['activity-log']);

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
        //give permission to admin to activity log
        $role_admin->givePermissionTo(['activity-log']);

        $role_coachee = Role::where('name', 'coachee')->first();

        //give permission to coachee see coaches
        $role_coachee->givePermissionTo(['list-user', 'detail-user']);
        //give permission to coachee see plans
        $role_coachee->givePermissionTo(['list-plan', 'detail-plan']);
        //give permission to coachee see agendas
        $role_coachee->givePermissionTo(['list-agenda', 'detail-agenda']);
        //give permission to coachee to activity log
        $role_coachee->givePermissionTo(['activity-log']);
        
        $role_mentor = Role::where('name', 'mentor')->first();

        //give permission to mentor to list and detail exam
        $role_mentor->givePermissionTo(['list-topic', 'detail-topic']);
        //give permission to mentor to list and detail exam
        $role_mentor->givePermissionTo(['list-exercise', 'detail-exercise']);
        //give permission to mentor to list and detail result
        $role_mentor->givePermissionTo(['list-result', 'detail-result']);
        //give permission to mentor to activity log
        $role_mentor->givePermissionTo(['activity-log']);

        $role_trainer = Role::where('name', 'trainer')->first();

        //give permission to trainer to list, create, update, delete and detail exam
        $role_trainer->givePermissionTo(['list-topic', 'create-topic', 'update-topic', 'delete-topic', 'detail-topic']);
        //give permission to trainer to list and detail exam
        $role_trainer->givePermissionTo(['list-exercise', 'detail-exercise']);
        //give permission to trainer to list and detail result
        $role_trainer->givePermissionTo(['list-result', 'detail-result']);
        //give permission to trainer to list, create, update, delete category
        $role_trainer->givePermissionTo(['list-category', 'create-category', 'update-category', 'delete-category']);
        //give permission to trainer to activity log
        $role_trainer->givePermissionTo(['activity-log']);
       
        $role_manager = Role::where('name', 'manager')->first();

        //give permission to manager to create,update,delete clients
        $role_manager->givePermissionTo(['list-user', 'detail-user']);
        //give permission to manager to create,update,delete plans
        $role_manager->givePermissionTo(['list-plan', 'create-plan', 'update-plan', 'delete-plan', 'detail-plan']);
        //give permission to manager to create,update,delete agendas
        $role_manager->givePermissionTo(['list-agenda', 'create-agenda', 'update-agenda', 'delete-agenda', 'detail-agenda']);
         //give permission to manager to see,create,update class
         $role_manager->givePermissionTo(['list-class', 'create-class', 'detail-class']);
        //give permission to manager to list and detail topic
        $role_manager->givePermissionTo(['list-topic', 'detail-topic']);
         //give permission to manager to list and detail exam
         $role_manager->givePermissionTo(['list-exercise', 'detail-exercise']);
        //give permission to manager to list, create, update, delete category
        $role_manager->givePermissionTo(['list-category', 'create-category', 'update-category', 'delete-category']);
        //give permission to manager to list and detail result
        $role_manager->givePermissionTo(['list-result', 'detail-result']);
        //give permission to manager to activity log
        $role_manager->givePermissionTo(['activity-log']);

    
    }
}
