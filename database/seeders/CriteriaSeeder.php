<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;


class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('criterias')->insert([
            [
                'id' => 1,
                'kode' => 'C1',
                'nama' => 'Disiplin',
                'atribut' => 'benefit',
            ],
            [
                'id' => 2,
                'kode' => 'C2',
                'nama' => 'Kinerja',
                'atribut' => 'benefit',
            ],
            [
                'id' => 3,
                'kode' => 'C3',
                'nama' => 'Kehadiran',
                'atribut' => 'benefit',
            ],
        ]);
    }
}
