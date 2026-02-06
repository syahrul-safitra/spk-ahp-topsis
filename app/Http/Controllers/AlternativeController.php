<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Criteria;
use App\Services\TopsisService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlternativeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('Template.Alternative.index', [
            'alternatives' => Alternative::all(),
            'criterias' => Criteria::count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Template.Alternative.create', [
            'criterias' => Criteria::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:alternatives,nama',
            'keterangan' => 'nullable|string',
            'nilai' => 'required|array',
            'nilai.*' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            // Buat alternatif baru
            $alternative = Alternative::create([
                'nama' => $request->nama,
                'keterangan' => $request->keterangan,
            ]);

            // Simpan nilai per kriteria
            foreach ($request->nilai as $criteriaId => $value) {
                $alternative->values()->create([
                    'criteria_id' => $criteriaId,
                    'nilai' => $value,
                ]);
            }
        });

        return redirect('alternative')
            ->with('success', 'Alternatif berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alternative $alternative)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alternative $alternative)
    {
        return view('Template.Alternative.edit', [
            'alternative' => $alternative,
            'criterias' => Criteria::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alternative $alternative)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:alternatives,nama,'.$alternative->id,
            'keterangan' => 'nullable|string',
            'nilai' => 'required|array',
            'nilai.*' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request, $alternative) {

            // Update data alternatif
            $alternative->update([
                'nama' => $request->nama,
                'keterangan' => $request->keterangan,
            ]);

            // Update atau buat nilai per kriteria
            foreach ($request->nilai as $criteriaId => $value) {
                $alternative->values()->updateOrCreate(
                    ['criteria_id' => $criteriaId],
                    ['nilai' => $value]
                );
            }

        });

        return redirect('alternative')
            ->with('success', 'Alternatif berhasil diperbarui.');
    }

    public function ranking(TopsisService $topsis)
    {
        $data = $topsis->calculate();
        $alternatives = Alternative::count();
        $data['alternativesCount'] = $alternatives;

        // return $data;

        return view('Template.Alternative.ranking', $data);
    }

    public function pdf(TopsisService $topsis, Request $request)
    {

        $data = $topsis->calculate();

        $data['chartImage'] = $request->chart_image;

        return Pdf::loadView('Template.Alternative.pdf', $data)
            ->setPaper('A4', 'landscape')
            ->stream('laporan_topsis.pdf');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alternative $alternative)
    {
        $alternative->delete();

        return back()->with('success', 'Berhasil menghapus data');
    }
}
