<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(9)->create();
        // \App\Models\User::factory()->create([
        //     'name' => "hamza",
        //     'email' => "hamza4@email.ma",
        //     'email_verified_at' => now(),
        //     'password' => 'hamza' ,
        //     'remember_token'=>"test tes"
        // ]);
        \App\Models\Task::factory(10)->create();
    }
}
