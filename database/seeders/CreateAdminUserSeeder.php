<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     User::create([
            'name' => 'Alaa Elbehery',
            'email' => 'alaaelbehairy12@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123456'),
            'role_name' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
