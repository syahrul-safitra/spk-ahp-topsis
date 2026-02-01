<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class AlternativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('alternatives')->insert([
            ['id' => 1, 'kode' => 'A1', 'nama' => 'Andi'],
            ['id' => 2, 'kode' => 'A2', 'nama' => 'Budi'],
            ['id' => 3, 'kode' => 'A3', 'nama' => 'Citra'],
        ]);
    }
}
