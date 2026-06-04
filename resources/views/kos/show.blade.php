{{-- resources/views/kos/show.blade.php --}}
<x-app-layout>
<div class="min-h-screen" style="background-color: #F0F4F8;">

    {{-- ============================================================ --}}
    {{-- TOP NAVBAR                                                    --}}
    {{-- ============================================================ --}}
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background-color: #005EAD;">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <span class="font-extrabold text-lg tracking-tight" style="color: #005EAD;">KosKu</span>
            </div>

            <div class="flex items-center gap-1">
                @php
                    $navLinks = [
                        ['route' => 'dashboard',   'label' => 'Dashboard'],
                        ['route' => 'kos.index',   'label' => 'Kos Saya'],
                        ['route' => 'kos.create',  'label' => 'Tambah Kos'],
                        ['route' => 'profile.edit','label' => 'Pengaturan'],
                    ];
                @endphp
                @foreach ($navLinks as $link)
                    @php $active = request()->routeIs($link['route']); @endphp
                    <a href="{{ route($link['route']) }}"
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-150
                              {{ $active ? 'text-white' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-100' }}"
                       @if($active) style="background-color: #005EAD;" @endif>
                        {{ $link['label'] }}
                    </a>
                @endforeach
                <span class="mx-2 h-5 w-px bg-gray-200"></span>
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-xs font-bold"
                         style="background-color: #FF5E1F;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="text-sm font-semibold text-gray-700 hidden md:block">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                                class="ml-1 p-2 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 transition-colors"
                                title="Keluar">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    {{-- ============================================================ --}}
    {{-- HERO FOTO                                                     --}}
    {{-- ============================================================ --}}
    <div class="relative w-full h-72 md:h-96 overflow-hidden bg-gray-200">

        @if ($kos->foto)
            <img src="{{ asset('storage/' . $kos->foto) }}"
                 alt="{{ $kos->nama }}"
                 class="w-full h-full object-cover">
        @else
            {{-- Placeholder kalau tidak ada foto --}}
            <div class="w-full h-full flex flex-col items-center justify-center gap-3"
                 style="background: linear-gradient(135deg, #EAF3FF 0%, #C2D9F5 100%);">
                <svg class="w-16 h-16" style="color: #A8CCE8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-sm font-medium" style="color: #7AAFD4;">Belum ada foto</p>
            </div>
        @endif

        {{-- Overlay gradient bawah agar teks breadcrumb terbaca --}}
        <div class="absolute inset-0"
             style="background: linear-gradient(to bottom, rgba(0,0,0,0.35) 0%, transparent 40%, transparent 60%, rgba(0,0,0,0.55) 100%);"></div>

        {{-- Breadcrumb di atas foto --}}
        <div class="absolute top-4 left-6 flex items-center gap-2 text-white/80 text-sm flex-wrap">
            <a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('kos.index') }}" class="hover:text-white transition-colors">Kos Saya</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-white font-medium line-clamp-1 max-w-xs">{{ $kos->nama }}</span>
        </div>

        {{-- Badge status di atas foto --}}
        <div class="absolute top-4 right-6">
            @if ($kos->status === 'tersedia')
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-green-500 text-white shadow-md">
                    <span class="w-1.5 h-1.5 rounded-full bg-white inline-block"></span>
                    Tersedia
                </span>
            @else
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-amber-500 text-white shadow-md">
                    <span class="w-1.5 h-1.5 rounded-full bg-white inline-block"></span>
                    Penuh
                </span>
            @endif
        </div>

        {{-- Nama kos di bawah foto (overlay) --}}
        <div class="absolute bottom-5 left-6 right-6">
            <div class="flex items-end justify-between gap-4 flex-wrap">
                <div>
                    @if ($kos->tipe)
                        <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold text-white mb-2"
                              style="background-color: rgba(0,94,173,0.85);">
                            {{ $kos->tipe }}
                        </span>
                    @endif
                    <h1 class="text-white text-2xl md:text-3xl font-extrabold leading-tight drop-shadow-md">
                        {{ $kos->nama }}
                    </h1>
                    <div class="flex items-center gap-1.5 text-white/80 text-sm mt-1">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $kos->lokasi }}
                    </div>
                </div>

                {{-- Tombol aksi di hero --}}
                <div class="flex items-center gap-2 flex-shrink-0">
                    <a href="{{ route('kos.edit', $kos->id) }}"
                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-white text-sm font-semibold shadow-lg hover:opacity-90 transition-opacity"
                       style="background-color: #FF5E1F;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Kos
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- MAIN CONTENT                                                  --}}
    {{-- ============================================================ --}}
    <div class="max-w-7xl mx-auto px-6 py-8">

        {{-- Flash message --}}
        @if (session('success'))
            <div class="mb-6 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ================================================ --}}
            {{-- KOLOM KIRI: Info Detail (2/3)                    --}}
            {{-- ================================================ --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Card Informasi Utama --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-sm font-bold text-gray-700 mb-5 flex items-center gap-2">
                        <span class="w-5 h-5 rounded-md flex items-center justify-center text-white text-xs"
                              style="background-color: #005EAD;">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </span>
                        Informasi Kos
                    </h2>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                        {{-- Harga --}}
                        <div class="col-span-2 rounded-xl p-4 flex items-center gap-3"
                             style="background-color: #EAF3FF;">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                                 style="background-color: #005EAD;">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Harga per Bulan</p>
                                <p class="text-xl font-extrabold leading-tight" style="color: #005EAD;">
                                    Rp {{ number_format($kos->harga, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                        {{-- Jumlah Kamar --}}
                        <div class="rounded-xl p-4 text-center" style="background-color: #F8FAFC;">
                            <p class="text-2xl font-extrabold text-gray-800">{{ $kos->jumlah_kamar }}</p>
                            <p class="text-xs text-gray-400 font-medium mt-0.5">Total Kamar</p>
                        </div>

                        {{-- Tipe --}}
                        <div class="rounded-xl p-4 text-center" style="background-color: #F8FAFC;">
                            <p class="text-sm font-extrabold text-gray-800 leading-tight">
                                {{ $kos->tipe ?? '-' }}
                            </p>
                            <p class="text-xs text-gray-400 font-medium mt-0.5">Tipe Kos</p>
                        </div>

                    </div>

                    {{-- Lokasi lengkap --}}
                    <div class="mt-5 flex items-start gap-3 p-4 rounded-xl border border-gray-100 bg-gray-50">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5"
                             style="background-color: #FFE8DF;">
                            <svg class="w-4 h-4" style="color: #FF5E1F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 mb-0.5">Alamat Lengkap</p>
                            <p class="text-sm text-gray-700 font-medium">{{ $kos->lokasi }}</p>
                        </div>
                    </div>
                </div>

                {{-- Card Deskripsi --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-sm font-bold text-gray-700 mb-4 flex items-center gap-2">
                        <span class="w-5 h-5 rounded-md flex items-center justify-center text-white text-xs"
                              style="background-color: #005EAD;">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h7"/>
                            </svg>
                        </span>
                        Deskripsi
                    </h2>

                    @if ($kos->deskripsi)
                        <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-line">{{ $kos->deskripsi }}</p>
                    @else
                        <div class="flex items-center gap-2 text-gray-400 text-sm py-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            Belum ada deskripsi.
                            <a href="{{ route('kos.edit', $kos->id) }}"
                               class="font-semibold hover:underline" style="color: #FF5E1F;">
                                Tambahkan sekarang →
                            </a>
                        </div>
                    @endif
                </div>

                {{-- Card Info Tambahan --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-sm font-bold text-gray-700 mb-4 flex items-center gap-2">
                        <span class="w-5 h-5 rounded-md flex items-center justify-center text-white text-xs"
                              style="background-color: #005EAD;">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </span>
                        Rincian Data
                    </h2>

                    <div class="divide-y divide-gray-50">
                        @php
                            $details = [
                                ['label' => 'ID Properti',     'value' => '#' . str_pad($kos->id, 4, '0', STR_PAD_LEFT)],
                                ['label' => 'Nama Kos',        'value' => $kos->nama],
                                ['label' => 'Tipe',            'value' => $kos->tipe ?? '-'],
                                ['label' => 'Lokasi',          'value' => $kos->lokasi],
                                ['label' => 'Harga/Bulan',     'value' => 'Rp ' . number_format($kos->harga, 0, ',', '.')],
                                ['label' => 'Jumlah Kamar',    'value' => $kos->jumlah_kamar . ' kamar'],
                                ['label' => 'Status',          'value' => ucfirst($kos->status)],
                                ['label' => 'Ditambahkan',     'value' => $kos->created_at->isoFormat('D MMMM Y, HH:mm')],
                                ['label' => 'Terakhir Diubah', 'value' => $kos->updated_at->isoFormat('D MMMM Y, HH:mm')],
                            ];
                        @endphp

                        @foreach ($details as $detail)
                            <div class="flex items-center justify-between py-3 text-sm">
                                <span class="text-gray-400 font-medium w-36 flex-shrink-0">{{ $detail['label'] }}</span>
                                <span class="text-gray-700 font-semibold text-right">{{ $detail['value'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            {{-- ================================================ --}}
            {{-- KOLOM KANAN: Aksi & Status (1/3)                 --}}
            {{-- ================================================ --}}
            <div class="space-y-5">

                {{-- Card Status Visual --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Status Properti</h3>

                    @if ($kos->status === 'tersedia')
                        <div class="flex items-center gap-3 p-4 rounded-xl bg-green-50 border border-green-100">
                            <div class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-green-700">Tersedia</p>
                                <p class="text-xs text-green-500 mt-0.5">Kamar siap dihuni</p>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-3 p-4 rounded-xl bg-amber-50 border border-amber-100">
                            <div class="w-10 h-10 rounded-full bg-amber-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-amber-700">Penuh</p>
                                <p class="text-xs text-amber-500 mt-0.5">Semua kamar terisi</p>
                            </div>
                        </div>
                    @endif

                    {{-- Ganti status cepat --}}
                    <form action="{{ route('kos.update', $kos->id) }}" method="POST" class="mt-3">
                        @csrf
                        @method('PUT')
                        {{-- Kirim semua field wajib agar validasi tidak gagal --}}
                        <input type="hidden" name="nama"         value="{{ $kos->nama }}">
                        <input type="hidden" name="tipe"         value="{{ $kos->tipe }}">
                        <input type="hidden" name="lokasi"       value="{{ $kos->lokasi }}">
                        <input type="hidden" name="harga"        value="{{ $kos->harga }}">
                        <input type="hidden" name="jumlah_kamar" value="{{ $kos->jumlah_kamar }}">
                        <input type="hidden" name="deskripsi"    value="{{ $kos->deskripsi }}">
                        <input type="hidden" name="status"
                               value="{{ $kos->status === 'tersedia' ? 'penuh' : 'tersedia' }}">
                        <button type="submit"
                                class="w-full py-2.5 rounded-xl text-sm font-semibold border transition-colors
                                       {{ $kos->status === 'tersedia'
                                           ? 'text-amber-600 border-amber-200 hover:bg-amber-50'
                                           : 'text-green-600 border-green-200 hover:bg-green-50' }}">
                            Tandai sebagai "{{ $kos->status === 'tersedia' ? 'Penuh' : 'Tersedia' }}"
                        </button>
                    </form>
                </div>

                {{-- Card Tombol Aksi --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 space-y-3">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Kelola Kos</h3>

                    <a href="{{ route('kos.edit', $kos->id) }}"
                       class="w-full inline-flex items-center justify-center gap-2 py-2.5 rounded-xl text-white text-sm font-semibold hover:opacity-90 transition-opacity"
                       style="background-color: #FF5E1F;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Informasi Kos
                    </a>

                    <a href="{{ route('kos.index') }}"
                       class="w-full inline-flex items-center justify-center gap-2 py-2.5 rounded-xl text-sm font-semibold border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                        Kembali ke Daftar Kos
                    </a>

                    <div class="pt-1 border-t border-gray-100">
                        <form action="{{ route('kos.destroy', $kos->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus kos \'{{ addslashes($kos->nama) }}\' secara permanen?\n\nTindakan ini tidak dapat dibatalkan.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full inline-flex items-center justify-center gap-2 py-2.5 rounded-xl text-sm font-semibold text-red-500 border border-red-100 hover:bg-red-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus Kos Ini
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Card Meta --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Informasi Sistem</h3>
                    <div class="space-y-3 text-xs text-gray-500">
                        <div class="flex items-center justify-between">
                            <span>ID Properti</span>
                            <span class="font-mono font-bold text-gray-700">
                                #{{ str_pad($kos->id, 4, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>Ditambahkan</span>
                            <span class="font-semibold text-gray-700">
                                {{ $kos->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>Diperbarui</span>
                            <span class="font-semibold text-gray-700">
                                {{ $kos->updated_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
</x-app-layout>