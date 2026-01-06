<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Models\Admin;
use Database\Factories\UserFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
        ]);
        // Admin::factory()->create([
        //     'firstname' => 'name',
        //     'lastname' => 'name',
        //     'email' => 'niraj.coder@gmail.com',
        //     'password' => Hash::make('123456789'),
        //     'avatar' => 'avatars/0E6VOq3taeQIa2zhy7ZYDggTGBPeNZXgbgwwHzvu.jpg',
        // ]);
    }
}
