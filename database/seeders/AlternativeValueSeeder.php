<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class AlternativeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alternative_values')->insert([
            // Andi
            ['alternative_id' => 1, 'criteria_id' => 1, 'nilai' => 80],
            ['alternative_id' => 1, 'criteria_id' => 2, 'nilai' => 75],
            ['alternative_id' => 1, 'criteria_id' => 3, 'nilai' => 90],

            // Budi
            ['alternative_id' => 2, 'criteria_id' => 1, 'nilai' => 85],
            ['alternative_id' => 2, 'criteria_id' => 2, 'nilai' => 95],
            ['alternative_id' => 2, 'criteria_id' => 3, 'nilai' => 85],

            // Citra
            ['alternative_id' => 3, 'criteria_id' => 1, 'nilai' => 78],
            ['alternative_id' => 3, 'criteria_id' => 2, 'nilai' => 80],
            ['alternative_id' => 3, 'criteria_id' => 3, 'nilai' => 88],
        ]);
    }
}
