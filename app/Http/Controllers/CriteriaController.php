<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\User;
use App\Services\TopsisService;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard(TopsisService $topsis)
    {

        // $data = $topsis->calculate();

        // $data['countUser'] = User::count();

        // return view('Template.dashboard', $data);

        $topsis = new TopsisService();
        $data = $topsis->calculate();

        return view('Template.dashboard', [
            'criterias'    => $data['criterias'] ?? [],
            'alternatives' => $data['alternatives'] ?? [],
            'rankings'     => $data['rankings'] ?? [],
            'countUser'    => User::count(),
        ]);
    }

    public function index()
    {

        if (! auth()->user()->is_admin) {
            return redirect('/');
        }

        return view('Template.Criteria.index', [
            'criterias' => Criteria::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! auth()->user()->is_admin) {
            return redirect('/');
        }

        return view('Template.Criteria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:criterias,nama',
            'atribut' => 'required|in:benefit,cost',
        ]);

        // ambil kode terakhir (C1, C2, ...)
        $lastCriteria = Criteria::orderBy('id', 'desc')->first();

        if ($lastCriteria) {
            $lastNumber = (int) str_replace('C', '', $lastCriteria->kode);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $kode = 'C'.$nextNumber;

        Criteria::create([
            'kode' => $kode,
            'nama' => $request->nama,
            'atribut' => $request->atribut,
        ]);

        return redirect('criteria')->with('success', 'Kriteria berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Criteria $criteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Criteria $criterion)
    {
        if (! auth()->user()->is_admin) {
            return redirect('/');
        }

        return view('Template.Criteria.edit', [
            'criteria' => $criterion,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Criteria $criterion)
    {
        $request->validate([
            'nama' => 'required|unique:criterias,nama,'.$criterion->id,
            'atribut' => 'required|in:benefit,cost',
        ]);

        $criterion->update([
            'nama' => $request->nama,
            'atribut' => $request->atribut,
            // ⚠️ kode tidak diubah
        ]);

        return redirect('criteria')
            ->with('success', 'Kriteria berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Criteria $criterion)
    {

        if (! auth()->user()->is_admin) {
            return redirect('/');
        }

        $criterion->delete();

        return back()->with('success', 'Berhasil menghapus data kriteria');
    }
}
