<?php

namespace App\Http\Controllers;

use App\Models\ComparisonMatrix;
use App\Models\Criteria;
use Illuminate\Http\Request;

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

        foreach ($request->nilai as $i => $row) {
            foreach ($row as $j => $value) {

                $nilai = str_contains($value, '/')
                    ? eval("return $value;") // "1/5" → 0.2
                    : (float) $value;

                ComparisonMatrix::updateOrCreate(
                    [
                        'criteria_1_id' => $i,
                        'criteria_2_id' => $j,
                    ],
                    [
                        'nilai' => $nilai,
                    ]
                );

                // otomatis simpan kebalikannya
                ComparisonMatrix::updateOrCreate(
                    [
                        'criteria_1_id' => $j,
                        'criteria_2_id' => $i,
                    ],
                    [
                        'nilai' => 1 / $nilai,
                    ]
                );
            }
        }

        return back()->with('success', 'Berhasil membandingkan kriteria');

    }

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
