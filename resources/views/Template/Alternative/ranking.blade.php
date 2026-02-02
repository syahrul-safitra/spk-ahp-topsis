@extends("Template.Layouts.main")

@section("title", "Perhitungan TOPSIS")

@section("content")
    <div class="mx-auto max-w-6xl animate-[fadeIn_0.5s_ease-out] space-y-10 pb-20">

        <div class="flex flex-col justify-between gap-6 md:flex-row md:items-center">
            <div>
                <h2 class="text-3xl font-black tracking-tight text-slate-800">Analisis TOPSIS</h2>
                <p class="text-sm font-medium text-slate-500">Proses perhitungan matematis untuk menentukan peringkat
                    terbaik.</p>
            </div>
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-black text-slate-800">Hasil Analisis</h2>

                @if (isset($results) && $results->count() > 0)
                    <button onclick="submitPdf()" class="...">...</button>
                @else
                    <div
                        class="flex items-center gap-2 rounded-xl border border-amber-100 bg-amber-50 px-4 py-2 text-amber-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-[10px] font-black uppercase tracking-widest">Data belum tersedia untuk
                            diekspor</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <div class="space-y-4 lg:col-span-1">
                <h3 class="flex items-center gap-2 px-2 text-lg font-black text-slate-700">
                    <span class="h-5 w-1.5 rounded-full bg-emerald-500"></span>
                    Hasil Perankingan
                </h3>
                <div
                    class="card overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white shadow-xl shadow-slate-200/50">
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead>
                                <tr
                                    class="border-b border-slate-100 bg-slate-50/80 text-[10px] uppercase tracking-widest text-slate-400">
                                    <th class="p-4 text-center">Rank</th>
                                    <th class="p-4">Alternatif</th>
                                    <th class="p-4 text-right">Skor</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @foreach ($rankings as $i => $alt)
                                    <tr class="{{ $i == 0 ? "bg-emerald-50/50" : "" }} group transition-colors">
                                        <td class="p-4 text-center">
                                            @if ($i == 0)
                                                <div class="flex justify-center">
                                                    <span
                                                        class="flex h-6 w-6 items-center justify-center rounded-lg bg-emerald-500 text-[10px] font-black text-white shadow-lg shadow-emerald-200">1</span>
                                                </div>
                                            @else
                                                <span class="text-xs font-bold text-slate-400">{{ $i + 1 }}</span>
                                            @endif
                                        </td>
                                        <td class="p-4">
                                            <span
                                                class="{{ $i == 0 ? "text-emerald-700" : "text-slate-700" }} text-sm font-black uppercase tracking-tight">{{ $alt->nama }}</span>
                                        </td>
                                        <td class="p-4 text-right">
                                            <span
                                                class="{{ $i == 0 ? "text-emerald-600" : "text-slate-500" }} font-mono text-sm font-bold">{{ number_format($alt->skor, 4) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="space-y-4 lg:col-span-2">
                <h3 class="flex items-center gap-2 px-2 text-lg font-black text-slate-700">
                    <span class="h-5 w-1.5 rounded-full bg-indigo-500"></span>
                    Visualisasi Preferensi
                </h3>
                <div class="card rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-xl shadow-slate-200/50">
                    <div class="relative h-[350px]">
                        <canvas id="topsisChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <h3 class="flex items-center gap-2 px-2 text-lg font-black text-slate-700">
                <span class="h-5 w-1.5 rounded-full bg-slate-300"></span>
                Detail Tahapan Matematika
            </h3>

            <div class="collapse-arrow collapse rounded-[2rem] border border-slate-100 bg-white shadow-sm">
                <input type="checkbox" />
                <div class="collapse-title px-8 py-4 text-sm font-black uppercase tracking-wider text-slate-600">
                    01. Matriks Keputusan (X)
                </div>
                <div class="collapse-content overflow-x-auto px-8 pb-8">
                    <table class="table-compact table w-full border-t border-slate-50 text-center">
                        <thead class="text-[10px] uppercase text-slate-400">
                            <tr>
                                <th class="bg-transparent">Alternatif</th>
                                @foreach ($criterias as $c)
                                    <th>{{ $c->nama }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="text-xs font-medium uppercase tracking-tighter text-slate-600">
                            @foreach ($matrix as $i => $row)
                                <tr class="hover:bg-slate-50">
                                    <td class="font-black text-slate-800">{{ $alternatives[$i]->nama }}</td>
                                    @foreach ($row as $val)
                                        <td>{{ number_format($val, 2) }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="collapse-arrow collapse rounded-[2rem] border border-slate-100 bg-white shadow-sm">
                <input type="checkbox" />
                <div class="collapse-title px-8 py-4 text-sm font-black uppercase tracking-wider text-slate-600">
                    02. Matriks Normalisasi (R)
                </div>
                <div class="collapse-content overflow-x-auto px-8 pb-8">
                    <table class="table-compact table w-full border-t border-slate-50 text-center">
                        <thead class="text-[10px] uppercase text-slate-400">
                            <tr>
                                <th class="bg-transparent">Alternatif</th>
                                @foreach ($criterias as $c)
                                    <th>{{ $c->nama }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="font-mono text-xs text-slate-500">
                            @foreach ($normalized as $i => $row)
                                <tr>
                                    <td class="font-sans font-black uppercase text-slate-800">{{ $alternatives[$i]->nama }}
                                    </td>
                                    @foreach ($row as $val)
                                        <td>{{ number_format($val, 3) }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card rounded-[2.5rem] bg-slate-900 p-8 text-white shadow-2xl">
                <h4 class="mb-6 flex items-center gap-2 text-xs font-black uppercase tracking-[0.2em] text-emerald-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Titik Solusi Ideal (A+ / A-)
                </h4>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-slate-800 text-[10px] uppercase text-slate-500">
                                <th class="pb-4">Kategori Solusi</th>
                                @foreach ($criterias as $c)
                                    <th class="pb-4">{{ $c->nama }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="font-mono text-xs">
                            <tr class="border-b border-slate-800/50">
                                <td class="py-4 font-sans font-bold text-emerald-400">Ideal Positif (A+)</td>
                                @foreach ($idealPositive as $val)
                                    <td class="py-4">{{ number_format($val, 4) }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td class="py-4 font-sans font-bold text-rose-400">Ideal Negatif (A-)</td>
                                @foreach ($idealNegative as $val)
                                    <td class="py-4">{{ number_format($val, 4) }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <form id="pdfForm" method="POST" action="{{ url("topsis-pdf") }}" class="hidden">
        @csrf
        <input type="hidden" name="chart_image" id="chart_image">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const rawData = {!! json_encode($rankings) !!};
        const labels = rawData.map(item => item.nama);
        const scores = rawData.map(item => item.skor);

        const ctx = document.getElementById('topsisChart').getContext('2d');

        // Create Gradient
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(16, 185, 129, 0.4)'); // Emerald
        gradient.addColorStop(1, 'rgba(16, 185, 129, 0.0)');

        new Chart(ctx, {
            type: 'line', // Berubah ke Line Chart agar lebih modern
            data: {
                labels: labels,
                datasets: [{
                    label: 'Skor Preferensi',
                    data: scores,
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: '#10b981',
                    borderWidth: 4,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#10b981',
                    pointBorderWidth: 3,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    tension: 0.4 // Membuat garis melengkung (smooth)
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 1.1,
                        grid: {
                            color: '#f1f5f9',
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                weight: 'bold'
                            }
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
                        backgroundColor: '#1e293b',
                        padding: 12,
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        callbacks: {
                            label: (context) => ` Skor Akhir: ${context.raw.toFixed(4)}`
                        }
                    }
                }
            }
        });

        function submitPdf() {
            const canvas = document.getElementById('topsisChart');
            document.getElementById('chart_image').value = canvas.toDataURL('image/png');
            document.getElementById('pdfForm').submit();
        }
    </script>
@endsection
