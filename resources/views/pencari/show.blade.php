{{-- resources/views/pencari/show.blade.php --}}
<x-app-layout>
<div class="min-h-screen" style="background-color: #F0F4F8;">

    {{-- NAVBAR --}}
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
                        <button type="submit" class="ml-1 p-2 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 transition-colors">
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

    {{-- HERO FOTO --}}
    <div class="relative w-full h-72 md:h-96 overflow-hidden bg-gray-200">
        @if ($kos->foto)
            <img src="{{ asset('storage/' . $kos->foto) }}"
                 alt="{{ $kos->nama }}"
                 class="w-full h-full object-cover">
        @else
            <div class="w-full h-full flex items-center justify-center"
                 style="background: linear-gradient(135deg, #EAF3FF 0%, #C2D9F5 100%);">
                <svg class="w-16 h-16" style="color: #A8CCE8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        @endif

        <div class="absolute inset-0"
             style="background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, transparent 40%, transparent 55%, rgba(0,0,0,0.6) 100%);"></div>

        {{-- Breadcrumb --}}
        <div class="absolute top-4 left-6 flex items-center gap-2 text-white/80 text-sm">
            <a href="{{ route('pencari.index') }}" class="hover:text-white transition-colors">Cari Kos</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-white font-medium line-clamp-1 max-w-xs">{{ $kos->nama }}</span>
        </div>

        {{-- Badge status --}}
        <div class="absolute top-4 right-6">
            @if ($kos->status === 'tersedia')
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-green-500 text-white shadow-md">
                    <span class="w-1.5 h-1.5 rounded-full bg-white"></span>Tersedia
                </span>
            @else
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-gray-600 text-white shadow-md">
                    <span class="w-1.5 h-1.5 rounded-full bg-white"></span>Penuh
                </span>
            @endif
        </div>

        {{-- Judul di bawah foto --}}
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
            </div>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- KOLOM KIRI: Detail (2/3) --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Info Utama --}}
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

                        <div class="h-full flex flex-col justify-center rounded-xl p-4 text-center" style="background-color: #F8FAFC;">
                            <p class="text-2xl font-extrabold text-gray-800">{{ $kos->jumlah_kamar }}</p>
                            <p class="text-xs text-gray-400 font-medium mt-0.5">Total Kamar</p>
                        </div>

                        <div class="h-full flex flex-col justify-center rounded-xl p-4 text-center" style="background-color: #F8FAFC;">
                            <p class="text-sm font-extrabold text-gray-800 leading-tight">{{ $kos->tipe ?? '-' }}</p>
                            <p class="text-xs text-gray-400 font-medium mt-0.5">Tipe Kos</p>
                        </div>
                    </div>

                    <div class="mt-5 flex items-start gap-3 p-4 rounded-xl border border-gray-100 bg-gray-50">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
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

                {{-- Deskripsi --}}
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
                        <p class="text-sm text-gray-400 italic">Pemilik belum menambahkan deskripsi.</p>
                    @endif
                </div>

                {{-- Rekomendasi Kos Lain --}}
                @if ($rekomendasi->isNotEmpty())
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h2 class="text-sm font-bold text-gray-700 mb-5 flex items-center gap-2">
                            <span class="w-5 h-5 rounded-md flex items-center justify-center text-white text-xs"
                                  style="background-color: #FF5E1F;">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                </svg>
                            </span>
                            Kos Lain di Sekitar Lokasi
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            @foreach ($rekomendasi as $r)
                                <a href="{{ route('pencari.show', $r->id) }}"
                                   class="rounded-xl overflow-hidden border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 group">
                                    <div class="aspect-video bg-gray-100 overflow-hidden">
                                        @if ($r->foto)
                                            <img src="{{ asset('storage/' . $r->foto) }}"
                                                 alt="{{ $r->nama }}"
                                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center" style="background-color: #EAF3FF;">
                                                <svg class="w-8 h-8" style="color: #A8CCE8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="p-3">
                                        <p class="font-semibold text-gray-800 text-xs line-clamp-1">{{ $r->nama }}</p>
                                        <p class="text-xs font-bold mt-1" style="color: #005EAD;">
                                            Rp {{ number_format($r->harga, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

            {{-- KOLOM KANAN: CTA & Info Pemilik (1/3) --}}
            <div class="space-y-5">

                {{-- CTA Hubungi Pemilik --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Tertarik dengan Kos Ini?</h3>

                    @if ($kos->status === 'tersedia')
                        {{-- Cek Apakah Pemilik Sudah Memasukkan Nomor WA --}}
                        @if(!empty($kos->pemilik->no_wa))
                            @php
                                $cleanWa = preg_replace('/[^0-9]/', '', $kos->pemilik->no_wa);
                                if (str_starts_with($cleanWa, '0')) {
                                    $cleanWa = '62' . substr($cleanWa, 1);
                                }
                                $pesanDetail = rawurlencode("Halo " . ($kos->pemilik->name) . ", saya melihat kos '" . $kos->nama . "' di aplikasi KosKu dan tertarik untuk menyewa. Apakah masih ada kamar kosong?");
                            @endphp
                            
                            {{-- Tombol Utama Diarahkan ke WA --}}
                            <a href="https://wa.me/{{ $cleanWa }}?text={{ $pesanDetail }}"
                               target="_blank"
                               class="w-full inline-flex items-center justify-center gap-2 py-3 px-4 rounded-xl text-white font-bold text-sm shadow transition-transform hover:scale-[1.01]"
                               style="background-color: #25D366;">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 448 512">
                                    <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
                                </svg>
                                Hubungi via WhatsApp
                            </a>
                        @else
                            {{-- Jika Akun Pemilik belum setting Nomor WA --}}
                            <div class="p-4 rounded-xl bg-green-50 border border-green-100 mb-4 text-center">
                                <p class="text-green-700 font-bold text-sm">✓ Kamar Tersedia</p>
                                <p class="text-green-500 text-xs mt-0.5">Hubungi pemilik di: {{ $kos->pemilik->email }}</p>
                            </div>
                        @endif
                    @else
                        <div class="p-4 rounded-xl bg-gray-50 border border-gray-200 mb-4 text-center">
                            <p class="text-gray-600 font-bold text-sm">✗ Kamar Penuh</p>
                            <p class="text-gray-400 text-xs mt-0.5">Coba lihat kos lain di sekitar</p>
                        </div>
                    @endif

                    {{-- Harga besar --}}
                    <div class="text-center py-3 border-y border-gray-100 my-4">
                        <p class="text-3xl font-extrabold" style="color: #005EAD;">
                            Rp {{ number_format($kos->harga, 0, ',', '.') }}
                        </p>
                        <p class="text-xs text-gray-400 mt-0.5">per bulan</p>
                    </div>

                    <a href="{{ route('pencari.index') }}"
                       class="w-full inline-flex items-center justify-center gap-2 py-2.5 rounded-xl text-sm font-semibold border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors">
                        ← Kembali Cari Kos
                    </a>
                </div>

                {{-- Info Pemilik --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Pemilik Kos</h3>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0"
                             style="background-color: #005EAD;">
                            {{ strtoupper(substr($kos->pemilik->name ?? '?', 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-bold text-gray-800">{{ $kos->pemilik->name ?? '-' }}</p>
                            <p class="text-xs text-gray-400">{{ $kos->pemilik->email ?? '-' }}</p>
                            <span class="inline-block mt-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-600">
                                Pemilik Kos
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Info Sistem --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Detail</h3>
                    <div class="space-y-2.5 text-xs">
                        @php
                            $details = [
                                ['label' => 'Tipe',         'value' => $kos->tipe ?? '-'],
                                ['label' => 'Jumlah Kamar', 'value' => $kos->jumlah_kamar . ' kamar'],
                                ['label' => 'Status',       'value' => ucfirst($kos->status)],
                                ['label' => 'Terdaftar',    'value' => $kos->created_at->isoFormat('D MMM Y')],
                            ];
                        @endphp
                        @foreach ($details as $d)
                            <div class="flex items-center justify-between">
                                <span class="text-gray-400">{{ $d['label'] }}</span>
                                <span class="font-semibold text-gray-700">{{ $d['value'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
</x-app-layout>