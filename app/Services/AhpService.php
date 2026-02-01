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
            $i = $index[$row->criteria_1_id];
            $j = $index[$row->criteria_2_id];
            $matrix[$i][$j] = $row->nilai;
        }

        // Validasi matrix lengkap
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                if ($matrix[$i][$j] == 0) {
                    throw new \Exception('Matrix AHP belum lengkap');
                }
            }
        }

        // 1️⃣ Jumlah kolom
        $colSum = array_fill(0, $n, 0);
        for ($j = 0; $j < $n; $j++) {
            for ($i = 0; $i < $n; $i++) {
                $colSum[$j] += $matrix[$i][$j];
            }
        }

        // 2️⃣ Normalisasi
        $normalized = [];
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                $normalized[$i][$j] = $matrix[$i][$j] / $colSum[$j];
            }
        }

        // 3️⃣ Bobot
        $weights = [];
        for ($i = 0; $i < $n; $i++) {
            $weights[$i] = array_sum($normalized[$i]) / $n;
        }

        // 4️⃣ Lambda max
        $lambda = [];
        for ($i = 0; $i < $n; $i++) {
            $sum = 0;
            for ($j = 0; $j < $n; $j++) {
                $sum += $matrix[$i][$j] * $weights[$j];
            }
            $lambda[$i] = $sum / $weights[$i];
        }

        $lambdaMax = array_sum($lambda) / $n;

        // 5️⃣ CI & CR
        $ci = ($lambdaMax - $n) / ($n - 1);
        $riTable = [
            1 => 0.00, 2 => 0.00, 3 => 0.58, 4 => 0.90,
            5 => 1.12, 6 => 1.24, 7 => 1.32, 8 => 1.41,
            9 => 1.45, 10 => 1.49
        ];
        $ri = $riTable[$n] ?? 1.49;
        $cr = $ri == 0 ? 0 : $ci / $ri;

        // 6️⃣ Simpan bobot JIKA konsisten
        if ($cr <= 0.1) {
            foreach ($kriteria as $i => $k) {
                $k->update(['bobot' => $weights[$i]]);
            }
        }

        $consistent = $cr <= 0.1; // true jika CR <= 0.1, false jika > 0.1

        return compact(
            'matrix',
            'normalized',
            'weights',
            'lambdaMax',
            'ci',
            'cr',
            'consistent'
        );
    }

}
