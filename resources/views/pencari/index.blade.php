{{-- resources/views/pencari/index.blade.php --}}
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
                        ['route' => 'pencari.index', 'label' => 'Cari Kos'],
                        ['route' => 'profile.edit',  'label' => 'Profil'],
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
                                class="ml-1 p-2 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 transition-colors">
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
    {{-- HERO BANNER + SEARCH BAR UTAMA                               --}}
    {{-- ============================================================ --}}
    <div class="relative overflow-hidden"
        style="background-image: url('{{ asset('images/bgdashboard.jpg') }}'); background-size: cover; background-position: center;">

        <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.55) 0%, rgba(0,94,173,0.25) 100%);"></div>
        {{-- Dekorasi --}}
        <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full opacity-10" style="background:#fff;"></div>
        <div class="absolute left-1/4 bottom-0 w-48 h-48 rounded-full opacity-5" style="background:#fff;"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 py-12 text-center">
            <p class="text-white text-sm font-medium mb-2">
                {{ $kosTersedia }} kos tersedia di Banjarmasin & sekitarnya
            </p>
            <h1 class="text-white text-3xl md:text-4xl font-extrabold leading-tight mb-2">
                Temukan Kos Impian Anda
            </h1>
            <p class="text-white text-sm mb-8">
                Halo, <span class="font-semibold text-white">{{ Auth::user()->name }}</span>! Yuk mulai cari kos yang sesuai.
            </p>

            {{-- Search bar utama --}}
            <form method="GET" action="{{ route('pencari.index') }}"
                  class="max-w-2xl mx-auto flex gap-2">
                <div class="relative flex-1">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari nama kos atau lokasi..."
                           class="w-full pl-12 pr-4 py-3.5 text-sm rounded-xl border-0 focus:outline-none focus:ring-2 shadow-lg">
                </div>
                <button type="submit"
                        class="px-6 py-3.5 rounded-xl text-white font-bold text-sm shadow-lg hover:opacity-90 transition-opacity whitespace-nowrap"
                        style="background-color: #FF5E1F;">
                    Cari Kos
                </button>
            </form>
        </div>

        {{-- Kurva bawah --}}
        <div class="absolute bottom-0 left-0 right-0 overflow-hidden leading-none">
            <svg viewBox="0 0 1440 30" preserveAspectRatio="none" class="w-full h-8 block">
                <path d="M0,30 C360,0 1080,0 1440,30 L1440,30 L0,30 Z" fill="#F0F4F8"/>
            </svg>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- FILTER BAR                                                    --}}
    {{-- ============================================================ --}}
    <div class="max-w-7xl mx-auto px-6 pt-6 pb-2">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 px-5 py-4">
            <form method="GET" action="{{ route('pencari.index') }}"
                  class="flex flex-wrap items-center gap-3">

                {{-- Pertahankan nilai search saat filter diubah --}}
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif

                <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Filter:</span>

                {{-- Tipe --}}
                <select name="tipe" onchange="this.form.submit()"
                        class="text-sm border border-gray-200 rounded-xl px-3 py-2 pr-10 focus:outline-none text-gray-600 bg-white">
                    <option value="">Semua Tipe</option>
                    <option value="Kos Putra"  {{ request('tipe') === 'Kos Putra'  ? 'selected' : '' }}>Kos Putra</option>
                    <option value="Kos Putri"  {{ request('tipe') === 'Kos Putri'  ? 'selected' : '' }}>Kos Putri</option>
                    <option value="Kos Campur" {{ request('tipe') === 'Kos Campur' ? 'selected' : '' }}>Kos Campur</option>
                </select>

                {{-- Status --}}
                <select name="status" onchange="this.form.submit()"
                        class="text-sm border border-gray-200 rounded-xl px-3 py-2 pr-10 focus:outline-none text-gray-600 bg-white">
                    <option value="">Semua Status</option>
                    <option value="tersedia" {{ request('status') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="penuh"    {{ request('status') === 'penuh'    ? 'selected' : '' }}>Penuh</option>
                </select>

                {{-- Harga Maksimal --}}
                <select name="harga_max" onchange="this.form.submit()"
                        class="text-sm border border-gray-200 rounded-xl px-3 py-2 pr-10 focus:outline-none text-gray-600 bg-white">
                    <option value="">Semua Harga</option>
                    <option value="500000"  {{ request('harga_max') == '500000'  ? 'selected' : '' }}>Maks Rp 500rb</option>
                    <option value="1000000" {{ request('harga_max') == '1000000' ? 'selected' : '' }}>Maks Rp 1jt</option>
                    <option value="1500000" {{ request('harga_max') == '1500000' ? 'selected' : '' }}>Maks Rp 1,5jt</option>
                    <option value="2000000" {{ request('harga_max') == '2000000' ? 'selected' : '' }}>Maks Rp 2jt</option>
                </select>

                {{-- Info hasil --}}
                <span class="text-xs text-gray-400 ml-auto">
                    Menampilkan <span class="font-semibold text-gray-600">{{ $kosList->total() }}</span> kos
                </span>

                @if(request()->hasAny(['search','tipe','status','harga_max']))
                    <a href="{{ route('pencari.index') }}"
                       class="text-xs font-semibold px-3 py-1.5 rounded-lg text-gray-500 bg-gray-100 hover:bg-gray-200 transition-colors">
                        Reset Filter
                    </a>
                @endif

            </form>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- GRID KOS                                                      --}}
    {{-- ============================================================ --}}
    <div class="max-w-7xl mx-auto px-6 py-6 pb-12">

        @if ($kosList->isEmpty())
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 py-20 flex flex-col items-center gap-4 text-center">
                <div class="w-20 h-20 rounded-full flex items-center justify-center" style="background-color: #EAF3FF;">
                    <svg class="w-10 h-10" style="color: #005EAD;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-gray-700">Kos tidak ditemukan</p>
                    <p class="text-sm text-gray-400 mt-1">Coba ubah kata kunci atau filter pencarian.</p>
                </div>
                <a href="{{ route('pencari.index') }}"
                   class="px-5 py-2.5 rounded-xl text-sm font-semibold text-white"
                   style="background-color: #005EAD;">
                    Lihat Semua Kos
                </a>
            </div>

        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ($kosList as $kos)
                    <a href="{{ route('pencari.show', $kos->id) }}"
                       class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 flex flex-col group">

                        {{-- Foto --}}
                        <div class="relative aspect-video bg-gray-100 overflow-hidden">
                            @if ($kos->foto)
                                <img src="{{ asset('storage/' . $kos->foto) }}"
                                     alt="{{ $kos->nama }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
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
                                    <span class="inline-flex items-center gap-1 gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-green-500 text-white shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white"></span>Tersedia
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-gray-500 text-white shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white"></span>Penuh
                                    </span>
                                @endif
                            </div>

                            {{-- Badge Tipe --}}
                            @if ($kos->tipe)
                                <div class="absolute top-3 right-3">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold text-white"
                                          style="background-color: rgba(0,94,173,0.85);">
                                        {{ $kos->tipe }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        {{-- Info Detail Kos --}}
                        <div class="p-5 flex flex-col flex-1">
                            <h3 class="font-bold text-gray-800 text-base leading-snug line-clamp-1 mb-1 group-hover:text-blue-700 transition-colors">
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

                            {{-- Pemilik & Tombol WhatsApp --}}
                            <div class="flex items-center gap-2 pt-3 border-t border-gray-100 mt-auto">
                                <div class="w-6 h-6 rounded-full flex items-center justify-center text-white text-xs font-bold flex-shrink-0"
                                     style="background-color: #005EAD;">
                                    {{ strtoupper(substr($kos->pemilik->name ?? '?', 0, 1)) }}
                                </div>
                                <span class="text-xs text-gray-400">
                                    oleh <span class="font-semibold text-gray-600">{{ $kos->pemilik->name ?? '-' }}</span>
                                </span>

                                {{-- Deteksi & Tampilkan Ikon WA melayang kecil --}}
                                @if(!empty($kos->pemilik->no_wa))
                                    @php
                                        $cleanWa = preg_replace('/[^0-9]/', '', $kos->pemilik->no_wa);
                                        if (str_starts_with($cleanWa, '0')) {
                                            $cleanWa = '62' . substr($cleanWa, 1);
                                        }
                                        $pesanDefault = rawurlencode("Halo " . ($kos->pemilik->name) . ", saya tertarik dengan '" . $kos->nama . "' yang terdaftar di KosKu.");
                                    @endphp
                                    <object>
                                        <a href="https://wa.me/{{ $cleanWa }}?text={{ $pesanDefault }}" 
                                           target="_blank"
                                           class="inline-flex items-center align-middle ml-1.5 p-0.5 rounded-lg text-gray-400 hover:bg-green-50 transition-all duration-200 group/wa"
                                           title="Hubungi via WhatsApp"
                                           style="line-height: 0;">
                                            {{-- SVG diatur ukurannya dan dikunci posisinya --}}
                                            <svg class="w-5 h-5 text-[#25D366] block transition-transform group-hover/wa:scale-110" fill="currentColor" viewBox="0 0 448 512">
                                                <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
                                            </svg>
                                        </a>
                                    </object>
                                @endif

                                <span class="ml-auto text-xs font-semibold text-orange-500 group-hover:underline">
                                    Detail →
                                </span>
                            </div>
                        </div>
                    </a>
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