{{-- resources/views/kos/edit.blade.php --}}
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
    <div class="relative overflow-hidden" style="background: linear-gradient(135deg, #004F99 0%, #0077CC 100%);">
        <div class="max-w-7xl mx-auto px-6 py-8 relative z-10">
            <div class="flex items-start justify-between flex-wrap gap-4">
                <div>
                    {{-- Breadcrumb --}}
                    <div class="flex items-center gap-2 text-blue-200 text-sm mb-2 flex-wrap">
                        <a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <a href="{{ route('kos.index') }}" class="hover:text-white transition-colors">Kos Saya</a>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <span class="text-white font-medium line-clamp-1 max-w-xs">{{ $kos->nama }}</span>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <span class="text-white font-medium">Edit</span>
                    </div>
                    <h1 class="text-white text-2xl font-extrabold">Edit Kos</h1>
                    <p class="text-blue-100 text-sm mt-1">
                        Perbarui informasi untuk
                        <span class="font-semibold text-white">{{ $kos->nama }}</span>
                    </p>
                </div>

                {{-- Tombol lihat detail --}}
                <a href="{{ route('kos.show', $kos->id) }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold border border-white/30 text-white hover:bg-white/10 transition-colors self-end">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Lihat Detail
                </a>
            </div>
        </div>
        <div class="absolute -right-10 -top-10 w-48 h-48 rounded-full opacity-10" style="background:#fff;"></div>
        <div class="absolute right-24 -bottom-8 w-32 h-32 rounded-full opacity-10" style="background:#fff;"></div>
        <div class="absolute bottom-0 left-0 right-0 overflow-hidden leading-none">
            <svg viewBox="0 0 1440 30" preserveAspectRatio="none" class="w-full h-8 block">
                <path d="M0,30 C360,0 1080,0 1440,30 L1440,30 L0,30 Z" fill="#F0F4F8"/>
            </svg>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- FORM EDIT                                                     --}}
    {{-- ============================================================ --}}
    <div class="max-w-7xl mx-auto px-6 py-8">

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-xl px-5 py-4">
                <div class="flex items-center gap-2 text-red-700 font-semibold text-sm mb-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    Mohon perbaiki kesalahan berikut:
                </div>
                <ul class="list-disc list-inside text-red-600 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kos.update', $kos->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- ================================================ --}}
                {{-- KOLOM KIRI: Foto                                 --}}
                {{-- ================================================ --}}
                <div class="lg:col-span-1 space-y-5">

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                        <h3 class="text-sm font-bold text-gray-700 mb-4 flex items-center gap-2">
                            <span class="w-5 h-5 rounded-md flex items-center justify-center text-white text-xs"
                                  style="background-color: #005EAD;">1</span>
                            Foto Kos
                        </h3>

                        {{-- Preview Area --}}
                        <div id="preview-area"
                             class="relative w-full aspect-video rounded-xl overflow-hidden border-2 border-dashed border-gray-200 bg-gray-50 flex items-center justify-center cursor-pointer hover:border-blue-400 hover:bg-blue-50/30 transition-all duration-200 mb-3"
                             onclick="document.getElementById('foto-input').click()">

                            {{-- Placeholder (tampil kalau tidak ada foto sama sekali) --}}
                            <div id="preview-placeholder"
                                 class="flex flex-col items-center gap-2 text-gray-400 pointer-events-none
                                        {{ $kos->foto ? 'hidden' : '' }}">
                                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-xs font-medium">Klik untuk upload foto</span>
                                <span class="text-xs text-gray-300">JPG, PNG — maks. 2MB</span>
                            </div>

                            {{-- Foto yang sudah ada / preview baru --}}
                            <img id="preview-img"
                                 src="{{ $kos->foto ? asset('storage/' . $kos->foto) : '#' }}"
                                 alt="Preview foto kos"
                                 class="absolute inset-0 w-full h-full object-cover
                                        {{ $kos->foto ? '' : 'hidden' }}">

                            {{-- Overlay ganti foto --}}
                            <div id="preview-overlay"
                                 class="absolute inset-0 bg-black/40 hidden items-center justify-center rounded-xl">
                                <div class="flex flex-col items-center gap-1">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-white text-xs font-semibold">Ganti Foto</span>
                                </div>
                            </div>
                        </div>

                        <input type="file"
                               id="foto-input"
                               name="foto"
                               accept="image/*"
                               class="hidden"
                               onchange="previewFoto(this)">

                        @error('foto')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        {{-- Info foto lama --}}
                        @if ($kos->foto)
                            <div id="foto-lama-info"
                                 class="mt-3 flex items-center gap-2 text-xs text-gray-400 bg-gray-50 rounded-lg px-3 py-2">
                                <svg class="w-3.5 h-3.5 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span id="foto-lama-text">Foto saat ini tersimpan. Pilih file baru untuk mengganti.</span>
                            </div>
                        @else
                            <p class="text-xs text-gray-400 text-center mt-2">JPG, PNG, WebP — maks. 2MB.</p>
                        @endif

                        {{-- Tombol hapus foto (hanya muncul kalau ada foto) --}}
                        @if ($kos->foto)
                            <div class="mt-3 flex items-center gap-2">
                                <input type="hidden" name="hapus_foto" id="hapus-foto-input" value="0">
                                <button type="button"
                                        id="btn-hapus-foto"
                                        onclick="toggleHapusFoto()"
                                        class="w-full py-2 rounded-xl text-xs font-semibold border border-red-200 text-red-400 hover:bg-red-50 transition-colors">
                                    Hapus Foto
                                </button>
                            </div>
                        @endif
                    </div>

                    {{-- Info perubahan --}}
                    <div class="rounded-2xl p-5 border" style="background-color: #FFF8F5; border-color: #FFD6C2;">
                        <h4 class="text-xs font-bold mb-3 flex items-center gap-1.5" style="color: #FF5E1F;">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            Perhatian
                        </h4>
                        <ul class="text-xs space-y-2" style="color: #C04A1A;">
                            <li class="flex items-start gap-2">
                                <span class="mt-0.5 w-1 h-1 rounded-full flex-shrink-0 mt-1.5" style="background:#FF5E1F;"></span>
                                Perubahan akan langsung tersimpan setelah klik Simpan Perubahan.
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="mt-0.5 w-1 h-1 rounded-full flex-shrink-0 mt-1.5" style="background:#FF5E1F;"></span>
                                Mengganti foto akan menghapus foto lama secara permanen.
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="mt-0.5 w-1 h-1 rounded-full flex-shrink-0 mt-1.5" style="background:#FF5E1F;"></span>
                                Kosongkan field foto jika tidak ingin mengganti foto yang ada.
                            </li>
                        </ul>
                    </div>

                </div>

                {{-- ================================================ --}}
                {{-- KOLOM KANAN: Detail Kos                         --}}
                {{-- ================================================ --}}
                <div class="lg:col-span-2 space-y-5">

                    {{-- Card Informasi Umum --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-sm font-bold text-gray-700 mb-5 flex items-center gap-2">
                            <span class="w-5 h-5 rounded-md flex items-center justify-center text-white text-xs"
                                  style="background-color: #005EAD;">2</span>
                            Informasi Umum
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                            {{-- Nama Kos --}}
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                                    Nama Kos <span class="text-red-400">*</span>
                                </label>
                                <input type="text"
                                       name="nama"
                                       value="{{ old('nama', $kos->nama) }}"
                                       placeholder="Contoh: Kos Putri Melati Banjarmasin"
                                       class="w-full px-4 py-2.5 text-sm border rounded-xl focus:outline-none focus:ring-2 transition
                                              {{ $errors->has('nama') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                                @error('nama')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tipe Kos --}}
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                                    Tipe Kos <span class="text-red-400">*</span>
                                </label>
                                <select name="tipe"
                                        class="w-full px-4 py-2.5 text-sm border rounded-xl focus:outline-none focus:ring-2 transition text-gray-700
                                               {{ $errors->has('tipe') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                                    @foreach (['Kos Putra', 'Kos Putri', 'Kos Campur'] as $tipe)
                                        <option value="{{ $tipe }}"
                                                {{ old('tipe', $kos->tipe) === $tipe ? 'selected' : '' }}>
                                            {{ $tipe }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tipe')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                                    Status <span class="text-red-400">*</span>
                                </label>
                                <select name="status"
                                        class="w-full px-4 py-2.5 text-sm border rounded-xl focus:outline-none focus:ring-2 transition text-gray-700
                                               {{ $errors->has('status') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                                    @foreach (['tersedia' => 'Tersedia', 'penuh' => 'Penuh'] as $val => $label)
                                        <option value="{{ $val }}"
                                                {{ old('status', $kos->status) === $val ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    {{-- Card Lokasi & Harga --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-sm font-bold text-gray-700 mb-5 flex items-center gap-2">
                            <span class="w-5 h-5 rounded-md flex items-center justify-center text-white text-xs"
                                  style="background-color: #005EAD;">3</span>
                            Lokasi & Harga
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                            {{-- Lokasi --}}
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                                    Lokasi <span class="text-red-400">*</span>
                                </label>
                                <div class="relative">
                                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <input type="text"
                                           name="lokasi"
                                           value="{{ old('lokasi', $kos->lokasi) }}"
                                           placeholder="Contoh: Jl. Ahmad Yani KM.5, Banjarmasin Timur"
                                           class="w-full pl-10 pr-4 py-2.5 text-sm border rounded-xl focus:outline-none focus:ring-2 transition
                                                  {{ $errors->has('lokasi') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                                </div>
                                @error('lokasi')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Harga --}}
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                                    Harga per Bulan (Rp) <span class="text-red-400">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-medium pointer-events-none">Rp</span>
                                    <input type="number"
                                           name="harga"
                                           value="{{ old('harga', $kos->harga) }}"
                                           placeholder="500000"
                                           min="0"
                                           class="w-full pl-10 pr-4 py-2.5 text-sm border rounded-xl focus:outline-none focus:ring-2 transition
                                                  {{ $errors->has('harga') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                                </div>
                                @error('harga')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Jumlah Kamar --}}
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                                    Jumlah Kamar <span class="text-red-400">*</span>
                                </label>
                                <div class="relative">
                                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                                    </svg>
                                    <input type="number"
                                           name="jumlah_kamar"
                                           value="{{ old('jumlah_kamar', $kos->jumlah_kamar) }}"
                                           placeholder="10"
                                           min="1"
                                           class="w-full pl-10 pr-4 py-2.5 text-sm border rounded-xl focus:outline-none focus:ring-2 transition
                                                  {{ $errors->has('jumlah_kamar') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                                </div>
                                @error('jumlah_kamar')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    {{-- Card Deskripsi --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-sm font-bold text-gray-700 mb-5 flex items-center gap-2">
                            <span class="w-5 h-5 rounded-md flex items-center justify-center text-white text-xs"
                                  style="background-color: #005EAD;">4</span>
                            Deskripsi (Opsional)
                        </h3>
                        <textarea name="deskripsi"
                                  rows="4"
                                  placeholder="Ceritakan fasilitas kos, aturan, akses transportasi, dll..."
                                  class="w-full px-4 py-3 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 resize-none transition text-gray-700">{{ old('deskripsi', $kos->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex items-center justify-between gap-3 flex-wrap">

                        {{-- Kiri: Tombol hapus kos (Ubah jadi BUTTON biasa dengan atribut form) --}}
                        <button type="submit" form="form-hapus-kos"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold text-red-500 border border-red-200 hover:bg-red-50 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Hapus Kos Ini
                        </button>

                        {{-- Kanan: Batal + Simpan --}}
                        <div class="flex items-center gap-3">
                            <a href="{{ route('kos.index') }}"
                               class="px-6 py-2.5 rounded-xl text-sm font-semibold text-gray-600 bg-white border border-gray-200 hover:bg-gray-50 transition-colors">
                                Batal
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-white text-sm font-semibold shadow hover:opacity-90 transition-opacity"
                                    style="background-color: #FF5E1F;">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form> {{-- <-- FORM UTAMA (EDIT) DITUTUP DI SINI --}}

        {{-- FORM HAPUS DITARUH DI SINI (Di luar form utama) --}}
        <form id="form-hapus-kos" action="{{ route('kos.destroy', $kos->id) }}" method="POST"
              onsubmit="return confirm('Yakin ingin menghapus kos \'{{ addslashes($kos->nama) }}\' secara permanen?')" class="hidden">
            @csrf
            @method('DELETE')
        </form>

                </div>
            </div>

        </form>
    </div>

</div>

{{-- ================================================================ --}}
{{-- SCRIPT                                                           --}}
{{-- ================================================================ --}}
<script>
// ---- Preview foto baru ----
function previewFoto(input) {
    const previewImg         = document.getElementById('preview-img');
    const previewPlaceholder = document.getElementById('preview-placeholder');
    const previewArea        = document.getElementById('preview-area');
    const fotoLamaInfo       = document.getElementById('foto-lama-info');

    if (input.files && input.files[0]) {
        if (input.files[0].size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal 2MB.');
            input.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            previewImg.src = e.target.result;
            previewImg.classList.remove('hidden');
            previewPlaceholder.classList.add('hidden');

            if (fotoLamaInfo) {
                fotoLamaInfo.innerHTML = `
                    <svg class="w-3.5 h-3.5 flex-shrink-0 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-orange-500 font-medium">Foto baru dipilih. Simpan untuk mengganti.</span>
                `;
            }

            // Batalkan hapus foto kalau user pilih foto baru
            const hapusInput = document.getElementById('hapus-foto-input');
            if (hapusInput) hapusInput.value = '0';
            const btnHapus = document.getElementById('btn-hapus-foto');
            if (btnHapus) btnHapus.textContent = 'Hapus Foto';
        };
        reader.readAsDataURL(input.files[0]);

        // Hover overlay
        previewArea.addEventListener('mouseenter', () => {
            document.getElementById('preview-overlay').classList.remove('hidden');
            document.getElementById('preview-overlay').classList.add('flex');
        });
        previewArea.addEventListener('mouseleave', () => {
            document.getElementById('preview-overlay').classList.add('hidden');
            document.getElementById('preview-overlay').classList.remove('flex');
        });
    }
}

// ---- Toggle hapus foto lama ----
function toggleHapusFoto() {
    const hapusInput   = document.getElementById('hapus-foto-input');
    const previewImg   = document.getElementById('preview-img');
    const placeholder  = document.getElementById('preview-placeholder');
    const fotoLamaInfo = document.getElementById('foto-lama-info');
    const btnHapus     = document.getElementById('btn-hapus-foto');
    const fotoFileInput = document.getElementById('foto-input');

    const akanDihapus = hapusInput.value === '0';

    if (akanDihapus) {
        // Tandai untuk dihapus
        hapusInput.value = '1';
        previewImg.classList.add('hidden');
        placeholder.classList.remove('hidden');
        fotoFileInput.value = '';
        btnHapus.textContent = 'Batalkan Hapus';
        btnHapus.classList.remove('text-red-400', 'border-red-200', 'hover:bg-red-50');
        btnHapus.classList.add('text-green-600', 'border-green-200', 'hover:bg-green-50');
        fotoLamaInfo.innerHTML = `
            <svg class="w-3.5 h-3.5 flex-shrink-0 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <span class="text-red-500 font-medium">Foto akan dihapus saat disimpan.</span>
        `;
    } else {
        // Batalkan hapus
        hapusInput.value = '0';
        previewImg.src = "{{ $kos->foto ? asset('storage/' . $kos->foto) : '#' }}";
        previewImg.classList.remove('hidden');
        placeholder.classList.add('hidden');
        btnHapus.textContent = 'Hapus Foto';
        btnHapus.classList.add('text-red-400', 'border-red-200', 'hover:bg-red-50');
        btnHapus.classList.remove('text-green-600', 'border-green-200', 'hover:bg-green-50');
        fotoLamaInfo.innerHTML = `
            <svg class="w-3.5 h-3.5 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span>Foto saat ini tersimpan. Pilih file baru untuk mengganti.</span>
        `;
    }
}
</script>

</x-app-layout>