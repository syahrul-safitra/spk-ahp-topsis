<?php

namespace App\Http\Controllers;

use App\Models\ComparisonMatrix;
use App\Models\Criteria;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ComparisonMatrixController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Template.Criteria.comparisonMatrix', [
            'criterias' => Criteria::orderBy('id')->get(),
            'comparisons' => ComparisonMatrix::all()
                ->groupBy('criteria_1_id')
                ->map(function ($rows) {
                    return $rows->pluck('nilai', 'criteria_2_id');
                }),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
{   
    // 1. Hapus data lama (di luar transaksi agar aman)
    ComparisonMatrix::query()->delete(); 

    // 2. Jalankan transaksi
    DB::transaction(function () use ($request) {
        if ($request->has('nilai')) {
            foreach ($request->nilai as $i => $row) {
                foreach ($row as $j => $value) {
                    
                    if ($i == $j || is_null($value)) continue;

                    // Parsing nilai
                    if (str_contains($value, '/')) {
                        $parts = explode('/', $value);
                        $nilai = (float)$parts[0] / (float)$parts[1];
                    } else {
                        $nilai = (float)$value;
                    }

                    // Logika i < j agar tidak terjadi double input
                    if ($i < $j) {
                        ComparisonMatrix::create([
                            'criteria_1_id' => $i,
                            'criteria_2_id' => $j,
                            'nilai' => $nilai,
                        ]);

                        ComparisonMatrix::create([
                            'criteria_1_id' => $j,
                            'criteria_2_id' => $i,
                            'nilai' => 1 / $nilai,
                        ]);
                    }
                }
            }
        }
    }); // Penutup transaksi

    return back()->with('success', 'Berhasil membandingkan kriteria dengan presisi tinggi.');
} // Penutup fungsi store

    /**
     * Display the specified resource.
     */
    public function show(ComparisonMatrix $comparisonMatrix)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ComparisonMatrix $comparisonMatrix)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ComparisonMatrix $comparisonMatrix)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ComparisonMatrix $comparisonMatrix)
    {
        //
    }
}
