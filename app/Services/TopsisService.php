<?php

namespace App\Services;

use App\Models\Alternative;
use App\Models\Criteria;

class TopsisService
{
    // public function calculate()
    // {
    //     $criterias = Criteria::orderBy('id')->get();
    //     $alternatives = Alternative::with('values')->get();

    //     $nCriteria = $criterias->count();
    //     $nAlternatives = $alternatives->count();

    //     if ($nCriteria == 0 || $nAlternatives == 0) {
    //         return null;
    //     }

    //     // 1️⃣ Matriks awal (alternatif x kriteria)
    //     $matrix = [];
    //     foreach ($alternatives as $alt) {
    //         $row = [];
    //         foreach ($criterias as $c) {
    //             $row[] = $alt->values->where('criteria_id', $c->id)->first()->nilai ?? 0;
    //         }
    //         $matrix[] = $row;
    //     }

    //     // 2️⃣ Normalisasi matriks (safe)
    //     $normalized = [];
    //     foreach ($matrix as $i => $row) {
    //         foreach ($row as $j => $value) {
    //             $sumSquares = 0;
    //             foreach ($matrix as $r) {
    //                 $sumSquares += pow($r[$j], 2);
    //             }
    //             $normalized[$i][$j] = $sumSquares > 0 ? $value / sqrt($sumSquares) : 0;
    //         }
    //     }

    //     // 3️⃣ Bobot kriteria dari AHP
    //     $weights = $criterias->pluck('bobot')->toArray();

    //     // 4️⃣ Matriks terbobot
    //     $weighted = [];
    //     foreach ($normalized as $i => $row) {
    //         foreach ($row as $j => $value) {
    //             $weighted[$i][$j] = $value * $weights[$j];
    //         }
    //     }

    //     // 5️⃣ Solusi ideal positif & negatif
    //     $idealPos = [];
    //     $idealNeg = [];
    //     foreach ($criterias as $j => $c) {
    //         $col = array_column($weighted, $j);
    //         if ($c->atribut == 'benefit') {
    //             $idealPos[$j] = max($col);
    //             $idealNeg[$j] = min($col);
    //         } else {
    //             $idealPos[$j] = min($col);
    //             $idealNeg[$j] = max($col);
    //         }
    //     }

    //     // 6️⃣ Hitung jarak ke solusi ideal (safe)
    //     $distancePos = [];
    //     $distanceNeg = [];
    //     foreach ($weighted as $i => $row) {
    //         $sumPos = $sumNeg = 0;
    //         foreach ($row as $j => $value) {
    //             $sumPos += pow($value - $idealPos[$j], 2);
    //             $sumNeg += pow($value - $idealNeg[$j], 2);
    //         }
    //         $distancePos[$i] = sqrt($sumPos);
    //         $distanceNeg[$i] = sqrt($sumNeg);
    //     }

    //     // 7️⃣ Hitung skor TOPSIS (safe)
    //     $scores = [];
    //     foreach ($alternatives as $i => $alt) {
    //         $denom = $distancePos[$i] + $distanceNeg[$i];
    //         $scores[$alt->id] = $denom > 0 ? $distanceNeg[$i] / $denom : 0;
    //     }

    //     // 8️⃣ Ranking
    //     arsort($scores);

    //     return [
    //         'alternatives' => $alternatives,
    //         'criterias' => $criterias,
    //         'matrix' => $matrix,
    //         'normalized' => $normalized,
    //         'weighted' => $weighted,
    //         'idealPos' => $idealPos,
    //         'idealNeg' => $idealNeg,
    //         'distancePos' => $distancePos,
    //         'distanceNeg' => $distanceNeg,
    //         'scores' => $scores,
    //     ];
    // }
    // ini yang baru dari chat gpt : 
    

    // public function calculate()
    // {
    //     $criterias = Criteria::orderBy('id')->get();
    //     // $alternatives = Alternative::with('values')->get();

    //     $alternatives = Alternative::with('values')->get(); // tetap Collection


    //     $nAlt = $alternatives->count();
    //     $nCrit = $criterias->count();

    //     // 1️⃣ Ambil matriks keputusan
    //     $matrix = [];
    //     foreach ($alternatives as $alt) {
    //         $row = [];
    //         foreach ($criterias as $c) {
    //             $val = $alt->values->where('criteria_id', $c->id)->first();
    //             $row[] = $val ? $val->nilai : 0;
    //         }
    //         $matrix[] = $row;
    //     }

    //     // 2️⃣ Normalisasi matriks
    //     $normalized = [];
    //     for ($j = 0; $j < $nCrit; $j++) {
    //         $sumSq = 0;
    //         for ($i = 0; $i < $nAlt; $i++) {
    //             $sumSq += $matrix[$i][$j] ** 2;
    //         }
    //         $sqrtSum = sqrt($sumSq);
    //         for ($i = 0; $i < $nAlt; $i++) {
    //             $normalized[$i][$j] = $sqrtSum ? $matrix[$i][$j] / $sqrtSum : 0;
    //         }
    //     }

    //     // 3️⃣ Matriks terbobot (gunakan bobot AHP)
    //     $weights = $criterias->pluck('bobot')->toArray();
    //     $weighted = [];
    //     for ($i = 0; $i < $nAlt; $i++) {
    //         for ($j = 0; $j < $nCrit; $j++) {
    //             $weighted[$i][$j] = $normalized[$i][$j] * $weights[$j];
    //         }
    //     }

