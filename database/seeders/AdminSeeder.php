<?php

namespace Database\Seeders;

use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name = 'Admin';
        $email = 'admin@gamil.com';
        $password = 'password';

        $user = User ::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        RoleUser::create([
            'user_id' => $user->id,
            'role_id' => 1,
        ]);
    }
}
