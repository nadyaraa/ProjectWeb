{{-- resources/views/dashboard/pemilik.blade.php --}}
<x-app-layout>
<div class="min-h-screen bg-[#F0F4F8]">

    {{-- ============================================================ --}}
    {{-- TOP NAVBAR                                                   --}}
    {{-- ============================================================ --}}
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">

            {{-- Logo Kiri --}}
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-[#005EAD]">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <span class="font-extrabold text-lg tracking-tight text-[#005EAD]">KosKu</span>
            </div>

            {{-- Menu Kanan --}}
            <div class="flex items-center gap-1">
                @php
                    $navLinks = [
                        ['route' => 'dashboard',   'label' => 'Dashboard'],
                        ['route' => 'kos.index',   'label' => 'Kos Saya'],
                        ['route' => 'kos.create',  'label' => 'Tambah Kos'],
                        ['route' => 'profile.edit', 'label' => 'Pengaturan'],
                    ];
                @endphp

                @foreach ($navLinks as $link)
                    @php $active = request()->routeIs($link['route']); @endphp
                    <a href="{{ route($link['route']) }}"
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-150 
                              {{ $active 
                                  ? 'bg-[#005EAD] text-white' 
                                  : 'text-gray-500 hover:text-gray-800 hover:bg-gray-100' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach

                {{-- Divider --}}
                <span class="mx-2 h-5 w-px bg-gray-200"></span>

                {{-- Profil + Logout --}}
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-xs font-bold flex-shrink-0 bg-[#FF5E1F]">
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
    {{-- HERO BANNER                                                  --}}
    {{-- ============================================================ --}}
    <div class="relative h-56 md:h-64 overflow-visible"
         style="background-image: url('{{ asset('images/bgdashboard.jpg') }}'); background-size: cover; background-position: center;">
        
         <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.55) 0%, rgba(0,94,173,0.25) 100%);"></div>

        {{-- Teks Selamat Datang --}}
        <div class="relative z-10 max-w-7xl mx-auto px-6 h-full flex flex-col justify-center">
            <p class="text-white text-sm font-medium mb-1">
                {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}
            </p>
            <h1 class="text-white text-2xl md:text-3xl font-extrabold leading-tight">
                Selamat Datang, <span class="text-[#FFD580]">{{ Auth::user()->name }}</span>
            </h1>
            <p class="text-white text-sm mt-1.5">
                Kelola properti kos Anda dengan mudah dari satu tempat.
            </p>
        </div>

        {{-- Kurva bawah --}}
        <div class="absolute bottom-0 left-0 right-0 overflow-hidden leading-none">
            <svg viewBox="0 0 1440 40" preserveAspectRatio="none" class="w-full h-10 block text-[#F0F4F8] fill-current">
                <path d="M0,40 C360,0 1080,0 1440,40 L1440,40 L0,40 Z"></path>
            </svg>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- FLOATING STAT CARDS                                          --}}
    {{-- ============================================================ --}}
    <div class="max-w-7xl mx-auto px-6 -mt-14 relative z-20 mb-8">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">

            @php
                $stats = [
                    [
                        'label'   => 'Total Properti',
                        'value'   => $totalProperti ?? 0,
                        'sub'     => 'kos terdaftar',
                        'bg_class'=> 'bg-[#005EAD]',
                        'icon'    => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                    ],
                    [
                        'label'   => 'Total Pengunjung',
                        'value'   => $totalPengunjung ?? 0,
                        'sub'     => 'bulan ini',
                        'bg_class'=> 'bg-[#0099DD]',
                        'icon'    => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z',
                    ],
                    [
                        'label'   => 'Kos Tersedia',
                        'value'   => $kamarTersedia ?? 0,
                        'sub'     => 'siap dihuni',
                        'bg_class'=> 'bg-[#FF5E1F]',
                        'icon'    => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                    ],
                ];
            @endphp

            @foreach ($stats as $stat)
                <div class="bg-white rounded-2xl p-5 shadow-lg hover:shadow-xl transition-shadow duration-300 flex items-center gap-4 border border-white">
                    <div class="w-14 h-14 rounded-xl flex items-center justify-center flex-shrink-0 text-white {{ $stat['bg_class'] }}">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-3xl font-extrabold text-gray-800 leading-none">{{ $stat['value'] }}</p>
                        <p class="text-sm font-semibold text-gray-500 mt-0.5">{{ $stat['label'] }}</p>
                        <p class="text-xs text-gray-400">{{ $stat['sub'] }}</p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- MAIN CONTENT: TABEL CRUD                                     --}}
    {{-- ============================================================ --}}
    <div class="max-w-7xl mx-auto px-6 pb-12">

        {{-- Flash Message --}}
        @if (session('success'))
            <div class="mb-5 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">

            {{-- ---- Table Toolbar ---- --}}
            <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-gray-100">
                <div>
                    <h2 class="text-base font-bold text-gray-800">Daftar Kos Saya</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Kelola semua properti kos Anda</p>
                </div>

                <div class="flex items-center gap-3 flex-wrap">
                    {{-- Search Bar --}}
                    <form method="GET" action="{{ route('dashboard') }}" class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari nama atau lokasi..."
                               class="pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-xl w-56 focus:outline-none focus:ring-2 focus:ring-[#005EAD] focus:border-transparent transition">
                    </form>

                    {{-- Filter Status --}}
                    <form method="GET" action="{{ route('dashboard') }}">
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        <select name="status"
                                onchange="this.form.submit()"
                                class="text-sm border border-gray-200 rounded-xl px-3 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-[#005EAD] text-gray-600">
                            <option value="">Semua Status</option>
                            <option value="tersedia" {{ request('status') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="penuh"    {{ request('status') === 'penuh'    ? 'selected' : '' }}>Penuh</option>
                        </select>
                    </form>

                    {{-- Tombol Tambah --}}
                    <a href="{{ route('kos.create') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-white text-sm font-semibold shadow bg-[#FF5E1F] hover:opacity-90 transition-opacity whitespace-nowrap">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Kos
                    </a>
                </div>
            </div>

            {{-- ---- Table ---- --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-xs font-semibold text-gray-400 uppercase tracking-wider bg-[#F8FAFC]">
                            <th class="px-6 py-3 text-left">Foto</th>
                            <th class="px-6 py-3 text-left">Nama Kos</th>
                            <th class="px-6 py-3 text-left">Lokasi</th>
                            <th class="px-6 py-3 text-left">Harga/Bulan</th>
                            <th class="px-6 py-3 text-center">Kamar</th>
                            <th class="px-6 py-3 text-center">Status</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($kosList ?? [] as $kos)
                            <tr class="hover:bg-blue-50/40 transition-colors duration-150">

                                {{-- Foto --}}
                                <td class="px-6 py-4">
                                    @if ($kos->foto)
                                        <img src="{{ asset('storage/' . $kos->foto) }}"
                                             alt="{{ $kos->nama }}"
                                             class="w-14 h-14 rounded-xl object-cover border border-gray-200">
                                    @else
                                        <div class="w-14 h-14 rounded-xl flex items-center justify-center bg-[#E8F1FB]">
                                            <svg class="w-6 h-6 text-[#005EAD]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </td>

                                {{-- Nama --}}
                                <td class="px-6 py-4">
                                    <p class="font-semibold text-gray-800">{{ $kos->nama }}</p>
                                    <p class="text-xs text-gray-400">{{ $kos->tipe ?? 'Kos Umum' }}</p>
                                </td>

                                {{-- Lokasi --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-1.5 text-gray-600">
                                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ $kos->lokasi }}
                                    </div>
                                </td>

                                {{-- Harga --}}
                                <td class="px-6 py-4">
                                    <span class="font-bold text-[#005EAD]">
                                        Rp {{ number_format($kos->harga, 0, ',', '.') }}
                                    </span>
                                </td>

                                {{-- Jumlah Kamar --}}
                                <td class="px-6 py-4 text-center">
                                    <span class="font-semibold text-gray-700">{{ $kos->jumlah_kamar }}</span>
                                    <span class="text-gray-400 text-xs"> kamar</span>
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-4 text-center">
                                    @if ($kos->status === 'tersedia')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 inline-block"></span>
                                            Tersedia
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 inline-block"></span>
                                            Penuh
                                        </span>
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <a href="{{ route('kos.show', $kos->id) }}"
                                           class="p-2 rounded-lg text-blue-500 hover:bg-blue-50 transition-colors" title="Detail">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('kos.edit', $kos->id) }}"
                                           class="p-2 rounded-lg hover:bg-orange-50 transition-colors text-[#FF5E1F]" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('kos.destroy', $kos->id) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus kos ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="p-2 rounded-lg text-red-400 hover:bg-red-50 transition-colors" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center gap-3 text-gray-400">
                                        <svg class="w-14 h-14 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                        <p class="text-sm font-medium">Belum ada kos yang terdaftar</p>
                                        <a href="{{ route('kos.create') }}"
                                           class="mt-1 inline-flex items-center gap-2 px-4 py-2 rounded-xl text-white text-sm font-semibold bg-[#FF5E1F]">
                                            + Tambah Kos Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if (isset($kosList) && $kosList->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $kosList->links() }}
                </div>
            @endif

        </div>
    </div>

</div>
</x-app-layout>