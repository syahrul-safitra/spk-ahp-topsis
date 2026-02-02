<!DOCTYPE html>
<html lang="id" data-theme="light">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield("title", "Dashboard Admin")</title>
        @vite("resources/css/app.css")
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>

    @php
        $user = auth()->user();
    @endphp

    <body class="bg-[#F1F5F9] text-slate-700 antialiased">
        <div class="drawer lg:drawer-open">
            <input id="sidebar-drawer" type="checkbox" class="drawer-toggle" />

            <div class="drawer-content flex flex-col">
                <header
                    class="sticky top-0 z-30 flex h-20 w-full items-center justify-between border-b border-slate-200/50 bg-white/80 px-8 backdrop-blur-md">
                    <div class="flex items-center gap-4">
                        <label for="sidebar-drawer" class="btn btn-ghost btn-circle lg:hidden">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </label>
                        <h1 class="text-xl font-semibold tracking-tight">Dashboard Overview</h1>
                    </div>

                    <div class="flex items-center gap-6">
                        <div class="hidden flex-col text-right md:flex">
                            <span class="text-sm font-bold">{{ $user->name }}</span>

                            <span
                                class="text-primary text-[11px] font-medium uppercase tracking-widest">{{ $user->is_admin == 1 ? "Admin" : "Staff" }}</span>
                        </div>
                        <div class="avatar shadow-lg ring ring-white">
                            <div class="avatar placeholder">
                                <div class="w-11 rounded-xl bg-slate-800 text-white shadow-inner">
                                    <svg viewBox="0 0 100 100" class="h-full w-full">
                                        <path d="M0 0 L100 100 L100 0 Z" fill="white" fill-opacity="0.05" />
                                        <text x="50%" y="50%" dominant-baseline="central" text-anchor="middle"
                                            class="fill-current font-black" style="font-size: 40px;">
                                            {{ strtoupper(substr(Auth::user()->name ?? "Admin", 0, 2)) }}
                                        </text>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <main class="p-8">
                    @yield("content")
                </main>
            </div>

            <div class="drawer-side z-40">
                <label for="sidebar-drawer" class="drawer-overlay"></label>
                <aside class="flex min-h-full w-72 flex-col border-r border-slate-100 bg-white px-6 py-8">

                    <div class="mb-10 flex items-center gap-3 px-2">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-500 text-white shadow-lg shadow-indigo-200">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-black uppercase tracking-tighter text-slate-800">SPK<span
                                class="text-indigo-600">Smart</span></span>
                    </div>

                    <ul class="menu w-full gap-2 p-0 font-medium text-slate-600">
                        <li class="menu-title mb-2 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">
                            Menu Utama
                        </li>

                        {{-- DASHBOARD --}}
                        <li>
                            <a href="{{ url("/") }}"
                                class="{{ Request::is("/") ? "bg-indigo-50 text-indigo-600 shadow-sm shadow-indigo-100" : "hover:bg-indigo-50 hover:text-indigo-600" }} group flex gap-4 rounded-xl px-4 py-3 transition-all">
                                <svg class="{{ Request::is("/") ? "text-indigo-600" : "text-slate-400 group-hover:text-indigo-600" }} h-5 w-5"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h3">
                                    </path>
                                </svg>
                                Dashboard
                            </a>
                        </li>

                        @if ($user->is_admin)
                            {{-- METODE AHP --}}
                            <li>
                                <details
                                    {{ Request::is("criteria*", "comparison-matrix*", "ahp-test*") ? "open" : "" }}>
                                    <summary
                                        class="{{ Request::is("criteria*", "comparison-matrix*", "ahp-test*") ? "text-indigo-600 font-bold" : "" }} group flex gap-4 rounded-xl px-4 py-3 transition-all hover:bg-slate-50">
                                        <svg class="{{ Request::is("criteria*", "comparison-matrix*", "ahp-test*") ? "text-indigo-600" : "text-slate-400 group-hover:text-indigo-600" }} h-5 w-5"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                            </path>
                                        </svg>
                                        <span class="flex-1">Metode AHP</span>
                                    </summary>
                                    <ul class="ml-4 mt-2 gap-1 border-l border-slate-100">
                                        <li>
                                            <a href="{{ url("/criteria") }}"
                                                class="{{ Request::is("criteria*") ? "text-indigo-600 font-bold" : "hover:text-indigo-600" }} rounded-lg px-6 py-2 text-sm transition-all">
                                                Data Kriteria
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url("/comparison-matrix") }}"
                                                class="{{ Request::is("comparison-matrix*") ? "text-indigo-600 font-bold" : "hover:text-indigo-600" }} rounded-lg px-6 py-2 text-sm transition-all">
                                                Matriks Perbandingan
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url("/ahp-test") }}"
                                                class="{{ Request::is("ahp-test*") ? "bg-indigo-50 text-indigo-600 font-bold" : "hover:text-indigo-600" }} rounded-lg px-6 py-2 text-sm transition-all">
                                                Hasil Bobot
                                            </a>
                                        </li>
                                    </ul>
                                </details>
                            </li>
                        @endif

                        {{-- METODE TOPSIS --}}
                        <li>
                            <details {{ Request::is("alternative*", "ranking*") ? "open" : "" }}>
                                <summary
                                    class="{{ Request::is("alternative*", "ranking*") ? "text-indigo-600 font-bold" : "" }} group flex gap-4 rounded-xl px-4 py-3 transition-all hover:bg-slate-50">
                                    <svg class="{{ Request::is("alternative*", "ranking*") ? "text-indigo-600" : "text-slate-400 group-hover:text-indigo-600" }} h-5 w-5"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                    <span class="flex-1">Metode Topsis</span>
                                </summary>
                                <ul class="ml-4 mt-2 gap-1 border-l border-slate-100">
                                    <li>
                                        <a href="{{ url("/alternative") }}"
                                            class="{{ Request::is("alternative*") ? "text-indigo-600 font-bold" : "hover:text-indigo-600" }} rounded-lg px-6 py-2 text-sm transition-all">
                                            Data Alternatif
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url("/ranking") }}"
                                            class="{{ Request::is("ranking*") ? "bg-indigo-50 text-indigo-600 font-bold" : "hover:text-indigo-600" }} rounded-lg px-6 py-2 text-sm transition-all">
                                            Ranking
                                        </a>
                                    </li>
                                </ul>
                            </details>
                        </li>

                        @if ($user->is_admin)
                            <li>
                                <a href="{{ url("user") }}"
                                    class="{{ Request::is("user*") ? "bg-indigo-50 text-indigo-600 shadow-sm shadow-indigo-100" : "hover:bg-indigo-50 hover:text-indigo-600" }} group flex gap-4 rounded-xl px-4 py-3 transition-all">
                                    <svg class="{{ Request::is("user*") ? "text-indigo-600" : "text-slate-400 group-hover:text-indigo-600" }} h-5 w-5"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                        </path>
                                    </svg>
                                    <span class="font-bold">User</span>
                                </a>
                            </li>
                        @endif

                        <li
                            class="menu-title mb-2 mt-6 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">
                            Lainnya</li>
                        <li>
                            <form action="{{ url("logout") }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="text-error group flex w-full gap-4 rounded-xl px-4 py-3 transition-all hover:bg-red-50">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>

                    <div class="mt-auto rounded-2xl border border-slate-100/50 bg-slate-50 p-4">
                        <p class="text-[10px] font-medium text-slate-400">Sistem Informasi SPK</p>
                        <p class="text-xs font-bold uppercase text-slate-700">v1.0.4 - 2024</p>
                    </div>
                </aside>
            </div>
        </div>
    </body>

</html>
