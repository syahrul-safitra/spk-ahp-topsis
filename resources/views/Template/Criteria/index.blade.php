@extends("Template.Layouts.main") {{-- Pastikan mengarah ke layout baru kita --}}

@section("title", "Data Kriteria AHP")

@section("content")
    <div class="space-y-6">

        <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div>
                <h2 class="text-2xl font-black tracking-tight text-slate-800">Data Kriteria (AHP)</h2>
                <p class="text-sm font-medium text-slate-500">Kelola parameter penilaian untuk perhitungan metode AHP.</p>
            </div>

            <a href="{{ url("criteria/create") }}"
                class="btn btn-primary rounded-2xl border-none px-6 normal-case shadow-lg shadow-indigo-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Tambah Kriteria
            </a>
        </div>

        @if (session("success"))
            <div class="alert rounded-2xl border-emerald-100 bg-emerald-50 py-4 text-emerald-700 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-bold">{{ session("success") }}</span>
            </div>
        @endif

        <div class="card overflow-hidden rounded-[2rem] border border-white/50 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="table-lg table w-full">
                    <thead class="bg-slate-50/50">
                        <tr
                            class="border-b border-slate-100 text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400">
                            <th class="pl-8 text-center">No</th>
                            <th>Kode</th>
                            <th>Nama Kriteria</th>
                            <th class="text-center">Atribut</th>
                            <th class="pr-8 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-slate-600">
                        @forelse ($criterias as $item)
                            <tr class="border-b border-slate-50 transition-colors hover:bg-slate-50/50">
                                <td class="pl-8 text-center">
                                    <span class="text-xs font-bold text-slate-400">{{ $loop->iteration }}</span>
                                </td>

                                <td>
                                    <div class="badge badge-ghost rounded-lg p-3 font-black text-indigo-600">
                                        {{ $item->kode }}
                                    </div>
                                </td>

                                <td>
                                    <span class="font-bold tracking-tight text-slate-700">{{ $item->nama }}</span>
                                </td>

                                <td class="text-center">
                                    @if ($item->atribut == "benefit")
                                        <div
                                            class="badge border-emerald-100 bg-emerald-50 px-4 py-3 text-[10px] font-bold text-emerald-600">
                                            BENEFIT
                                        </div>
                                    @else
                                        <div
                                            class="badge border-rose-100 bg-rose-50 px-4 py-3 text-[10px] font-bold text-rose-600">
                                            COST
                                        </div>
                                    @endif
                                </td>

                                <td class="pr-8 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ url("criteria/" . $item->id . "/edit") }}"
                                            class="btn btn-ghost btn-sm btn-square rounded-xl text-amber-500 hover:bg-amber-50">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <button type="button"
                                            onclick="prepareDelete('{{ $item->id }}', '{{ $item->nama }}')"
                                            class="btn btn-ghost btn-sm btn-square rounded-xl text-rose-500 hover:bg-rose-50">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-16">
                                    <div class="flex flex-col items-center justify-center text-slate-400">
                                        <div class="mb-4 rounded-[2.5rem] bg-slate-50 p-6 text-slate-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                        </div>
                                        <p class="font-bold tracking-tight">Data kriteria belum tersedia</p>
                                        <p class="text-xs">Klik tombol tambah kriteria untuk memulai.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <dialog id="delete_modal" class="modal modal-bottom sm:modal-middle">
                    <div class="modal-box rounded-[2.5rem] border border-slate-50 bg-white p-8 shadow-2xl">
                        <div class="flex flex-col items-center text-center">
                            <div
                                class="mb-6 flex h-20 w-20 items-center justify-center rounded-3xl bg-rose-50 text-rose-500 ring-8 ring-rose-50/50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </div>
                            <h3 class="text-center text-xl font-black tracking-tight text-slate-800">Hapus Data Kriteria?
                            </h3>
                            <p class="py-4 text-sm leading-relaxed text-slate-500">
                                Anda akan menghapus kriteria <span id="delete_name_label"
                                    class="font-bold text-rose-600 underline decoration-rose-200"></span>. Tindakan ini
                                permanen.
                            </p>
                        </div>

                        <div class="modal-action flex justify-center gap-3">
                            <form method="dialog">
                                <button
                                    class="btn btn-ghost rounded-2xl px-6 font-bold normal-case text-slate-400 hover:bg-slate-100">Batal</button>
                            </form>
                            <form id="delete_form_actual" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit"
                                    class="btn btn-error rounded-2xl border-none px-10 font-bold normal-case text-white shadow-xl shadow-rose-100">
                                    Hapus Sekarang
                                </button>
                            </form>
                        </div>
                    </div>
                    <form method="dialog" class="modal-backdrop bg-slate-900/60 backdrop-blur-md">
                        <button>close</button>
                    </form>
                </dialog>
            </div>
        </div>
    </div>

    {{-- @push("scripts") --}}
    <script>
        function prepareDelete(id, name) {
            // 1. Dapatkan elemen modal dan form
            const modal = document.getElementById('delete_modal');
            const form = document.getElementById('delete_form_actual');
            const label = document.getElementById('delete_name_label');

            // 2. Set Action URL secara dinamis (sesuaikan dengan URL Laravel Anda)
            form.action = `/criteria/${id}`;

            // 3. Set Nama Kriteria di teks modal
            label.innerText = name;

            // 4. Tampilkan Modal
            modal.showModal();
        }
    </script>
    {{-- @endpush --}}
@endsection
