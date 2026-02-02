@extends("Template.Layouts.main")

@section("title", "Hasil Analisis AHP")

@section("content")
    <div class="mx-auto max-w-6xl space-y-10">

        <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div>
                <h2 class="text-3xl font-black tracking-tight text-slate-800">Detail Perhitungan AHP</h2>
                <p class="font-medium text-slate-500">Transparansi data dari proses perbandingan hingga uji konsistensi.</p>
            </div>
            <div class="flex gap-2">
                <button onclick="window.print()" class="btn btn-ghost rounded-2xl bg-white normal-case shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Cetak Laporan
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

            @if (isset($weights))
                <div class="card overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white shadow-sm lg:col-span-2">
                    <div class="border-b border-slate-50 p-8">
                        <h3 class="text-xl font-black tracking-tight text-slate-800">Vektor Prioritas (Bobot)</h3>
                    </div>
                    <div class="overflow-x-auto p-0">
                        <table class="table w-full">
                            <thead>
                                <tr class="bg-slate-50/50 text-[10px] font-black uppercase tracking-widest text-slate-400">
                                    <th class="w-24 p-6 text-center">Kode</th>
                                    <th>Visualisasi Bobot</th>
                                    <th class="p-6 text-right">Nilai Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($weights as $i => $bobot)
                                    <tr class="border-b border-slate-50 transition-colors hover:bg-slate-50/50">
                                        <td class="text-center font-bold text-slate-700">C{{ $i + 1 }}</td>
                                        <td>
                                            <div class="flex items-center gap-4">
                                                <progress class="progress progress-primary h-2 w-full"
                                                    value="{{ $bobot * 100 }}" max="100"></progress>
                                                <span
                                                    class="text-[10px] font-black text-slate-400">{{ number_format($bobot * 100, 1) }}%</span>
                                            </div>
                                        </td>
                                        <td class="p-6 text-right">
                                            <div class="badge badge-ghost rounded-lg font-mono font-bold text-slate-600">
                                                {{ number_format($bobot, 4) }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @if (isset($ahpResult))
                <div
                    class="card {{ $ahpResult["consistent"] ? "bg-emerald-500" : "bg-rose-500" }} relative overflow-hidden rounded-[2.5rem] p-8 text-white shadow-xl shadow-indigo-100/20">
                    <div class="relative z-10 space-y-6">
                        <div class="flex items-start justify-between">
                            <span
                                class="text-[10px] font-black uppercase tracking-[0.2em] text-white opacity-80">Consistency
                                Check</span>
                            @if ($ahpResult["consistent"])
                                <div class="rounded-xl bg-white/20 p-2 backdrop-blur-md">✅</div>
                            @else
                                <div class="rounded-xl bg-white/20 p-2 backdrop-blur-md">❌</div>
                            @endif
                        </div>

                        <div>
                            <h3 class="text-5xl font-black">{{ number_format($ahpResult["cr"], 4) }}</h3>
                            <p class="mt-1 text-sm font-bold uppercase tracking-tight opacity-90">Consistency Ratio (CR)</p>
                        </div>

                        <div class="space-y-3 border-t border-white/10 pt-4 text-sm">
                            <div class="flex justify-between opacity-80">
                                <span>λ Max</span>
                                <span class="font-mono">{{ number_format($ahpResult["lambdaMax"], 4) }}</span>
                            </div>
                            <div class="flex justify-between opacity-80">
                                <span>Consistency Index (CI)</span>
                                <span class="font-mono">{{ number_format($ahpResult["ci"], 4) }}</span>
                            </div>
                        </div>

                        <div class="pt-4">
                            <div class="rounded-2xl bg-white/10 p-4 text-xs font-medium leading-relaxed">
                                @if ($ahpResult["consistent"])
                                    Rasio konsistensi memenuhi syarat <strong>(CR ≤ 0.1)</strong>. Data ini valid untuk
                                    digunakan.
                                @else
                                    Rasio konsistensi melampaui batas <strong>(CR > 0.1)</strong>. Mohon tinjau kembali
                                    perbandingan kriteria Anda.
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="absolute -bottom-10 -right-10 h-40 w-40 rounded-full bg-white/10 blur-3xl"></div>
                </div>
            @endif
        </div>

        <div class="space-y-4">
            <h4 class="ml-2 text-sm font-black uppercase tracking-widest text-slate-400">Detail Perhitungan Matriks</h4>

            @if (isset($matrix))
                <div class="collapse-arrow collapse rounded-[2rem] border border-slate-100 bg-white shadow-sm">
                    <input type="checkbox" />
                    <div class="collapse-title flex items-center gap-3 p-6 text-base font-bold text-slate-700">
                        <div
                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-xs text-indigo-500">
                            01</div>
                        Matriks Perbandingan Berpasangan
                    </div>
                    <div class="collapse-content overflow-x-auto px-6 pb-6">
                        <table class="table-zebra table w-full text-center">
                            <thead>
                                <tr class="border-b border-slate-50 text-[10px] font-black uppercase text-slate-400">
                                    <th>Kriteria</th>
                                    @foreach ($matrix as $i => $row)
                                        <th>C{{ $i + 1 }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="font-mono text-xs">
                                @foreach ($matrix as $i => $row)
                                    <tr>
                                        <th class="bg-slate-50/50 font-bold text-slate-600">C{{ $i + 1 }}</th>
                                        @foreach ($row as $value)
                                            <td>{{ number_format($value, 3) }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @if (isset($normalized))
                <div class="collapse-arrow collapse rounded-[2rem] border border-slate-100 bg-white shadow-sm">
                    <input type="checkbox" />
                    <div class="collapse-title flex items-center gap-3 p-6 text-base font-bold text-slate-700">
                        <div
                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-xs text-indigo-500">
                            02</div>
                        Matriks Normalisasi Kriteria
                    </div>
                    <div class="collapse-content overflow-x-auto px-6 pb-6">
                        <table class="table-zebra table w-full text-center">
                            <thead>
                                <tr class="border-b border-slate-50 text-[10px] font-black uppercase text-slate-400">
                                    <th>Kriteria</th>
                                    @foreach ($normalized as $i => $row)
                                        <th>C{{ $i + 1 }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="font-mono text-xs">
                                @foreach ($normalized as $i => $row)
                                    <tr>
                                        <th class="bg-slate-50/50 text-xs font-bold text-slate-600">C{{ $i + 1 }}
                                        </th>
                                        @foreach ($row as $value)
                                            <td>{{ number_format($value, 3) }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
