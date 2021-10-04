<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //
    Role::create([
      'name'        => 'admin',
      'guard_name'  => 'web'
    ]);

    Role::create([
      'name'        => 'coach',
      'guard_name'  => 'web'
    ]);

    Role::create([
      'name'        => 'coachee',
      'guard_name'  => 'web'
    ]);

    Role::create([
      'name'        => 'mentor',
      'guard_name'  => 'web'
    ]);

    Role::create([
      'name'        => 'trainer',
      'guard_name'  => 'web'
    ]);

    Role::create([
      'name'        => 'manager',
      'guard_name'  => 'web'
    ]);

    Role::create([
      'name'        => 'coachmentor',
      'guard_name'  => 'web'
    ]);
  }
}
