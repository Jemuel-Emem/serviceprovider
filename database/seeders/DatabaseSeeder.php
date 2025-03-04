<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'admin@gmail.com',
             'password' => 'password',
             'role' =>1
         ]);

         \App\Models\User::factory()->create([
            'name' => 'Test ServiceProvider',
            'email' => 'service@gmail.com',
            'password' => 'password',
            'role' =>2
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test USer',
            'email' => 'test@gmail.com',
            'password' => 'password',
            'role' =>0
        ]);
    }
}
