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
        //
        $coach = User::create([
          'name'        => 'User Coach',
          'phone'       => '081234567890',
          'email'       => 'coach@cataliz.id',
          'password'    => bcrypt('coach123')
        ]);

        $coach->assignRole('coach');

        $coachee = User::create([
          'name'        => 'User Coachee',
          'phone'       => '081234567890',
          'email'       => 'coachee@cataliz.id',
          'password'    => bcrypt('coachee123')
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

        $admin = User::create([
          'name'        => 'User Admin',
          'phone'       => '081234567890',
          'email'       => 'admin@cataliz.id',
          'password'    => bcrypt('admin123')
        ]);

        $admin->assignRole('admin');
    }
}
