<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use app\Models\User;
use app\Models\Todo;
use app\Models\TodoTask;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function ($user) {
            $user->todos()->saveMany(Todo::factory(10)->make())->each(function ($todo) {
                $todo->tasks()->saveMany(TodoTask::factory(10)->make());
            });
        });
    }
}
