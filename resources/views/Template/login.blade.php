@extends('Template.Layouts.auth')

@section('title', 'Login - Seleksi Karyawan Terbaik BULOG')

@section('content')
    <div class="flex min-h-screen items-center justify-center bg-slate-50 p-6">
        <div class="grid w-full max-w-5xl grid-cols-1 overflow-hidden rounded-[3rem] bg-white shadow-2xl md:grid-cols-2">

            <div
                class="relative hidden flex-col justify-between bg-gradient-to-br from-blue-900 via-indigo-900 to-blue-800 p-12 text-white md:flex">
                <div class="absolute inset-0 opacity-10"
                    style="background-image: url('https://www.transparenttextures.com/patterns/graphy.png');"></div>

                <div class="relative z-10">
                    <div
                        class="mb-8 inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-white/10 backdrop-blur-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-yellow-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z" />
                        </svg>
                    </div>
                    <h1 class="text-4xl font-black leading-tight tracking-tighter">
                        Sistem Seleksi <br> <span class="text-yellow-400">Karyawan Terbaik</span>
                    </h1>
                    <p class="mt-4 text-lg font-medium text-blue-100/80">Human Capital Management - Perum BULOG</p>
                </div>

                <div class="relative z-10">
                    <div class="rounded-3xl border border-white/10 bg-white/5 p-6 backdrop-blur-md">
                        <p class="text-sm italic leading-relaxed text-blue-100">
                            "Apresiasi atas dedikasi dan kinerja unggul insan BULOG untuk mewujudkan kedaulatan pangan
                            dengan integritas."
                        </p>
                    </div>
                    <p class="mt-8 text-xs font-bold uppercase tracking-widest text-blue-300">© 2026 Perum BULOG -
                        Achievement System</p>
                </div>
            </div>

            <div class="p-10 md:p-16">
                <div class="mb-10 text-center md:text-left">
                    <h2 class="text-3xl font-black tracking-tight text-slate-800">Panel Penilai</h2>
                    <p class="mt-2 text-sm font-medium text-slate-500">Masuk untuk memulai proses evaluasi kinerja karyawan.
                    </p>
                </div>

                <form action="{{ url('login') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="form-control w-full">
                        <label class="label mb-1 px-1">
                            <span class="text-[11px] font-black uppercase tracking-widest text-slate-400"> Email</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="input input-bordered w-full rounded-2xl border-slate-200 bg-slate-50 pl-12 transition-all focus:border-blue-600 focus:ring-2 focus:ring-blue-600/10"
                                placeholder="admin@gmail.com">
                        </div>
                        @error('email')
                            <span class="mt-1 px-1 text-xs font-bold text-rose-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-control w-full">
                        <label class="label mb-1 px-1">
                            <span class="text-[11px] font-black uppercase tracking-widest text-slate-400">Kata Sandi</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </span>
                            <input type="password" id="password" name="password" required
                                class="input input-bordered w-full rounded-2xl border-slate-200 bg-slate-50 pl-12 pr-12 transition-all focus:border-blue-600 focus:ring-2 focus:ring-blue-600/10"
                                placeholder="••••••••">

                            <button type="button" onclick="togglePasswordVisibility()"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 transition-colors hover:text-blue-600">
                                <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path id="eye-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path id="eye-back-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit"
                        class="btn btn-primary w-full rounded-2xl border-none bg-blue-900 py-4 font-black uppercase tracking-[0.2em] text-white shadow-xl shadow-blue-100 transition-all hover:bg-blue-800 active:scale-95">
                        Masuk ke Dashboard
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                // Ubah ikon ke mata tertutup (eye-off)
                eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.012 10.012 0 012.825-4.375m4.35 4.35a3 3 0 014.243 4.243m2.825 2.825L21 21M3 3l3.59 3.59m0 0A9.917 9.917 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
            `;
            } else {
                passwordInput.type = 'password';
                // Kembalikan ke ikon mata terbuka
                eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            `;
            }
        }
    </script>
@endsection
