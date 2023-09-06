<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            // Create an admin user
            User::factory()->create([
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('12345'),
                'role' => 'Admin',
                'status' => '1',
            ]);
    
            // Create a client user
            User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345'),
                'role' => 'Client',
                'added_user_id' => '1',
                'status' => '1',
                'sub_exp_date' => Carbon::now()->addDays(30),
            ]);
    
            // Create a driver user
            User::factory()->create([
                'name' => 'User ',
                'email' => 'user@gmail.com',
                'password' => Hash::make('12345'),
                'role' => 'Driver',
                'added_user_id' => '1',
                'client_id' => '2',
                'status' => '1'
            ]);
        }
    
}
