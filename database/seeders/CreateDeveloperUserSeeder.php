<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateDeveloperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'developer',
            'email' => 'developer@mail.com',
            'password' => bcrypt('123456'),
        ]);

        $user->assignRole('developer');
    }
}
