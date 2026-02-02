@extends("Template.Layouts.main")

@section("title", "Edit Alternatif (TOPSIS)")

@section("content")
    <div class="mx-auto max-w-4xl animate-[fadeIn_0.5s_ease-out] space-y-8">

        <div class="flex items-center gap-4">
            <a href="{{ url("alternative") }}"
                class="btn btn-ghost btn-circle bg-white shadow-sm transition-all hover:bg-slate-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h2 class="text-2xl font-black tracking-tight text-slate-800">Edit Alternatif</h2>
                <p class="text-sm font-medium italic text-slate-500">Mengubah data: <span
                        class="font-bold text-amber-600">{{ $alternative->nama }}</span></p>
            </div>
        </div>

        <form action="{{ url("alternative/" . $alternative->id) }}" method="POST" class="space-y-6">
            @csrf
            @method("PUT")

            <div class="card overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white shadow-sm">
                <div class="border-b border-slate-50 bg-amber-50/20 p-8">
                    <h3 class="flex items-center gap-2 text-xs font-black uppercase tracking-widest text-slate-700">
                        <div class="h-2 w-2 animate-pulse rounded-full bg-amber-500"></div>
                        Informasi Dasar
                    </h3>
                </div>
                <div class="grid grid-cols-1 gap-8 p-8 md:grid-cols-2">
                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span class="label-text text-[11px] font-black uppercase tracking-wider text-slate-600">Nama
                                Alternatif</span>
                        </label>
                        <input type="text" name="nama" value="{{ old("nama", $alternative->nama) }}"
                            class="input input-bordered @error("nama") input-error @enderror rounded-2xl border-slate-200 bg-slate-50 transition-all focus:bg-white focus:ring-4 focus:ring-amber-100">
                        @error("nama")
                            <label class="label"><span
                                    class="label-text-alt font-bold text-rose-500">{{ $message }}</span></label>
                        @enderror
                    </div>

                    <div class="form-control w-full">
                        <label class="label mb-1">
                            <span
                                class="label-text text-[11px] font-black uppercase tracking-wider text-slate-600">Keterangan</span>
                        </label>
                        <input type="text" name="keterangan" value="{{ old("keterangan", $alternative->keterangan) }}"
                            class="input input-bordered @error("keterangan") input-error @enderror rounded-2xl border-slate-200 bg-slate-50 transition-all focus:bg-white focus:ring-4 focus:ring-amber-100">
                        @error("keterangan")
                            <label class="label"><span
                                    class="label-text-alt font-bold text-rose-500">{{ $message }}</span></label>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white shadow-sm">
                <div class="border-b border-slate-50 bg-slate-50/30 p-8">
                    <h3 class="flex items-center gap-2 text-xs font-black uppercase tracking-widest text-slate-700">
                        <span class="h-2 w-2 rounded-full bg-indigo-500"></span>
                        Parameter Nilai Kriteria
                    </h3>
                </div>
                <div class="p-8">
                    <div class="grid grid-cols-1 gap-x-12 gap-y-6 md:grid-cols-2">
                        @foreach ($criterias as $c)
                            @php
                                $currentValue =
                                    $alternative->values->where("criteria_id", $c->id)->first()->nilai ?? "";
                            @endphp
                            <div class="group transition-all">
                                <div class="mb-2 flex items-center justify-between">
                                    <label
                                        class="text-sm font-bold text-slate-700 transition-colors group-hover:text-indigo-600">
                                        {{ $c->nama }}
                                    </label>
                                    <span
                                        class="badge badge-ghost rounded-lg text-[10px] font-black uppercase tracking-tighter opacity-60">
                                        {{ $c->atribut }}
                                    </span>
                                </div>
                                <div class="relative">
                                    <input type="number" step="0.01" min="0" name="nilai[{{ $c->id }}]"
                                        value="{{ old("nilai." . $c->id, $currentValue) }}"
                                        class="input input-bordered @error("nilai." . $c->id) input-error @enderror w-full rounded-2xl border-slate-200 bg-slate-50 pl-12 transition-all focus:bg-white focus:ring-4 focus:ring-indigo-100"
                                        required>
                                    <div
                                        class="absolute left-4 top-1/2 -translate-y-1/2 border-r border-slate-200 pr-3 font-mono text-xs font-bold text-slate-400">
                                        {{ $c->kode ?? "C" . $loop->iteration }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div
                class="flex items-center justify-between rounded-[2rem] border border-slate-100 bg-white/80 p-6 shadow-xl shadow-slate-200/50 backdrop-blur-md">
                <p class="hidden text-[10px] font-bold uppercase italic tracking-widest text-slate-400 md:block">
                    Mode Pembaruan Data Alternatif
                </p>
                <div class="flex w-full gap-3 md:w-auto">
                    <a href="{{ url("alternative") }}"
                        class="btn btn-ghost flex-1 rounded-2xl px-8 font-black normal-case text-slate-400 transition-all hover:bg-slate-100 md:flex-none">
                        Batal
                    </a>

                    <button type="submit"
                        class="group relative inline-flex flex-1 items-center justify-center gap-2 rounded-2xl bg-emerald-600 px-10 py-3 font-black text-white shadow-lg shadow-emerald-200 transition-all duration-200 hover:bg-emerald-700 focus:outline-none active:scale-95 md:flex-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        <span>Perbarui Data</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
