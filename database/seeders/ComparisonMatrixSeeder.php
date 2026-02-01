<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ComparisonMatrixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comparison_matrices')->insert([
            // C1
            ['criteria_1_id' => 1, 'criteria_2_id' => 1, 'nilai' => 1],
            ['criteria_1_id' => 1, 'criteria_2_id' => 2, 'nilai' => 5],
            ['criteria_1_id' => 1, 'criteria_2_id' => 3, 'nilai' => 3],

            // C2
            ['criteria_1_id' => 2, 'criteria_2_id' => 1, 'nilai' => 0.2],
            ['criteria_1_id' => 2, 'criteria_2_id' => 2, 'nilai' => 1],
            ['criteria_1_id' => 2, 'criteria_2_id' => 3, 'nilai' => 0.333],

            // C3
            ['criteria_1_id' => 3, 'criteria_2_id' => 1, 'nilai' => 0.333],
            ['criteria_1_id' => 3, 'criteria_2_id' => 2, 'nilai' => 3],
            ['criteria_1_id' => 3, 'criteria_2_id' => 3, 'nilai' => 1],
        ]);
    }
}
