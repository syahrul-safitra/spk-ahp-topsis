@extends("Template.Layouts.main")

@section("title", "Dashboard SPK TOPSIS")

@section("content")
    <div class="mx-auto max-w-7xl animate-[fadeIn_0.5s_ease-out] space-y-8 pb-10">

        <div>
            <h2 class="text-3xl font-black tracking-tight text-slate-800">Ringkasan Sistem</h2>
            {{-- <p class="text-sm font-medium italic text-slate-500">Data pembaruan terakhir: <span
                    class="font-bold text-emerald-600">{{ date("d M Y") }}</span></p> --}}
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <div
                class="flex items-center gap-5 rounded-[2.5rem] border border-slate-100 bg-white p-6 shadow-sm transition-transform hover:scale-105">
                <div
                    class="flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Total Kriteria</p>
                    <h3 class="text-3xl font-black text-slate-800">{{ count($criterias) }}</h3>
                </div>
            </div>

            <div
                class="flex items-center gap-5 rounded-[2.5rem] border border-slate-100 bg-white p-6 shadow-sm transition-transform hover:scale-105">
                <div
                    class="flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Alternatif</p>
                    <h3 class="text-3xl font-black text-slate-800">{{ count($alternatives) }}</h3>
                </div>
            </div>

            <div
                class="flex items-center gap-5 rounded-[2.5rem] border border-slate-100 bg-white p-6 shadow-sm transition-transform hover:scale-105">
                <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-amber-50 text-amber-600 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Pengguna</p>
                    <h3 class="text-3xl font-black text-slate-800">{{ $countUser ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-5">

            <div class="space-y-8 lg:col-span-3">

                <div class="rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-xl shadow-slate-200/50">
                    <div class="mb-8 flex items-center justify-between">
                        <h3 class="flex items-center gap-2 text-sm font-black uppercase tracking-widest text-slate-700">
                            <span class="h-4 w-1 rounded-full bg-indigo-500"></span>
                            Visualisasi Skor TOPSIS
                        </h3>
                    </div>
                    <div class="h-[350px]">
                        <canvas id="dashboardChart"></canvas>
                    </div>
                </div>

                <div class="rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-xl shadow-slate-200/50">
                    <div class="mb-8 flex items-center justify-between">
                        <h3 class="flex items-center gap-2 text-sm font-black uppercase tracking-widest text-slate-700">
                            <span class="h-4 w-1 rounded-full bg-emerald-500"></span>
                            Analisis Kriteria: Top 2 Alternatif
                        </h3>
                    </div>
                    <div class="h-[350px]"> <canvas id="radarChart"></canvas>
                    </div>
                </div>
            </div>

            <div
                class="relative self-start overflow-hidden rounded-[2.5rem] bg-slate-900 p-8 text-white shadow-2xl lg:col-span-2">
                <div class="absolute -right-24 -top-24 h-64 w-64 rounded-full bg-emerald-500/10 blur-3xl"></div>

                <h3 class="relative mb-8 text-sm font-black uppercase tracking-widest text-emerald-400">
                    Peringkat Teratas
                </h3>

                <div class="relative space-y-6">
                    @foreach (collect($rankings)->take(5) as $index => $rank)
                        <div
                            class="flex items-center justify-between rounded-2xl border border-white/10 bg-white/5 p-4 transition-colors hover:bg-white/10">
                            <div class="flex items-center gap-4">
                                <div
                                    class="{{ $index == 0 ? "bg-emerald-500 shadow-lg shadow-emerald-500/50" : "bg-slate-700" }} flex h-10 w-10 items-center justify-center rounded-xl text-sm font-black text-white">
                                    {{ $index + 1 }}
                                </div>
                                <div>
                                    <h4 class="text-sm font-black uppercase tracking-tight">{{ $rank["nama"] }}</h4>
                                    <p class="text-[10px] text-slate-400">Skor Preferensi</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span
                                    class="{{ $index == 0 ? "text-emerald-400" : "text-slate-300" }} font-mono text-lg font-black">
                                    {{ number_format($rank["skor"], 4) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="relative mt-8 border-t border-white/10 pt-8 text-center">
                    <a href="{{ url("/ranking") }}"
                        class="text-[10px] font-black uppercase italic tracking-widest text-slate-400 transition-colors hover:text-emerald-400">
                        Lihat Detail Perhitungan →
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const dataRankings = {!! json_encode($rankings) !!};

        // Urutkan berdasarkan skor untuk chart
        const labels = dataRankings.map(item => item.nama);
        const scores = dataRankings.map(item => item.skor);

        const ctx = document.getElementById('dashboardChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Skor Akhir',
                    data: scores,
                    backgroundColor: labels.map((_, i) => i === 0 ? '#10b981' : '#e2e8f0'),
                    borderRadius: 12,
                    barThickness: 40,
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
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#94a3b8',
                            font: {
                                weight: '600'
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#64748b',
                            font: {
                                weight: 'bold'
                            }
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
                        cornerRadius: 10,
                        callbacks: {
                            label: (ctx) => ` Skor: ${ctx.raw.toFixed(4)}`
                        }
                    }
                }
            }
        });

        const radarCtx = document.getElementById('radarChart').getContext('2d');

        // Ambil label kriteria dari data pertama (misal: Lokasi, Harga, Kualitas)
        const criteriaLabels = dataRankings[0].values.map(v => {
            // Cari nama kriteria asli berdasarkan criteria_id jika tersedia di variabel kriteria
            const crit = {!! json_encode($criterias) !!}.find(c => c.id === v.criteria_id);
            return crit ? crit.nama : 'Kriteria ' + v.criteria_id;
        });

        // Ambil data untuk 2 teratas
        const top1 = dataRankings[0];
        const top2 = dataRankings[1];

        new Chart(radarCtx, {
            type: 'radar',
            data: {
                labels: criteriaLabels,
                datasets: [{
                        label: top1.nama,
                        data: top1.values.map(v => v.nilai),
                        fill: true,
                        backgroundColor: 'rgba(16, 185, 129, 0.2)', // Emerald
                        borderColor: '#10b981',
                        pointBackgroundColor: '#10b981',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#10b981'
                    },
                    {
                        label: top2.nama,
                        data: top2.values.map(v => v.nilai),
                        fill: true,
                        backgroundColor: 'rgba(99, 102, 241, 0.2)', // Indigo
                        borderColor: '#6366f1',
                        pointBackgroundColor: '#6366f1',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#6366f1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        angleLines: {
                            color: '#f1f5f9'
                        },
                        grid: {
                            color: '#f1f5f9'
                        },
                        pointLabels: {
                            color: '#64748b',
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        },
                        ticks: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                weight: 'bold'
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
