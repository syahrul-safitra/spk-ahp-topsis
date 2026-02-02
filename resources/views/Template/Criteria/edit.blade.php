@extends("Template.Layouts.main")

@section("title", "Edit Kriteria AHP")

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
                <div class="flex items-center gap-2">
                    <h2 class="text-2xl font-black tracking-tight text-slate-800">Edit Kriteria</h2>
                    <div class="badge badge-warning badge-outline rounded-md text-[10px] font-bold">{{ $criteria->kode }}
                    </div>
                </div>
                <p class="text-sm font-medium text-slate-500">Perbarui informasi parameter penilaian untuk kriteria ini.</p>
            </div>
        </div>

        <div class="card overflow-hidden rounded-[2.5rem] border border-white/50 bg-white shadow-sm">
            <div class="card-body p-8 lg:p-12">

                <form action="{{ url("criteria/" . $criteria->id) }}" method="POST" class="space-y-8">
                    @csrf
                    @method("PUT")

                    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">

                        <div class="form-control w-full">
                            <label class="label mb-2">
                                <span class="label-text font-bold text-slate-700">Nama Kriteria</span>
                            </label>
                            <input type="text" name="nama" value="{{ old("nama", $criteria->nama) }}"
                                placeholder="Contoh: Harga atau Kualitas"
                                class="input input-bordered @error("nama") input-error @enderror w-full rounded-2xl border-slate-100 bg-slate-50 transition-all focus:border-amber-200 focus:bg-white focus:ring-4 focus:ring-amber-50"
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
                                class="select select-bordered @error("atribut") select-error @enderror w-full rounded-2xl border-slate-100 bg-slate-50 transition-all focus:border-amber-200 focus:bg-white focus:ring-4 focus:ring-amber-50">
                                <option value="" disabled>-- Pilih Atribut --</option>
                                <option value="benefit"
                                    {{ old("atribut", $criteria->atribut) == "benefit" ? "selected" : "" }}>Benefit (Makin
                                    besar makin baik)</option>
                                <option value="cost" {{ old("atribut", $criteria->atribut) == "cost" ? "selected" : "" }}>
                                    Cost (Makin kecil makin baik)</option>
                            </select>
                            @error("atribut")
                                <label class="label">
                                    <span class="label-text-alt font-semibold text-rose-500">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                    </div>

                    <div class="flex gap-4 rounded-3xl border border-amber-100/50 bg-amber-50/50 p-6">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-500 text-white shadow-lg shadow-amber-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-amber-900">Mode Pengeditan</h4>
                            <p class="mt-1 text-xs leading-relaxed text-amber-700/70">
                                Perubahan pada atribut (Benefit/Cost) akan mempengaruhi arah perhitungan pada metode
                                <strong>TOPSIS</strong>. Pastikan data sudah benar sebelum menyimpan.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 border-t border-slate-50 pt-4">
                        <a href="{{ url("criteria") }}"
                            class="btn btn-ghost rounded-2xl px-8 font-bold normal-case text-slate-500 hover:bg-slate-100">
                            Batal
                        </a>
                        <button type="submit"
                            class="btn rounded-2xl border-none bg-amber-500 px-10 normal-case text-white shadow-xl shadow-amber-100 transition-all hover:bg-amber-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Perbarui Data
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