    //     // 4️⃣ Solusi ideal positif & negatif
    //     $idealPositive = [];
    //     $idealNegative = [];
    //     for ($j = 0; $j < $nCrit; $j++) {
    //         $col = array_column($weighted, $j);
    //         if ($criterias[$j]->atribut === 'benefit') {
    //             $idealPositive[$j] = max($col);
    //             $idealNegative[$j] = min($col);
    //         } else { // cost
    //             $idealPositive[$j] = min($col);
    //             $idealNegative[$j] = max($col);
    //         }
    //     }

    //     // 5️⃣ Hitung jarak ke solusi ideal
    //     $distPos = [];
    //     $distNeg = [];
    //     $scores = [];
    //     for ($i = 0; $i < $nAlt; $i++) {
    //         $sumPos = 0;
    //         $sumNeg = 0;
    //         for ($j = 0; $j < $nCrit; $j++) {
    //             $sumPos += ($weighted[$i][$j] - $idealPositive[$j]) ** 2;
    //             $sumNeg += ($weighted[$i][$j] - $idealNegative[$j]) ** 2;
    //         }
    //         $distPos[$i] = sqrt($sumPos);
    //         $distNeg[$i] = sqrt($sumNeg);

    //         $scores[$i] = ($distPos[$i] + $distNeg[$i]) != 0
    //             ? $distNeg[$i] / ($distPos[$i] + $distNeg[$i])
    //             : 0;
    //     }

    //     // 6️⃣ Ranking
    //     $rankings = $alternatives->toArray();
    //     // foreach ($rankings as $i => &$alt) {
    //     //     $alt['skor'] = $scores[$i];
    //     // }

    //     foreach ($alternatives as $i => $alt) {
    //         $alt->skor = $scores[$i]; // tambahkan properti dinamis
    //     }

    //     unset($alt);

    //     usort($rankings, fn($a, $b) => $b['skor'] <=> $a['skor']);

    //     return [
    //         'criterias' => $criterias,
    //         'weights' => $weights,
    //         'alternatives' => $alternatives,
    //         'matrix' => $matrix,
    //         'normalized' => $normalized,
    //         'weighted' => $weighted,
    //         'idealPositive' => $idealPositive,
    //         'idealNegative' => $idealNegative,
    //         'distPos' => $distPos,
    //         'distNeg' => $distNeg,
    //         'rankings' => $rankings,
    //     ];
    // }

    public function calculate()
    {
        $criterias = Criteria::orderBy('id')->get();
        $alternatives = Alternative::with('values')->get(); // tetap Collection

        $nAlt = $alternatives->count();
        $nCrit = $criterias->count();

        // 1️⃣ Matriks keputusan
        $matrix = [];
        foreach ($alternatives as $alt) {
            $row = [];
            foreach ($criterias as $c) {
                $val = $alt->values->where('criteria_id', $c->id)->first();
                $row[] = $val ? $val->nilai : 0;
            }
            $matrix[] = $row;
        }

        // 2️⃣ Matriks normalisasi
        $normalized = [];
        for ($j = 0; $j < $nCrit; $j++) {
            $sumSq = 0;
            for ($i = 0; $i < $nAlt; $i++) {
                $sumSq += $matrix[$i][$j] ** 2;
            }
            $sqrtSum = sqrt($sumSq);
            for ($i = 0; $i < $nAlt; $i++) {
                $normalized[$i][$j] = $sqrtSum ? $matrix[$i][$j] / $sqrtSum : 0;
            }
        }

        // 3️⃣ Matriks terbobot
        $weights = $criterias->pluck('bobot')->toArray();
        $weighted = [];
        for ($i = 0; $i < $nAlt; $i++) {
            for ($j = 0; $j < $nCrit; $j++) {
                $weighted[$i][$j] = $normalized[$i][$j] * $weights[$j];
            }
        }

        // 4️⃣ Solusi ideal positif & negatif
        $idealPositive = [];
        $idealNegative = [];
        for ($j = 0; $j < $nCrit; $j++) {
            $col = array_column($weighted, $j);
            if ($criterias[$j]->atribut === 'benefit') {
                $idealPositive[$j] = max($col);
                $idealNegative[$j] = min($col);
            } else { // cost
                $idealPositive[$j] = min($col);
                $idealNegative[$j] = max($col);
            }
        }

        // 5️⃣ Jarak ke solusi ideal
        $distPos = [];
        $distNeg = [];
        $scores = [];
        for ($i = 0; $i < $nAlt; $i++) {
            $sumPos = 0;
            $sumNeg = 0;
            for ($j = 0; $j < $nCrit; $j++) {
                $sumPos += ($weighted[$i][$j] - $idealPositive[$j]) ** 2;
                $sumNeg += ($weighted[$i][$j] - $idealNegative[$j]) ** 2;
            }
            $distPos[$i] = sqrt($sumPos);
            $distNeg[$i] = sqrt($sumNeg);

            $scores[$i] = ($distPos[$i] + $distNeg[$i]) != 0
                ? $distNeg[$i] / ($distPos[$i] + $distNeg[$i])
                : 0;
        }

        // 6️⃣ Simpan skor ke alternatif (dinamis)
        foreach ($alternatives as $i => $alt) {
            $alt->skor = $scores[$i];
        }

        // 7️⃣ Ranking
        $rankings = $alternatives->sortByDesc('skor')->values();

        return [
            'criterias' => $criterias,
            'weights' => $weights,
            'alternatives' => $alternatives,
            'matrix' => $matrix,
            'normalized' => $normalized,
            'weighted' => $weighted,
            'idealPositive' => $idealPositive,
            'idealNegative' => $idealNegative,
            'distPos' => $distPos,
            'distNeg' => $distNeg,
            'scores' => $scores,
            'rankings' => $rankings,
        ];
    }

}
