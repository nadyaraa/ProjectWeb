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
                <div>
                    <span class="font-extrabold text-lg tracking-tight" style="color: #005EAD;">KosKu</span>
                    <span class="ml-2 px-2 py-0.5 rounded-md text-xs font-bold text-white" style="background-color: #FF5E1F;">ADMIN</span>
                </div>
            </div>
            <div class="flex items-center gap-1">
                @php
                    $navLinks = [
                        ['route' => 'admin.dashboard', 'label' => 'Dashboard'],
                        ['route' => 'admin.users',     'label' => 'Kelola User'],
                        ['route' => 'admin.kos',       'label' => 'Kelola Kos'],
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

    {{-- PAGE HEADER --}}
    <div class="relative overflow-hidden" 
        style="background-image: url('{{ asset('images/bgdashboard.jpg') }}'); background-size: cover; background-position: center;">
        <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.55) 0%, rgba(0,94,173,0.25) 100%);"></div>

        <div class="max-w-7xl mx-auto px-6 py-8 relative z-10">
            <div class="flex items-center gap-2 text-gray-400 text-sm mb-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-white font-medium">Kelola Kos</span>
            </div>
            <h1 class="text-white text-2xl font-extrabold">Kelola Semua Kos</h1>
            <p class="text-gray-300 text-sm mt-1">
                Total <span class="font-bold text-white">{{ $kosList->total() }}</span> kos dari seluruh pemilik
            </p>
        </div>
        <div class="absolute bottom-0 left-0 right-0 overflow-hidden leading-none">
            <svg viewBox="0 0 1440 30" preserveAspectRatio="none" class="w-full h-8 block">
                <path d="M0,30 C360,0 1080,0 1440,30 L1440,30 L0,30 Z" fill="#F0F4F8"/>
            </svg>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="max-w-7xl mx-auto px-6 py-6 pb-12">

        @if (session('success'))
            <div class="mb-5 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">

            {{-- Toolbar --}}
            <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-gray-100">
                <div>
                    <h2 class="text-base font-bold text-gray-800">Semua Data Kos</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Kos dari seluruh pemilik yang terdaftar</p>
                </div>
                <form method="GET" action="{{ route('admin.kos') }}"
                      class="flex items-center gap-3 flex-wrap">
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Cari nama atau lokasi..."
                               class="pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-xl w-52 focus:outline-none focus:ring-2 transition">
                    </div>
                    <select name="status" onchange="this.form.submit()"
                            class="text-sm border border-gray-200 rounded-xl px-3 py-2 pr-10 focus:outline-none text-gray-600">
                        <option value="">Semua Status</option>
                        <option value="tersedia" {{ request('status') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="penuh"    {{ request('status') === 'penuh'    ? 'selected' : '' }}>Penuh</option>
                    </select>
                    <button type="submit"
                            class="px-4 py-2 rounded-xl text-white text-sm font-semibold hover:opacity-90 transition-opacity"
                            style="background-color: #005EAD;">
                        Cari
                    </button>
                    @if(request()->hasAny(['search','status']))
                        <a href="{{ route('admin.kos') }}"
                           class="px-4 py-2 rounded-xl text-sm font-semibold text-gray-500 bg-gray-100 hover:bg-gray-200 transition-colors">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-xs font-semibold text-gray-400 uppercase tracking-wider"
                            style="background-color: #F8FAFC;">
                            <th class="px-6 py-3 text-left">Foto</th>
                            <th class="px-6 py-3 text-left">Nama Kos</th>
                            <th class="px-6 py-3 text-left">Pemilik</th>
                            <th class="px-6 py-3 text-left">Lokasi</th>
                            <th class="px-6 py-3 text-left">Harga/Bulan</th>
                            <th class="px-6 py-3 text-center">Kamar</th>
                            <th class="px-6 py-3 text-center">Status</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($kosList as $kos)
                            <tr class="hover:bg-blue-50/40 transition-colors">
                                <td class="px-6 py-4">
                                    @if ($kos->foto)
                                        <img src="{{ asset('storage/' . $kos->foto) }}"
                                             alt="{{ $kos->nama }}"
                                             class="w-14 h-14 rounded-xl object-cover border border-gray-200">
                                    @else
                                        <div class="w-14 h-14 rounded-xl flex items-center justify-center"
                                             style="background-color: #E8F1FB;">
                                            <svg class="w-6 h-6" style="color: #005EAD;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-semibold text-gray-800">{{ $kos->nama }}</p>
                                    <p class="text-xs text-gray-400">{{ $kos->tipe ?? 'Kos Umum' }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full flex items-center justify-center text-white text-xs font-bold flex-shrink-0"
                                             style="background-color: #005EAD;">
                                            {{ strtoupper(substr($kos->pemilik->name ?? '?', 0, 1)) }}
                                        </div>
                                        <span class="text-gray-600 text-xs">{{ $kos->pemilik->name ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600 text-xs">{{ $kos->lokasi }}</td>
                                <td class="px-6 py-4 font-bold" style="color: #005EAD;">
                                    Rp {{ number_format($kos->harga, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center text-gray-700 font-semibold">
                                    {{ $kos->jumlah_kamar }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if ($kos->status === 'tersedia')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>Tersedia
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>Penuh
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <form action="{{ route('admin.kos.destroy', $kos->id) }}" method="POST"
                                          onsubmit="return confirm('Hapus kos \'{{ addslashes($kos->nama) }}\'?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="p-2 rounded-lg text-red-400 hover:bg-red-50 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-10 text-center text-gray-400 text-sm">
                                    Tidak ada data kos yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($kosList->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $kosList->withQueryString()->links() }}
                </div>
            @endif

        </div>
    </div>
</div>
</x-app-layout>