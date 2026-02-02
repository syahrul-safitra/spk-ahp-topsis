@extends("Template.Layouts.main")
@section("title", "Manajemen User")

@section("content")
    <div class="mx-auto space-y-6">
        <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div>
                <h2 class="flex items-center gap-3 text-2xl font-black tracking-tight text-slate-800">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    Manajemen User
                </h2>
                <p class="ml-13 text-sm font-medium text-slate-500">Kelola hak akses pengguna sistem.</p>
            </div>
            <a href="{{ url("user/create") }}"
                class="btn rounded-2xl border-none bg-indigo-600 text-white shadow-lg shadow-indigo-100 hover:bg-indigo-700">
                <span class="font-black">+ Tambah User</span>
            </a>
        </div>

        @if (session("success"))
            <div id="alert-success"
                class="mb-6 flex items-center justify-between rounded-[2rem] border border-emerald-100 bg-emerald-50/50 p-4 px-6 backdrop-blur-md transition-all duration-500">
                <div class="flex items-center gap-4">
                    <div
                        class="flex h-10 w-10 animate-pulse items-center justify-center rounded-full bg-emerald-500 text-white shadow-lg shadow-emerald-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-black uppercase tracking-widest text-emerald-700">Berhasil!</h4>
                        <p class="text-xs font-bold text-emerald-600/80">{{ session("success") }}</p>
                    </div>
                </div>

                <button onclick="closeAlert()" class="group rounded-xl p-2 transition-colors hover:bg-emerald-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-400 group-hover:text-emerald-600"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        <div class="card overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-sm">
            <table id="userTable" class="table w-full">
                <thead>
                    <tr class="border-none bg-slate-50/80 text-[11px] font-black uppercase tracking-widest text-slate-400">
                        <th class="w-16 p-6 text-center">No</th>
                        <th>Nama Pengguna</th>
                        <th>Email</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="group transition-colors hover:bg-slate-50/50">
                            <td class="p-6 text-center text-xs font-black text-slate-400">
                                {{ str_pad($loop->iteration, 2, "0", STR_PAD_LEFT) }}
                            </td>
                            <td class="p-6">
                                <span class="block text-sm font-black uppercase text-slate-700">{{ $user->name }}</span>
                                <span class="text-[10px] font-bold italic text-slate-400">User ID:
                                    #{{ $user->id }}</span>
                            </td>
                            <td class="p-6 text-sm font-medium text-slate-600">
                                {{ $user->email }}
                            </td>
                            <td class="p-6 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ url("user/" . $user->id . "/edit") }}"
                                        class="btn btn-ghost btn-sm btn-square rounded-xl text-amber-500 hover:bg-amber-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    @if (!$user->is_admin)
                                        <button type="button" data-id="{{ $user->id }}" data-nama="{{ $user->name }}"
                                            class="btn-delete-trigger btn btn-ghost btn-sm btn-square rounded-xl text-rose-500 hover:bg-rose-50">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <dialog id="modal_delete" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box rounded-[2.5rem] border border-slate-50 bg-white p-10 shadow-2xl">
            <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-rose-50 text-rose-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>

            <div class="text-center">
                <h3 class="text-2xl font-black tracking-tight text-slate-800">Hapus Pengguna?</h3>
                <p class="mt-3 px-4 text-sm font-medium leading-relaxed text-slate-500">
                    Anda akan menghapus akun <span id="del_user_name"
                        class="font-black text-rose-600 underline decoration-rose-200 underline-offset-4"></span>. Tindakan
                    ini tidak dapat dibatalkan.
                </p>
            </div>

            <div class="modal-action mt-10 flex justify-center gap-4">
                <form method="dialog">
                    <button
                        class="btn btn-ghost rounded-2xl px-8 font-black uppercase tracking-widest text-slate-400 hover:bg-slate-50">
                        Batal
                    </button>
                </form>

                <form id="form_delete_user" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="submit"
                        class="btn btn-error rounded-2xl px-10 font-black uppercase tracking-widest text-white shadow-lg shadow-rose-100 transition-all active:scale-95">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>

        <form method="dialog" class="modal-backdrop bg-slate-900/40 backdrop-blur-sm">
            <button>close</button>
        </form>
    </dialog>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function() {
            // Gunakan delegasi event agar tombol tetap jalan meski tabel di-filter/sortir
            $(document).on('click', '.btn-delete-trigger', function() {
                const id = $(this).attr('data-id');
                const nama = $(this).attr('data-nama');

                // Target elemen modal
                const modal = document.getElementById('modal_delete');
                const form = document.getElementById('form_delete_user');
                const nameLabel = document.getElementById('del_user_name');

                if (modal && form) {
                    // Set URL action Laravel secara dinamis
                    form.action = `/user/${id}`;

                    // Set nama yang akan muncul di teks konfirmasi
                    nameLabel.innerText = nama;

                    // Tampilkan modal
                    modal.showModal();
                }
            });
        });
    </script>

    <script>
        function closeAlert() {
            const alert = document.getElementById('alert-success');
            if (alert) {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(() => alert.remove(), 500);
            }
        }

        // Auto close setelah 4 detik
        setTimeout(() => {
            closeAlert();
        }, 4000);
    </script>

    {{-- @include("Template.Components.modal-delete", ["route" => "users"]) --}}
@endsection
