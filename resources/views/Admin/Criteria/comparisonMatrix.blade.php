@extends('Admin.Layouts.main')

@section('title', 'Perbandingan Kriteria AHP')

@section('container')

    @session('errorMatrix')
        <script src="{{ asset('Admin/js/sweetalert2.all.min.js') }}"></script>

        <script>
            Swal.fire({
                title: "Terdapat Kesalahan",
                text: "Nilai Perbandingan Kriteria Belum Lengkap",
                icon: "error"
            });
        </script>
    @endsession

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <h5 class="mb-4">
                <i class="bi bi-sliders"></i> Perbandingan Kriteria (AHP)
            </h5>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ url('comparison-matrix') }}" method="POST">
                @csrf

                @php
                    // Label singkat, tooltip menjelaskan arti
                    $choices = [
                        '0.111111' => '1/9',
                        '0.142857' => '1/7',
                        '0.2' => '1/5',
                        '0.333333' => '1/3',
                        '1' => '1',
                        '3' => '3',
                        '5' => '5',
                        '7' => '7',
                        '9' => '9',
                    ];

                    $tooltips = [
                        '0.111111' => 'C2 sangat lebih penting dari C1',
                        '0.142857' => 'C2 lebih penting dari C1',
                        '0.2' => 'C2 agak lebih penting dari C1',
                        '0.333333' => 'C2 sedikit lebih penting dari C1',
                        '1' => 'Sama penting',
                        '3' => 'C1 sedikit lebih penting dari C2',
                        '5' => 'C1 agak lebih penting dari C2',
                        '7' => 'C1 lebih penting dari C2',
                        '9' => 'C1 sangat lebih penting dari C2',
                    ];
                @endphp

                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Kriteria</th>
                                @foreach ($criterias as $c)
                                    <th>{{ $c->kode }}</th>
                                @endforeach
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($criterias as $c1)
                                <tr>
                                    <th class="table-light">{{ $c1->kode }}</th>

                                    @foreach ($criterias as $c2)
                                        <td style="min-width:120px; vertical-align:middle; white-space:nowrap;">

                                            {{-- DIAGONAL --}}
                                            @if ($c1->id == $c2->id)
                                                <strong>1</strong>

                                                {{-- INPUT (i < j) --}}
                                            @elseif ($c1->id < $c2->id)
                                                @php
                                                    $currentValue = $comparisons[$c1->id][$c2->id] ?? null;
                                                @endphp

                                                <div class="d-flex flex-wrap justify-content-center">
                                                    @foreach ($choices as $value => $label)
                                                        <label class="form-check m-1" title="{{ $tooltips[$value] }}">
                                                            <input type="radio" class="form-check-input"
                                                                name="nilai[{{ $c1->id }}][{{ $c2->id }}]"
                                                                value="{{ $value }}"
                                                                {{ (string) old("nilai.$c1->id.$c2->id", $currentValue) === (string) $value ? 'checked' : '' }}>
                                                            <small>{{ $label }}</small>
                                                        </label>
                                                    @endforeach
                                                </div>

                                                {{-- KEBALIKAN (readonly) --}}
                                            @else
                                                @if (isset($comparisons[$c2->id][$c1->id]))
                                                    <span class="text-muted">
                                                        {{ round(1 / $comparisons[$c2->id][$c1->id], 3) }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            @endif

                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-end mt-3">
                    <button class="btn btn-danger">
                        <i class="bi bi-save"></i> Simpan Perbandingan
                    </button>
                </div>

            </form>
        </div>
    </div>

    <style>
        .form-check {
            margin-bottom: 0.25rem;
            text-align: center;
            white-space: nowrap;
        }

        .form-check-input {
            margin-right: 0.25rem;
        }
    </style>
@endsection
