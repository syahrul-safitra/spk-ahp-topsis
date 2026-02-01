<?php

namespace App\Http\Controllers;

use App\Services\TopsisService;

use App\Models\Alternative;
use App\Models\Criteria;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class AlternativeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.Alternative.index', [
            'alternatives' => Alternative::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Alternative.create', [
            'criterias' => Criteria::all()
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
        return view('Admin.Alternative.edit', [
            'alternative' => $alternative,
            'criterias' => Criteria::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alternative $alternative)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:alternatives,nama,' . $alternative->id,
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

        // $rankings = Alternative::with('values')
        //     ->get()
        //     ->sortByDesc('skor')
        //     ->values();


        // // return $rankings;
        // return view('Admin.Alternative.ranking', [
        //     'result' => $result,
        //     'rankings' => $rankings            
        // ]);

        return view('Admin.Alternative.ranking', $data);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alternative $alternative)
    {
        $alternative->delete();

        return back()->with('success', "Berhasil menghapus data");
    }
}
