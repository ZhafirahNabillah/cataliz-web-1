<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create coach seeder
        $coach = User::create([
          'name'        => 'User Coach',
          'phone'       => '81234567890',
          'email'       => 'coach@cataliz.id',
          'password'    => bcrypt('coach123'),
          'is_verified' => 1
        ]);

        $coach->assignRole('coach');

        $coach_coach = Coach::create([
          'user_id'   => $coach->id,
          'skill'     => 'Bussiness'
        ]);

        //create coachee seeder
        $coachee = User::create([
          'name'        => 'User Coachee',
          'phone'       => '81234567890',
          'email'       => 'coachee@cataliz.id',
          'password'    => bcrypt('coachee123'),
          'is_verified' => 1
        ]);

        $coachee->assignRole('coachee');

        $coachee_client = Client::create([
          'user_id'       => $coachee->id,
          'name'          => $coachee->name,
          'phone'         => $coachee->phone,
          'email'         => $coachee->email,
          'program'       => 'starco',
          'company'       => 'Cataliz.id',
          'occupation'    => 'Developer',
          'organization'  => 'Universitas Jember'
        ]);

        //create admin seeder
        $admin = User::create([
          'name'        => 'User Admin',
          'phone'       => '81234567890',
          'email'       => 'admin@cataliz.id',
          'password'    => bcrypt('admin123'),
          'is_verified' => 1
        ]);

        $admin->assignRole('admin');
    }
}
