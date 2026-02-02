@extends("Template.Layouts.main")

@section("title", "Tambah Kriteria AHP")

@section("content")
    <div class="mx-auto space-y-8">

        <div class="flex items-center gap-4">
            <a href="{{ url("criteria") }}"
                class="btn btn-ghost btn-circle bg-white shadow-sm transition-all hover:bg-slate-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h2 class="text-2xl font-black tracking-tight text-slate-800">Tambah Kriteria Baru</h2>
                <p class="text-sm font-medium text-slate-500">Lengkapi detail di bawah untuk menambah parameter AHP.</p>
            </div>
        </div>

        <div class="card overflow-hidden rounded-[2.5rem] border border-white/50 bg-white shadow-sm">
            <div class="card-body p-8 lg:p-12">

                <form action="{{ url("criteria") }}" method="POST" class="space-y-8">
                    @csrf

                    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">

                        <div class="form-control w-full">
                            <label class="label mb-2">
                                <span class="label-text font-bold text-slate-700">Nama Kriteria</span>
                            </label>
                            <input type="text" name="nama" value="{{ old("nama") }}"
                                placeholder="Contoh: Harga atau Kualitas"
                                class="input input-bordered @error("nama") input-error @enderror w-full rounded-2xl border-slate-100 bg-slate-50 transition-all focus:bg-white focus:ring-4 focus:ring-indigo-50"
                                autofocus />
                            @error("nama")
                                <label class="label">
                                    <span class="label-text-alt font-semibold text-rose-500">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control w-full">
                            <label class="label mb-2">
                                <span class="label-text font-bold text-slate-700">Atribut Kriteria</span>
                            </label>
                            <select name="atribut"
                                class="select select-bordered @error("atribut") select-error @enderror w-full rounded-2xl border-slate-100 bg-slate-50 transition-all focus:bg-white focus:ring-4 focus:ring-indigo-50">
                                <option value="" disabled selected>-- Pilih Atribut --</option>
                                <option value="benefit" {{ old("atribut") == "benefit" ? "selected" : "" }}>Benefit (Makin
                                    besar makin baik)</option>
                                <option value="cost" {{ old("atribut") == "cost" ? "selected" : "" }}>Cost (Makin kecil
                                    makin baik)</option>
                            </select>
                            @error("atribut")
                                <label class="label">
                                    <span class="label-text-alt font-semibold text-rose-500">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                    </div>

                    <div class="flex gap-4 rounded-3xl border border-indigo-100/50 bg-indigo-50/50 p-6">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-500 text-white shadow-lg shadow-indigo-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-indigo-900">Informasi Otomasi AHP</h4>
                            <p class="mt-1 text-xs leading-relaxed text-indigo-700/70">
                                Anda tidak perlu menginputkan bobot secara manual. Bobot akan dikalkulasi secara otomatis
                                menggunakan <strong>Metode Perbandingan Berpasangan</strong> segera setelah data kriteria
                                terkumpul.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 border-t border-slate-50 pt-4">
                        <a href="{{ url("criteria") }}"
                            class="btn btn-ghost rounded-2xl px-8 font-bold normal-case text-slate-500 hover:bg-slate-100">
                            Batal
                        </a>
                        <button type="submit"
                            class="btn btn-primary rounded-2xl border-none px-10 normal-case shadow-xl shadow-indigo-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                            </svg>
                            Simpan Data
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
