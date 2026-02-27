@extends("Template.Layouts.main")
@section("title", "Data Alternatif")

@section("content")

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <style>
        /* Reset DataTables Border */
        table.dataTable.no-footer {
            border-bottom: none !important;
        }

        /* Layout Header DataTable (Search & Length) */
        .dataTables_wrapper .dataTables_filter input {
            @apply input input-bordered bg-slate-50 border-slate-200 rounded-2xl ml-3 px-4 py-2 w-64 transition-all focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none;
        }

        .dataTables_wrapper .dataTables_length select {
            @apply select select-bordered bg-slate-50 border-slate-200 rounded-2xl px-8 mx-2 outline-none;
        }

        /* Pagination Styling */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            @apply rounded-xl border-none font-bold text-xs !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            @apply bg-emerald-600 text-white shadow-lg shadow-emerald-200 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            @apply bg-emerald-50 text-emerald-600 !important;
        }
    </style>

    <div class="mx-auto space-y-6">

        @session("warning")
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
                                    <span class="font-bold text-rose-600">Kesalahan:</span> Silahkan masukan data alternatif
                                    terlebih dahulu.
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

        <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div>
                <h2 class="flex items-center gap-3 text-2xl font-black tracking-tight text-slate-800">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    Data Alternatif
                </h2>
            </div>
            @if ($criterias > 0)
                <a href="{{ url("/alternative/create") }}"
                    class="btn btn-primary rounded-2xl px-8 shadow-lg shadow-indigo-100">
                    Tambah Alternatif Baru
                </a>
            @else
                <button disabled class="btn btn-disabled cursor-not-allowed rounded-2xl px-8 opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Tambah Terkunci
                </button>
            @endif
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

        <div class="card overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-sm">
            <div class="overflow-x-auto">
                <table id="alternativeTable" class="table w-full border-none">
                    <thead>
                        <tr
                            class="border-none bg-slate-50/80 text-[11px] font-black uppercase tracking-widest text-slate-400">
                            <th class="w-16 p-6 text-center">No</th>
                            <th>Nama Alternatif</th>
                            <th>Keterangan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach ($alternatives as $item)
                            <tr class="group transition-colors hover:bg-slate-50/50">
                                <td class="p-6 text-center">
                                    <span class="text-xs font-black text-slate-400 group-hover:text-emerald-500">
                                        {{ str_pad($loop->iteration, 2, "0", STR_PAD_LEFT) }}
                                    </span>
                                </td>
                                <td class="p-6">
                                    <span
                                        class="block text-sm font-black uppercase text-slate-700">{{ $item->nama }}</span>
                                    <span class="text-[10px] font-bold text-slate-400">ID: {{ $item->id }}</span>
                                </td>
                                <td class="p-6 text-xs italic text-slate-500">
                                    "{{ Str::limit($item->keterangan, 50) }}"
                                </td>
                                <td class="p-6 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ url("alternative/" . $item->id . "/edit") }}"
                                            class="btn btn-ghost btn-sm btn-square rounded-xl border-none text-amber-500 shadow-none transition-all hover:scale-110 hover:bg-amber-50"
                                            title="Edit Data">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <button type="button" data-id="{{ $item->id }}" data-nama="{{ $item->nama }}"
                                            class="btn-delete-trigger btn btn-ghost btn-sm btn-square rounded-xl border-none text-rose-500 shadow-none transition-all hover:scale-110 hover:bg-rose-50"
                                            title="Hapus Data">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <dialog id="modal_delete" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box rounded-[2.5rem] bg-white p-8 shadow-2xl">
            <div class="text-center">
                <h3 class="text-xl font-black text-slate-800">Hapus Data?</h3>
                <p class="py-4 text-sm text-slate-500">
                    Anda akan menghapus <span id="display_name" class="font-black text-rose-600 underline"></span> secara
                    permanen.
                </p>
            </div>
            <div class="modal-action flex justify-center gap-3">
                <form method="dialog">
                    <button class="btn btn-ghost rounded-2xl px-6 font-black text-slate-400">Batal</button>
                </form>
                <form id="form_delete_permanent" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="submit"
                        class="btn btn-error rounded-2xl px-8 font-black text-white shadow-xl shadow-rose-100">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop bg-slate-900/40 backdrop-blur-sm"><button>close</button></form>
    </dialog>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            // 1. Inisialisasi DataTable
            const table = $('#alternativeTable').DataTable({
                "dom": '<"flex flex-col md:flex-row justify-between items-center gap-4 mb-6"lf>rt<"flex flex-col md:flex-row justify-between items-center mt-6"ip>',
                "language": {
                    "search": "",
                    "searchPlaceholder": "Cari data alternatif...",
                    "lengthMenu": "Tampilkan _MENU_",
                    "info": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    "paginate": {
                        "previous": "‹",
                        "next": "›"
                    }
                }
            });

            // 2. Event Delegation untuk Tombol Delete
            // Ini memperbaiki "Uncaught ReferenceError" & "Cannot set properties of null"
            $(document).on('click', '.btn-delete-trigger', function() {
                const id = $(this).attr('data-id');
                const nama = $(this).attr('data-nama');

                // Ambil elemen modal dan form
                const modal = document.getElementById('modal_delete');
                const form = document.getElementById('form_delete_permanent');
                const display = document.getElementById('display_name');

                if (modal && form) {
                    // Set data secara dinamis
                    form.action = `/alternative/${id}`; // PASTIkan route ini benar di web.php
                    display.innerText = nama;

                    // Tampilkan modal (Fungsi bawaan DaisyUI/HTML5 Dialog)
                    modal.showModal();
                } else {
                    console.error("EROR: Elemen Modal atau Form tidak ditemukan!");
                }
            });
        });
    </script>
@endsection
