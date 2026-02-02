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

        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'is_admin' => 1,
            'password' => bcrypt('password'),
        ]);

        // $this->call([
        //     CriteriaSeeder::class,
        //     ComparisonMatrixSeeder::class,
        //     AlternativeSeeder::class,
        //     AlternativeValueSeeder::class,
        // ]);
    }
}
