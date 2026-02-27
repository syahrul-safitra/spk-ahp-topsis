@extends("Template.Layouts.main")

@section("title", "Perbandingan Kriteria AHP")

@section("content")
    <div class="mx-auto max-w-5xl space-y-8">

        @if (session("success"))
            <div id="success-alert"
                class="group relative mb-8 translate-y-0 transform overflow-hidden opacity-100 transition-all duration-500">
                <div
                    class="rounded-[2rem] bg-gradient-to-r from-emerald-500 to-teal-600 p-[1px] shadow-xl shadow-emerald-100">
                    <div class="flex items-center justify-between rounded-[1.95rem] bg-white p-5">
                        <div class="flex items-center gap-4">
                            <div class="relative flex shrink-0">
                                <span
                                    class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-100 opacity-75"></span>
                                <div
                                    class="relative flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>

                            <div>
                                <h4 class="mb-1 text-sm font-black uppercase leading-none tracking-tight text-slate-800">
                                    Berhasil Disimpan!</h4>
                                <p class="text-xs font-medium italic text-slate-500">{{ session("success") }}</p>
                            </div>
                        </div>

                        <button onclick="closeAlert()"
                            class="btn btn-ghost btn-circle btn-sm text-slate-300 hover:text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <script>
                // Fungsi untuk menutup alert secara halus
                function closeAlert() {
                    const alert = document.getElementById('success-alert');
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-20px)';
                    setTimeout(() => alert.remove(), 500);
                }

                // Auto close setelah 5 detik
                setTimeout(closeAlert, 5000);
            </script>
        @endif

        @session("errorMatrix")
            <div id="error-alert"
                class="relative mb-8 scale-100 transform animate-[shake_0.5s_ease-in-out] transition-all duration-500">
                <div class="rounded-[2rem] bg-gradient-to-r from-rose-500 to-orange-600 p-[1.5px] shadow-2xl shadow-rose-100">

                    <div class="flex flex-col items-center justify-between gap-4 rounded-[1.95rem] bg-white p-6 md:flex-row">

                        <div class="flex items-center gap-5">
                            <div class="relative flex shrink-0">
                                <span
                                    class="absolute inline-flex h-full w-full animate-ping rounded-2xl bg-rose-100 opacity-75"></span>
                                <div
                                    class="relative flex h-14 w-14 items-center justify-center rounded-2xl border border-rose-100 bg-rose-50 text-rose-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                            </div>

                            <div class="text-center md:text-left">
                                <h4 class="text-lg font-black leading-tight tracking-tight text-slate-800">Ups! Perhitungan
                                    Gagal</h4>
                                <p class="mt-1 text-sm font-medium uppercase tracking-wide text-slate-500">
                                    <span class="font-bold text-rose-600">Kesalahan:</span> Matriks Perbandingan Belum Lengkap.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <button onclick="closeErrorAlert()"
                                class="btn rounded-xl border-none bg-rose-500 px-6 font-bold normal-case text-white shadow-lg shadow-rose-200 hover:bg-rose-600">
                                Perbaiki Sekarang
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            <style>
                @keyframes shake {

                    0%,
                    100% {
                        transform: translateX(0);
                    }

                    25% {
                        transform: translateX(-5px);
                    }

                    75% {
                        transform: translateX(5px);
                    }
                }
            </style>

            <script>
                function closeErrorAlert() {
                    const alert = document.getElementById('error-alert');
                    alert.style.opacity = '0';
                    alert.style.transform = 'scale(0.95)';
                    setTimeout(() => alert.remove(), 400);
                }
            </script>
        @endsession

        <div class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div>
                <h2 class="text-center text-3xl font-black tracking-tight text-slate-800 md:text-left">Prioritas Kriteria
                </h2>
                <p class="mt-1 text-center font-medium text-slate-500 md:text-left">Bandingkan dua kriteria dan tentukan
                    mana
                    yang lebih penting.</p>
            </div>
            <div class="hidden items-center gap-2 rounded-2xl border border-indigo-100 bg-indigo-50 px-4 py-2 md:flex">
                <span class="text-xs font-bold uppercase tracking-widest text-indigo-600">Metode AHP</span>
            </div>
        </div>

        <form action="{{ url("comparison-matrix") }}" method="POST" class="space-y-6">
            @csrf

            <div
                class="rounded-[2.5rem] border border-indigo-100 bg-gradient-to-br from-indigo-50 via-white to-blue-50 p-8 shadow-xl shadow-indigo-100/50">
                <div class="flex flex-col items-start gap-6 md:flex-row md:items-center">
                    <div
                        class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-white text-indigo-600 shadow-lg shadow-indigo-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <div class="space-y-1">
                        <h4 class="text-lg font-black uppercase tracking-tight text-slate-800">Panduan Skala Kepentingan
                            (Saaty)</h4>
                        <p class="text-sm font-medium leading-relaxed text-slate-500">
                            Pilih tingkat kepentingan kriteria berdasarkan standar <span
                                class="font-bold text-indigo-600">Analytic Hierarchy Process (AHP)</span>:
                        </p>
                    </div>
                </div>

                <div class="mt-8 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-6">
                    @php
                        $scales = [
                            ["val" => "1", "title" => "Sama", "desc" => "Kedua kriteria berpengaruh sama"],
                            ["val" => "3", "title" => "Sedikit", "desc" => "Satu kriteria sedikit lebih kuat"],
                            ["val" => "5", "title" => "Lebih", "desc" => "Satu kriteria berpengaruh kuat"],
                            ["val" => "7", "title" => "Sangat", "desc" => "Satu kriteria sangat dominan"],
                            ["val" => "9", "title" => "Mutlak", "desc" => "Perbedaan sangat ekstrem"],
                            ["val" => "2,4,6,8", "title" => "Tengah", "desc" => "Nilai kompromi/antara"]
                        ];
                    @endphp

                    @foreach ($scales as $scale)
                        @php
                            $isEven = $scale["val"] === "2,4,6,8";
                        @endphp
                        <div
                            class="{{ $isEven ? "border-slate-200 bg-slate-100/50" : "border-white bg-white/60 hover:border-indigo-200 hover:bg-white hover:shadow-md" }} group relative overflow-hidden rounded-2xl border p-4 transition-all duration-300">

                            <span
                                class="absolute -right-2 -top-2 text-4xl font-black text-slate-900/[0.03] transition-colors group-hover:text-indigo-600/[0.05]">
                                {{ is_numeric($scale["val"]) ? $scale["val"] : "±" }}
                            </span>

                            <span
                                class="{{ $isEven ? "text-slate-500" : "text-indigo-600 group-hover:scale-110" }} relative block text-2xl font-black transition-transform duration-300">
                                {{ $scale["val"] }}
                            </span>

                            <h5 class="relative mt-1 text-[10px] font-black uppercase tracking-wider text-slate-700">
                                {{ $scale["title"] }}
                            </h5>

                            <p class="relative mt-1 text-[9px] font-medium leading-tight text-slate-400">
                                {{ $scale["desc"] }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4">
                @foreach ($criterias as $c1)
                    @foreach ($criterias as $c2)
                        @if ($c1->id < $c2->id)
                            @php $currentValue = $comparisons[$c1->id][$c2->id] ?? null; @endphp

                            <div class="rounded-3xl bg-slate-50/50 p-6 lg:p-8">
                                <div class="flex flex-wrap items-center justify-center gap-3 md:gap-4">

                                    @foreach (["9", "8", "7", "6", "5", "4", "3", "2"] as $val)
                                        <label class="group/item flex cursor-pointer flex-col items-center gap-2"
                                            title="Kriteria A lebih penting skor {{ $val }}">
                                            <input type="radio" name="nilai[{{ $c1->id }}][{{ $c2->id }}]"
                                                value="{{ $val }}"
                                                class="radio radio-primary radio-sm border-slate-300 transition-all checked:bg-indigo-600"
                                                {{ (string) old("nilai.$c1->id.$c2->id", $currentValue) === (string) $val ? "checked" : "" }}>
                                            <span
                                                class="text-[10px] font-bold text-slate-400 group-hover/item:text-indigo-600">{{ $val }}</span>
                                        </label>
                                    @endforeach

                                    <label class="group/item mx-2 flex cursor-pointer flex-col items-center gap-2">
                                        <input type="radio" name="nilai[{{ $c1->id }}][{{ $c2->id }}]"
                                            value="1"
                                            class="radio radio-sm border-slate-300 transition-all checked:bg-slate-700"
                                            {{ (string) old("nilai.$c1->id.$c2->id", $currentValue) === "1" || is_null($currentValue) ? "checked" : "" }}>
                                        <span
                                            class="badge badge-neutral h-5 px-2 text-[9px] font-black tracking-tighter">1</span>
                                    </label>

                                    @php
                                        $rightScales = [
                                            "1/2" => 2,
                                            "1/3" => 3,
                                            "1/4" => 4,
                                            "1/5" => 5,
                                            "1/6" => 6,
                                            "1/7" => 7,
                                            "1/8" => 8,
                                            "1/9" => 9
                                        ];
                                    @endphp

                                    @foreach ($rightScales as $val => $lbl)
                                        @php
                                            // Hitung nilai numerik dari string pecahan (misal '1/6' jadi 0.1666...)
                                            $numericVal = eval("return $val;");

                                            // Cek apakah currentValue mendekati nilai numerik ini (toleransi selisih sangat kecil)
                                            $isChecked =
                                                !is_null($currentValue) && abs($currentValue - $numericVal) < 0.00001;
                                        @endphp

                                        <label class="group/item flex cursor-pointer flex-col items-center gap-2"
                                            title="Kriteria B lebih penting skor {{ $lbl }}">
                                            <input type="radio" name="nilai[{{ $c1->id }}][{{ $c2->id }}]"
                                                value="{{ $val }}"
                                                class="radio radio-secondary radio-sm border-slate-300 transition-all checked:bg-violet-600"
                                                {{ $isChecked || old("nilai.$c1->id.$c2->id") === $val ? "checked" : "" }}>
                                            <span
                                                class="text-[10px] font-bold text-slate-400 group-hover/item:text-violet-600">{{ $lbl }}</span>
                                        </label>
                                    @endforeach

                                </div>

                                <div class="mt-6 flex justify-between border-t border-slate-100 px-1 pt-4">
                                    <span class="text-[10px] font-black uppercase italic text-indigo-500">← Dominan
                                        {{ $c1->nama }}</span>
                                    <span class="text-[10px] font-black uppercase italic text-violet-500">Dominan
                                        {{ $c2->nama }} →</span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>

            {{-- @if ($criterias->count() <= 1)
                <div class="rounded-[2.5rem] border-2 border-dashed border-slate-200 bg-slate-50 p-12 text-center">
                    <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-3xl bg-white shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-800">Kriteria Belum Cukup</h3>
                    <p class="mx-auto mt-2 max-w-sm text-sm font-medium text-slate-500">
                        Anda membutuhkan setidaknya <span class="font-bold text-indigo-600">2 kriteria</span> untuk
                        melakukan perbandingan berpasangan (AHP).
                    </p>
                    <a href="{{ url('criteria') }}" class="btn btn-primary btn-sm mt-6 rounded-xl px-6 normal-case">
                        Tambah Kriteria Sekarang
                    </a>
                </div>
            @endif --}}

            <div class="mt-12 flex flex-col items-center gap-4">
                @if ($criterias->count() > 1)
                    <button type="submit"
                        class="group flex w-full items-center justify-center gap-3 rounded-[2rem] bg-indigo-600 py-5 font-black uppercase tracking-[0.2em] text-white shadow-xl shadow-indigo-100 transition-all hover:bg-indigo-700 hover:shadow-indigo-200 active:scale-[0.98] md:w-auto md:px-20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform group-hover:scale-110"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                        </svg>
                        Proses & Simpan Matriks
                    </button>

                    <p class="text-xs font-bold uppercase tracking-widest text-slate-400">
                        Pastikan seluruh kriteria telah dibandingkan dengan benar
                    </p>
                @else
                    <div
                        class="flex w-full items-center justify-center gap-3 rounded-[2rem] bg-slate-100 py-5 font-black uppercase tracking-[0.2em] text-slate-400 md:w-auto md:px-20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Simpan Terkunci
                    </div>
                @endif
            </div>
        </form>
    </div>
@endsection
