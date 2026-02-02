@extends('Admin.Layouts.main')

@section('title', 'Perhitungan TOPSIS')

@section('container')
    <div class="row">
        <div class="col-12">

            <h4 class="mb-3">TOPSIS Perankingan</h4>

            <h5>Matriks Keputusan</h5>
            <table class="table table-bordered text-center">
                <tr>
                    <th>Alternatif</th>
                    @foreach ($criterias as $c)
                        <th>{{ $c->nama }}</th>
                    @endforeach
                </tr>
                @foreach ($matrix as $i => $row)
                    <tr>
                        <td>{{ $alternatives[$i]->nama }}</td>
                        @foreach ($row as $val)
                            <td>{{ number_format($val, 2) }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </table>

            <h5>Matriks Normalisasi</h5>
            <table class="table table-bordered text-center">
                <tr>
                    <th>Alternatif</th>
                    @foreach ($criterias as $c)
                        <th>{{ $c->nama }}</th>
                    @endforeach
                </tr>
                @foreach ($normalized as $i => $row)
                    <tr>
                        <td>{{ $alternatives[$i]->nama }}</td>
                        @foreach ($row as $val)
                            <td>{{ number_format($val, 3) }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </table>

            <h5>Matriks Terbobot</h5>
            <table class="table table-bordered text-center">
                <tr>
                    <th>Alternatif</th>
                    @foreach ($criterias as $c)
                        <th>{{ $c->nama }}</th>
                    @endforeach
                </tr>
                @foreach ($weighted as $i => $row)
                    <tr>
                        <td>{{ $alternatives[$i]->nama }}</td>
                        @foreach ($row as $val)
                            <td>{{ number_format($val, 4) }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </table>

            <h5>Solusi Ideal</h5>
            <table class="table table-bordered text-center">
                <tr>
                    <th>Kriteria</th>
                    @foreach ($criterias as $c)
                        <th>{{ $c->nama }}</th>
                    @endforeach
                </tr>
                <tr>
                    <th>Ideal Positif</th>
                    @foreach ($idealPositive as $val)
                        <td>{{ number_format($val, 4) }}</td>
                    @endforeach
                </tr>
                <tr>
                    <th>Ideal Negatif</th>
                    @foreach ($idealNegative as $val)
                        <td>{{ number_format($val, 4) }}</td>
                    @endforeach
                </tr>
            </table>

            <h5>Skor & Ranking</h5>
            <table class="table table-bordered text-center">
                <tr>
                    <th>Rank</th>
                    <th>Alternatif</th>
                    <th>Skor</th>
                </tr>
                @foreach ($rankings as $i => $alt)
                    <tr @if ($i == 0) class="table-success" @endif>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $alt->nama }}</td>
                        <td>{{ number_format($alt->skor, 4) }}</td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>

    <button class="btn btn-danger mt-3" onclick="submitPdf()">
        <i class="bi bi-file-earmark-pdf"></i> Export PDF
    </button>


    <div class="container mt-5">
        <div class="card shadow border-0">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0 fw-bold text-primary">
                    <i class="bi bi-bar-chart-fill me-2"></i>Visualisasi Ranking Rumah
                </h5>
            </div>
            <div class="card-body">
                <div style="position: relative; height:350px;">
                    <canvas id="topsisChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <form id="pdfForm" method="POST" action="{{ url('topsis-pdf') }}">
        @csrf
        <input type="hidden" name="chart_image" id="chart_image">
    </form>


    <script src="{{ asset('Admin/js/chart.js') }}"></script>

    <script>
        // Mengambil data dari Laravel ke JavaScript
        const rawData = {!! json_encode($rankings) !!};

        // Mapping data untuk Chart
        const labels = rawData.map(item => item.nama);
        const scores = rawData.map(item => item.skor);

        const ctx = document.getElementById('topsisChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Skor Preferensi TOPSIS',
                    data: scores,
                    backgroundColor: [
                        'rgba(13, 110, 253, 0.5)', // Blue
                        'rgba(25, 135, 84, 0.5)', // Green
                        'rgba(255, 193, 7, 0.5)' // Yellow
                    ],
                    borderColor: [
                        'rgb(13, 110, 253)',
                        'rgb(25, 135, 84)',
                        'rgb(255, 193, 7)'
                    ],
                    borderWidth: 2,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 1, // Karena skor TOPSIS biasanya 0-1
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ' Skor: ' + context.raw.toFixed(4);
                            }
                        }
                    }
                }
            }
        });

        function submitPdf() {
            const canvas = document.getElementById('topsisChart');
            const image = canvas.toDataURL('image/png');
            document.getElementById('chart_image').value = image;
            document.getElementById('pdfForm').submit();
        }
    </script>
@endsection
