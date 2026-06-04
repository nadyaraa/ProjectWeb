{{-- resources/views/kos/index.blade.php --}}
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
    {{-- PAGE HEADER                                                   --}}
    {{-- ============================================================ --}}
    <div class="relative overflow-hidden"
        style="background-image: url('{{ asset('images/bgdashboard.jpg') }}'); background-size: cover; background-position: center;">
        
        <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.55) 0%, rgba(0,94,173,0.25) 100%);"></div>
        <div class="max-w-7xl mx-auto px-6 py-8 relative z-10">
            <div class="flex items-start justify-between flex-wrap gap-4">
                <div>
                    <div class="flex items-center gap-2 text-white/70 text-sm mb-2">
                        <a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <span class="text-white font-medium">Kos Saya</span>
                    </div>
                    <h1 class="text-white text-2xl font-extrabold">Kos Saya</h1>
                    <p class="text-white/80 text-sm mt-1">Total <span class="font-bold text-white">{{ $kosList->total() }}</span> properti terdaftar</p>
                </div>
                <a href="{{ route('kos.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-white text-sm font-semibold shadow-lg hover:opacity-90 transition-opacity self-end" style="background-color: #FF5E1F;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Kos Baru
                </a>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 overflow-hidden leading-none">
            <svg viewBox="0 0 1440 40" preserveAspectRatio="none" class="w-full h-10 block text-[#F0F4F8] fill-current">
                <path d="M0,40 C360,0 1080,0 1440,40 L1440,40 L0,40 Z"></path>
            </svg>
        </div>
    </div>
    {{-- ============================================================ --}}
    {{-- FILTER & SEARCH BAR                                          --}}
    {{-- ============================================================ --}}
    <div class="max-w-7xl mx-auto px-6 pt-6 pb-2">

        {{-- Flash Message --}}
        @if (session('success'))
            <div class="mb-5 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 px-5 py-4">
            <form method="GET" action="{{ route('kos.index') }}"
                  class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">

                {{-- Search --}}
                <div class="relative flex-1">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari nama kos atau lokasi..."
                           class="w-full pl-9 pr-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 transition">
                </div>

                {{-- Filter Tipe --}}
                <select name="tipe"
                        class="px-4 py-2.5 text-sm border border-gray-200 rounded-xl pr-10 focus:outline-none text-gray-600 bg-white">
                    <option value="">Semua Tipe</option>
                    <option value="Kos Putra"  {{ request('tipe') === 'Kos Putra'  ? 'selected' : '' }}>Kos Putra</option>
                    <option value="Kos Putri"  {{ request('tipe') === 'Kos Putri'  ? 'selected' : '' }}>Kos Putri</option>
                    <option value="Kos Campur" {{ request('tipe') === 'Kos Campur' ? 'selected' : '' }}>Kos Campur</option>
                </select>

                {{-- Filter Status --}}
                <select name="status"
                        class="px-4 py-2.5 text-sm border border-gray-200 rounded-xl pr-10 focus:outline-none text-gray-600 bg-white">
                    <option value="">Semua Status</option>
                    <option value="tersedia" {{ request('status') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="penuh"    {{ request('status') === 'penuh'    ? 'selected' : '' }}>Penuh</option>
                </select>

                {{-- Tombol --}}
                <button type="submit"
                        class="px-5 py-2.5 rounded-xl text-white text-sm font-semibold hover:opacity-90 transition-opacity"
                        style="background-color: #005EAD;">
                    Cari
                </button>

                @if(request()->hasAny(['search', 'tipe', 'status']))
                    <a href="{{ route('kos.index') }}"
                       class="px-5 py-2.5 rounded-xl text-sm font-semibold text-gray-500 bg-gray-100 hover:bg-gray-200 transition-colors text-center">
                        Reset
                    </a>
                @endif

            </form>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- KOS CARD GRID                                                --}}
    {{-- ============================================================ --}}
    <div class="max-w-7xl mx-auto px-6 py-6 pb-12">

        @if ($kosList->isEmpty())
            {{-- Empty State --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 py-20 flex flex-col items-center gap-4 text-center">
                <div class="w-20 h-20 rounded-full flex items-center justify-center" style="background-color: #EAF3FF;">
                    <svg class="w-10 h-10" style="color: #005EAD;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                @if(request()->hasAny(['search', 'tipe', 'status']))
                    <div>
                        <p class="font-bold text-gray-700">Tidak ada hasil yang cocok</p>
                        <p class="text-sm text-gray-400 mt-1">Coba ubah kata kunci atau filter pencarian Anda.</p>
                    </div>
                    <a href="{{ route('kos.index') }}"
                       class="px-5 py-2.5 rounded-xl text-sm font-semibold text-white"
                       style="background-color: #005EAD;">
                        Lihat Semua Kos
                    </a>
                @else
                    <div>
                        <p class="font-bold text-gray-700">Belum ada kos yang terdaftar</p>
                        <p class="text-sm text-gray-400 mt-1">Mulai tambahkan properti kos pertama Anda sekarang.</p>
                    </div>
                    <a href="{{ route('kos.create') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-white text-sm font-semibold"
                       style="background-color: #FF5E1F;">
                        + Tambah Kos Pertama
                    </a>
                @endif
            </div>

        @else
            {{-- Grid Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ($kosList as $kos)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-300 flex flex-col">

                        {{-- Foto --}}
                        <div class="relative aspect-video bg-gray-100 overflow-hidden">
                            @if ($kos->foto)
                                <img src="{{ asset('storage/' . $kos->foto) }}"
                                     alt="{{ $kos->nama }}"
                                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center" style="background-color: #EAF3FF;">
                                    <svg class="w-12 h-12" style="color: #A8CCE8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif

                            {{-- Badge Status --}}
                            <div class="absolute top-3 left-3">
                                @if ($kos->status === 'tersedia')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-green-500 text-white shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white inline-block"></span>
                                        Tersedia
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-500 text-white shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white inline-block"></span>
                                        Penuh
                                    </span>
                                @endif
                            </div>

                            {{-- Badge Tipe --}}
                            @if ($kos->tipe)
                                <div class="absolute top-3 right-3">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold text-white shadow-sm"
                                          style="background-color: rgba(0,94,173,0.85);">
                                        {{ $kos->tipe }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="p-5 flex flex-col flex-1">
                            <h3 class="font-bold text-gray-800 text-base leading-snug line-clamp-1 mb-1">
                                {{ $kos->nama }}
                            </h3>

                            <div class="flex items-center gap-1.5 text-gray-400 text-xs mb-3">
                                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="line-clamp-1">{{ $kos->lokasi }}</span>
                            </div>

                            {{-- Harga & Kamar --}}
                            <div class="flex items-end justify-between mb-4">
                                <div>
                                    <p class="text-xl font-extrabold leading-none" style="color: #005EAD;">
                                        Rp {{ number_format($kos->harga, 0, ',', '.') }}
                                    </p>
                                    <p class="text-xs text-gray-400 mt-0.5">per bulan</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-gray-700">{{ $kos->jumlah_kamar }}</p>
                                    <p class="text-xs text-gray-400">kamar</p>
                                </div>
                            </div>

                            {{-- Deskripsi singkat --}}
                            @if ($kos->deskripsi)
                                <p class="text-xs text-gray-400 line-clamp-2 mb-4 flex-1">{{ $kos->deskripsi }}</p>
                            @else
                                <div class="flex-1"></div>
                            @endif

                            {{-- Tombol Aksi --}}
                            <div class="flex items-center gap-2 pt-3 border-t border-gray-100">
                                <a href="{{ route('kos.show', $kos->id) }}"
                                   class="flex-1 text-center py-2 rounded-xl text-sm font-semibold border transition-colors text-gray-600 border-gray-200 hover:bg-gray-50">
                                    Detail
                                </a>
                                <a href="{{ route('kos.edit', $kos->id) }}"
                                   class="flex-1 text-center py-2 rounded-xl text-sm font-semibold text-white transition-opacity hover:opacity-90"
                                   style="background-color: #005EAD;">
                                    Edit
                                </a>
                                <form action="{{ route('kos.destroy', $kos->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus \'{{ addslashes($kos->nama) }}\'?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="p-2 rounded-xl border border-red-100 text-red-400 hover:bg-red-50 hover:border-red-200 transition-colors"
                                            title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if ($kosList->hasPages())
                <div class="mt-8 flex justify-center">
                    {{ $kosList->withQueryString()->links() }}
                </div>
            @endif

        @endif

    </div>

</div>
</x-app-layout>