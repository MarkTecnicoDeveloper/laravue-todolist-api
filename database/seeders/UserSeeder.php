<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'Example',
            'email' => 'test@test.com',
            'password' => bcrypt('Password1')
        ]);

        User::factory(5)->create();
    }
}
