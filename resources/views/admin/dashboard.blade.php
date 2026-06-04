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

    {{-- ============================================================ --}}
    {{-- HERO BANNER                                                  --}}
    {{-- ============================================================ --}}
    <div class="relative overflow-hidden h-56 md:h-56 flex flex-col justify-center" 
        style="background-image: url('{{ asset('images/bgdashboard.jpg') }}'); background-size: cover; background-position: center;">
        
         <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.55) 0%, rgba(0,94,173,0.25) 100%);"></div>
        
        <div class="max-w-7xl mx-auto px-6 py-8 w-full relative z-10">
            <p class="text-gray-400 text-sm mb-1">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</p>
            <h1 class="text-white text-2xl font-extrabold">
                Panel Admin
                <span style="color: #FF5E1F;">KosKu</span>
            </h1>
            <p class="text-gray-300 text-sm mt-1">Pantau dan kelola seluruh data aplikasi dari sini.</p>
        </div>
        <div class="absolute -right-10 -top-10 w-48 h-48 rounded-full opacity-5" style="background:#fff;"></div>
        <div class="absolute bottom-0 left-0 right-0 overflow-hidden leading-none">
            <svg viewBox="0 0 1440 30" preserveAspectRatio="none" class="w-full h-8 block">
                <path d="M0,30 C360,0 1080,0 1440,30 L1440,30 L0,30 Z" fill="#F0F4F8"/>
            </svg>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- STAT CARDS                                                    --}}
    {{-- ============================================================ --}}
    <div class="max-w-7xl mx-auto px-6 -mt-14 relative z-20 mb-8">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            @php
                $stats = [
                    ['label' => 'Total User',    'value' => $totalUser - 1,'bg' => '#005EAD', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
                    ['label' => 'Pemilik Kos',   'value' => $totalPemilik, 'bg' => '#0077CC', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                    ['label' => 'Pencari Kos',   'value' => $totalPencari, 'bg' => '#0099DD', 'icon' => 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'],
                    ['label' => 'Total Kos',     'value' => $totalKos,     'bg' => '#FF5E1F', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                    ['label' => 'Kos Tersedia',  'value' => $kostersedia,  'bg' => '#16a34a', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['label' => 'Kos Penuh',     'value' => $kosPenuh,     'bg' => '#d97706', 'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'],
                ];
            @endphp
            @foreach ($stats as $stat)
                <div class="bg-white rounded-2xl p-4 shadow-lg border border-white hover:shadow-xl transition-shadow">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center mb-3 text-white" 
                         style="background-color: {{ $stat['bg'] }};">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"/>
                        </svg>
                    </div>
                    <p class="text-2xl font-extrabold text-gray-800">{{ $stat['value'] }}</p>
                    <p class="text-xs text-gray-400 font-medium mt-0.5">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- TABEL KOS TERBARU                                            --}}
    {{-- ============================================================ --}}
    <div class="max-w-7xl mx-auto px-6 pb-12">

        @if (session('success'))
            <div class="mb-5 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 flex items-center justify-between border-b border-gray-100">
                <div>
                    <h2 class="text-base font-bold text-gray-800">Kos Terbaru Ditambahkan</h2>
                    <p class="text-xs text-gray-400 mt-0.5">5 kos paling baru dari seluruh pemilik</p>
                </div>
                <a href="{{ route('admin.kos') }}"
                   class="text-sm font-semibold hover:underline" style="color: #FF5E1F;">
                    Lihat Semua →
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-xs font-semibold text-gray-400 uppercase tracking-wider"
                            style="background-color: #F8FAFC;">
                            <th class="px-6 py-3 text-left">Nama Kos</th>
                            <th class="px-6 py-3 text-left">Pemilik</th>
                            <th class="px-6 py-3 text-left">Lokasi</th>
                            <th class="px-6 py-3 text-left">Harga/Bulan</th>
                            <th class="px-6 py-3 text-center">Status</th>
                            <th class="px-6 py-3 text-center">Ditambahkan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($kosTerbaru as $kos)
                            <tr class="hover:bg-blue-50/40 transition-colors">
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
                                        <span class="text-gray-700 font-medium">{{ $kos->pemilik->name ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $kos->lokasi }}</td>
                                <td class="px-6 py-4 font-bold" style="color: #005EAD;">
                                    Rp {{ number_format($kos->harga, 0, ',', '.') }}
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
                                <td class="px-6 py-4 text-center text-xs text-gray-400">
                                    {{ $kos->created_at->diffForHumans() }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-400 text-sm">
                                    Belum ada data kos.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
</x-app-layout>