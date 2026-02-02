@extends("Template.Layouts.main")
@section("title", "Edit User")

@section("content")
    <div class="mx-auto space-y-6">
        <div class="flex items-center gap-4">
            <a href="{{ url("users") }}"
                class="btn btn-ghost btn-sm btn-square rounded-xl bg-white shadow-sm hover:bg-slate-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h2 class="text-2xl font-black tracking-tight text-slate-800">Edit User</h2>
                <p class="text-sm font-medium text-slate-500">Perbarui informasi akun pengguna.</p>
            </div>
        </div>

        <div class="card overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-sm">
            <form action="{{ url("user/" . $user->id) }}" method="POST" class="space-y-6">
                @csrf
                @method("PUT")

                <div class="grid grid-cols-12 gap-x-6 gap-y-5">
                    <div class="col-span-12 md:col-span-6">
                        <div class="form-control w-full">
                            <label class="label mb-1 px-1">
                                <span class="text-[11px] font-black uppercase tracking-widest text-slate-400">Nama
                                    Lengkap</span>
                            </label>
                            <input type="text" name="name" value="{{ old("name", $user->name) }}"
                                class="input input-bordered w-full rounded-2xl border-slate-200 bg-slate-50 outline-none transition-all focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/10"
                                placeholder="Contoh: Ahmad Subardjo" required>
                            @error("name")
                                <span class="mt-1 px-1 text-xs font-bold text-rose-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <div class="form-control w-full">
                            <label class="label mb-1 px-1">
                                <span class="text-[11px] font-black uppercase tracking-widest text-slate-400">Alamat
                                    Email</span>
                            </label>
                            <input type="email" name="email" value="{{ old("email", $user->email) }}"
                                class="input input-bordered w-full rounded-2xl border-slate-200 bg-slate-50 outline-none transition-all focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/10"
                                placeholder="email@domain.com" required>
                            @error("email")
                                <span class="mt-1 px-1 text-xs font-bold text-rose-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-span-12">
                        <div class="form-control w-full">
                            <label class="label mb-1 flex justify-between px-1">
                                <span class="text-[11px] font-black uppercase tracking-widest text-slate-400">Ganti Password
                                    (Opsional)</span>
                            </label>
                            <div class="relative w-full">
                                <input type="password" id="password" name="password"
                                    class="input input-bordered w-full rounded-2xl border-slate-200 bg-slate-50 outline-none transition-all focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/10"
                                    placeholder="Kosongkan jika tidak ingin mengubah password">
                                <button type="button" onclick="togglePassword()"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 transition-colors hover:text-indigo-600">
                                    <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            <p class="mt-3 flex items-center gap-2 px-1 text-[10px] font-bold italic text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Biarkan kosong jika tidak ingin mengganti password lama.
                            </p>
                            @error("password")
                                <span class="mt-1 px-1 text-xs font-bold text-rose-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 border-t border-slate-50 pt-6">
                    <a href="{{ url("user") }}"
                        class="btn btn-ghost rounded-2xl px-8 font-black uppercase tracking-widest text-slate-400">Batal</a>
                    <button type="submit"
                        class="btn rounded-2xl border-none bg-indigo-600 px-10 text-white shadow-lg shadow-indigo-100 transition-all hover:bg-indigo-700 active:scale-95">
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const pwd = document.getElementById('password');
            pwd.type = pwd.type === 'password' ? 'text' : 'password';
        }
    </script>
@endsection
