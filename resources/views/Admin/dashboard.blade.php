@extends('Admin.Layouts.main')

@section('container')
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-start border-primary border-4 p-3">
                    <small class="text-muted fw-bold">TOTAL ALTERNATIF</small>
                    <h3 class="fw-bold">12</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-start border-success border-4 p-3">
                    <small class="text-muted fw-bold">STATUS AHP</small>
                    <h3 class="text-success fw-bold">KONSISTEN</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="fw-bold">Proporsi Bobot Kriteria</h6>
                        <canvas id="ahpPieChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="fw-bold">Perbandingan Skor Alternatif</h6>
                        <canvas id="topsisBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
