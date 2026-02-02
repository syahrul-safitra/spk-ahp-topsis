@extends("Admin.Layouts.main")

@section("title", "Data Kriteria AHP")

@section("container")
    <div class="row">
        <div class="col-12">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">
                    <i class="bi bi-diagram-3-fill text-primary me-2"></i>Perbandingan Kriteria (AHP)
                </h4>
            </div>

            <!-- ALERT CR & Consistency -->
            {{-- @if (isset($ahpResult))
                @if ($ahpResult["consistent"])
                    <div class="alert alert-success">
                        Matriks konsisten ✅ - CR = {{ number_format($ahpResult['cr'], 4) }}
                    </div>
                @else
                    <div class="alert alert-danger">
                        Matriks TIDAK konsisten ❌ - CR = {{ number_format($ahpResult['cr'], 4) }}. Silakan perbaiki
                        perbandingan.
                    </div>
                @endif
            @endif --}}

            <!-- MATRIX PERBANDINGAN -->
            @if (isset($matrix))
                <h5>Matriks Perbandingan</h5>
                <div class="table-responsive mb-3">
                    <table class="table-bordered table text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Kriteria</th>
                                @foreach ($matrix as $i => $row)
                                    <th>C{{ $i + 1 }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matrix as $i => $row)
                                <tr>
                                    <th>C{{ $i + 1 }}</th>
                                    @foreach ($row as $value)
                                        <td>{{ number_format($value, 3) }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <!-- MATRIX NORMALISASI -->
            @if (isset($normalized))
                <h5>Matriks Normalisasi</h5>
                <div class="table-responsive mb-3">
                    <table class="table-bordered table text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Kriteria</th>
                                @foreach ($normalized as $i => $row)
                                    <th>C{{ $i + 1 }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($normalized as $i => $row)
                                <tr>
                                    <th>C{{ $i + 1 }}</th>
                                    @foreach ($row as $value)
                                        <td>{{ number_format($value, 3) }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <!-- BOBOT KRITERIA -->
            @if (isset($weights))
                <h5>Bobot Kriteria</h5>
                <div class="table-responsive mb-3">
                    <table class="table-bordered table text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Kriteria</th>
                                <th>Bobot</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($weights as $i => $bobot)
                                <tr>
                                    <td>C{{ $i + 1 }}</td>
                                    <td>{{ number_format($bobot, 4) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <!-- UJI KONSISTENSI -->
            @if (isset($ahpResult))
                <h5>Uji Konsistensi</h5>
                <ul>
                    <li>λ max : {{ number_format($ahpResult["lambdaMax"], 4) }}</li>
                    <li>CI : {{ number_format($ahpResult["ci"], 4) }}</li>
                    <li>CR : {{ number_format($ahpResult["cr"], 4) }}</li>
                </ul>

                @if ($ahpResult["consistent"])
                    <p class="text-success fw-bold">
                        ✅ Konsisten (CR ≤ 0.1)
                    </p>
                @else
                    <p class="text-danger fw-bold">
                        ❌ Tidak Konsisten (CR > 0.1)
                    </p>
                @endif
            @endif

        </div>
    </div>
@endsection
