<?php

namespace App\Services;

use App\Models\Criteria;
use App\Models\ComparisonMatrix;

class AhpService
{
    public function calculate()
    {
        $kriteria = Criteria::orderBy('id')->get();
        $n = $kriteria->count();

        if ($n < 2) {
            throw new \Exception('Jumlah kriteria minimal 2');
        }

        // Mapping index
        $index = [];
        foreach ($kriteria as $i => $k) {
            $index[$k->id] = $i;
        }

        // Inisialisasi matrix NxN
        $matrix = array_fill(0, $n, array_fill(0, $n, 0));

        // Diagonal = 1
        for ($i = 0; $i < $n; $i++) {
            $matrix[$i][$i] = 1;
        }

        // Ambil perbandingan
        $comparisons = ComparisonMatrix::all();
        foreach ($comparisons as $row) {
            if (isset($index[$row->criteria_1_id]) && isset($index[$row->criteria_2_id])) {
                $i = $index[$row->criteria_1_id];
                $j = $index[$row->criteria_2_id];
                $matrix[$i][$j] = (double) $row->nilai;
            }
        }

        // Validasi matrix lengkap
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                if ($matrix[$i][$j] == 0) {
                    throw new \Exception('Matrix AHP belum lengkap. Pastikan semua kriteria sudah dibandingkan.');
                }
            }
        }

        // 1️⃣ Hitung Jumlah Kolom (ColSum)
        $colSum = array_fill(0, $n, 0);
        for ($j = 0; $j < $n; $j++) {
            for ($i = 0; $i < $n; $i++) {
                $colSum[$j] += $matrix[$i][$j];
            }
        }

        // 2️⃣ Normalisasi & 3️⃣ Hitung Bobot (Eigen Vector)
        $normalized = [];
        $weights = [];
        for ($i = 0; $i < $n; $i++) {
            $rowSumNormalized = 0;
            for ($j = 0; $j < $n; $j++) {
                $normalized[$i][$j] = $matrix[$i][$j] / $colSum[$j];
                $rowSumNormalized += $normalized[$i][$j];
            }
            // Bobot adalah rata-rata nilai baris yang telah dinormalisasi
            $weights[$i] = $rowSumNormalized / $n;
        }

        // 4️⃣ Lambda Max (Metode Perkalian Matriks: Total Kolom * Bobot)
        // Ini adalah cara yang paling akurat dan sesuai dengan Excel
        $lambdaMax = 0;
        for ($j = 0; $j < $n; $j++) {
            $lambdaMax += $colSum[$j] * $weights[$j];
        }

        // 5️⃣ CI & CR (Consistency Index & Ratio)
        $ci = ($lambdaMax - $n) / ($n - 1);
        
        $riTable = [
            1 => 0.00, 2 => 0.00, 3 => 0.58, 4 => 0.90,
            5 => 1.12, 6 => 1.24, 7 => 1.32, 8 => 1.41,
            9 => 1.45, 10 => 1.49
        ];
        
        $ri = $riTable[$n] ?? 1.49;
        $cr = $ri == 0 ? 0 : $ci / $ri;

        // 6️⃣ Simpan bobot JIKA konsisten
        $consistent = $cr <= 0.1;
        if ($consistent) {
            foreach ($kriteria as $i => $k) {
                $k->update(['bobot' => $weights[$i]]);
            }
        }

        return [
            'matrix'      => $matrix,
            'normalized'  => $normalized,
            'weights'     => $weights,
            'lambdaMax'   => $lambdaMax,
            'ci'          => $ci,
            'cr'          => $cr,
            'consistent'  => $consistent,
            'colSum'      => $colSum
        ];
    }
}