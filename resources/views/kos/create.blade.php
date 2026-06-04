{{-- resources/views/kos/create.blade.php --}}
<x-app-layout>
<div class="min-h-screen" style="background-color: #F0F4F8;">

    {{-- ============================================================ --}}
    {{-- TOP NAVBAR (sama persis dengan dashboard)                    --}}
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
                        <button type="submit" class="ml-1 p-2 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 transition-colors" title="Keluar">
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
    {{-- PAGE HEADER                                                  --}}
    {{-- ============================================================ --}}
    <div class="relative overflow-hidden"
        style="background-image: url('{{ asset('images/bgdashboard.jpg') }}'); background-size: cover; background-position: center;">
        <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.55) 0%, rgba(0,94,173,0.25) 100%);"></div>
        <div class="max-w-7xl mx-auto px-6 py-8 relative z-10">
            <div class="flex items-center gap-2 text-white/70 text-sm mb-2">
                <a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('kos.index') }}" class="hover:text-white transition-colors">Kos Saya</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white font-medium">Tambah Kos</span>
            </div>
            <h1 class="text-white text-2xl font-extrabold">Tambah Kos Baru</h1>
            <p class="text-white/80 text-sm mt-1">Isi informasi properti kos Anda dengan lengkap dan akurat.</p>
        </div>
        <div class="absolute bottom-0 left-0 right-0 overflow-hidden leading-none">
            <svg viewBox="0 0 1440 40" preserveAspectRatio="none" class="w-full h-10 block text-[#F0F4F8] fill-current">
                <path d="M0,40 C360,0 1080,0 1440,40 L1440,40 L0,40 Z"></path>
            </svg>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- FORM                                                         --}}
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

        <form action="{{ route('kos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- ================================================ --}}
                {{-- KOLOM KIRI: Upload Foto (1/3)                    --}}
                {{-- ================================================ --}}
                <div class="lg:col-span-1 space-y-5">

                    {{-- Card Upload Foto --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                        <h3 class="text-sm font-bold text-gray-700 mb-4 flex items-center gap-2">
                            <span class="w-5 h-5 rounded-md flex items-center justify-center text-white text-xs" style="background-color: #005EAD;">1</span>
                            Foto Kos
                        </h3>

                        {{-- Preview Area --}}
                        <div id="preview-area"
                             class="relative w-full aspect-video rounded-xl overflow-hidden border-2 border-dashed border-gray-200 bg-gray-50 flex items-center justify-center cursor-pointer hover:border-blue-400 hover:bg-blue-50/30 transition-all duration-200 mb-4"
                             onclick="document.getElementById('foto-input').click()">

                            {{-- Placeholder --}}
                            <div id="preview-placeholder" class="flex flex-col items-center gap-2 text-gray-400 pointer-events-none">
                                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-xs font-medium">Klik untuk upload foto</span>
                                <span class="text-xs text-gray-300">JPG, PNG — maks. 2MB</span>
                            </div>

                            {{-- Preview Gambar --}}
                            <img id="preview-img"
                                 src="#"
                                 alt="Preview"
                                 class="absolute inset-0 w-full h-full object-cover hidden">

                            {{-- Overlay ganti foto --}}
                            <div id="preview-overlay"
                                 class="absolute inset-0 bg-black/40 hidden items-center justify-center rounded-xl">
                                <span class="text-white text-xs font-semibold bg-black/30 px-3 py-1 rounded-full">Ganti Foto</span>
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

                        <p class="text-xs text-gray-400 text-center mt-2">Foto berkualitas baik meningkatkan kepercayaan pencari kos.</p>
                    </div>

                    {{-- Card Tips --}}
                    <div class="rounded-2xl p-5 border" style="background-color: #EAF3FF; border-color: #C2D9F5;">
                        <h4 class="text-xs font-bold mb-3 flex items-center gap-1.5" style="color: #005EAD;">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            Tips Pengisian
                        </h4>
                        <ul class="text-xs space-y-2" style="color: #3A7CBF;">
                            <li class="flex items-start gap-2">
                                <span class="mt-0.5 w-1 h-1 rounded-full flex-shrink-0" style="background:#005EAD;"></span>
                                Gunakan nama kos yang mudah diingat dan ditemukan.
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="mt-0.5 w-1 h-1 rounded-full flex-shrink-0" style="background:#005EAD;"></span>
                                Tulis lokasi lengkap agar pencari kos mudah menemukan.
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="mt-0.5 w-1 h-1 rounded-full flex-shrink-0" style="background:#005EAD;"></span>
                                Harga yang tertera adalah harga per bulan.
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="mt-0.5 w-1 h-1 rounded-full flex-shrink-0" style="background:#005EAD;"></span>
                                Pilih status sesuai ketersediaan kamar saat ini.
                            </li>
                        </ul>
                    </div>

                </div>

                {{-- ================================================ --}}
                {{-- KOLOM KANAN: Detail Kos (2/3)                    --}}
                {{-- ================================================ --}}
                <div class="lg:col-span-2 space-y-5">

                    {{-- Card Informasi Umum --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-sm font-bold text-gray-700 mb-5 flex items-center gap-2">
                            <span class="w-5 h-5 rounded-md flex items-center justify-center text-white text-xs" style="background-color: #005EAD;">2</span>
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
                                    value="{{ old('nama') }}"
                                    placeholder="Contoh: Kos Putri Melati Banjarmasin"
                                    class="w-full px-4 py-2.5 text-sm border rounded-xl focus:outline-none focus:ring-2 transition
                                            {{ $errors->has('nama') ? 'border-red-400 bg-red-50 focus:ring-red-400' : 'border-gray-200 focus:ring-[#005EAD]' }}">
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
                                        class="w-full px-4 py-2.5 text-sm border rounded-xl focus:outline-none focus:ring-2 transition
                                               {{ $errors->has('tipe') ? 'border-red-400 bg-red-50' : 'border-gray-200' }} text-gray-700">
                                    <option value="" disabled {{ old('tipe') ? '' : 'selected' }}>Pilih tipe...</option>
                                    <option value="Kos Putra"  {{ old('tipe') === 'Kos Putra'  ? 'selected' : '' }}>Kos Putra</option>
                                    <option value="Kos Putri"  {{ old('tipe') === 'Kos Putri'  ? 'selected' : '' }}>Kos Putri</option>
                                    <option value="Kos Campur" {{ old('tipe') === 'Kos Campur' ? 'selected' : '' }}>Kos Campur</option>
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
                                        class="w-full px-4 py-2.5 text-sm border rounded-xl focus:outline-none focus:ring-2 transition
                                               {{ $errors->has('status') ? 'border-red-400 bg-red-50' : 'border-gray-200' }} text-gray-700">
                                    <option value="" disabled {{ old('status') ? '' : 'selected' }}>Pilih status...</option>
                                    <option value="tersedia" {{ old('status') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                    <option value="penuh"    {{ old('status') === 'penuh'    ? 'selected' : '' }}>Penuh</option>
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
                            <span class="w-5 h-5 rounded-md flex items-center justify-center text-white text-xs" style="background-color: #005EAD;">3</span>
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
                                           value="{{ old('lokasi') }}"
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
                                           value="{{ old('harga') }}"
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
                                           value="{{ old('jumlah_kamar') }}"
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
                            <span class="w-5 h-5 rounded-md flex items-center justify-center text-white text-xs" style="background-color: #005EAD;">4</span>
                            Deskripsi (Opsional)
                        </h3>
                        <textarea name="deskripsi"
                                  rows="4"
                                  placeholder="Ceritakan fasilitas kos, aturan, akses transportasi, dll..."
                                  class="w-full px-4 py-3 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 resize-none transition text-gray-700">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex items-center justify-end gap-3">
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
                            Simpan Kos
                        </button>
                    </div>

                </div>
            </div>

        </form>
    </div>

</div>

{{-- ================================================================ --}}
{{-- SCRIPT: Live Preview Foto                                        --}}
{{-- ================================================================ --}}
<script>
function previewFoto(input) {
    const previewImg         = document.getElementById('preview-img');
    const previewPlaceholder = document.getElementById('preview-placeholder');
    const previewOverlay     = document.getElementById('preview-overlay');
    const previewArea        = document.getElementById('preview-area');

    if (input.files && input.files[0]) {
        const file = input.files[0];

        // Validasi ukuran di sisi klien (maks 2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal 2MB.');
            input.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            previewImg.src = e.target.result;
            previewImg.classList.remove('hidden');
            previewPlaceholder.classList.add('hidden');

            // Hover overlay aktif
            previewArea.addEventListener('mouseenter', () => {
                previewOverlay.classList.remove('hidden');
                previewOverlay.classList.add('flex');
            });
            previewArea.addEventListener('mouseleave', () => {
                previewOverlay.classList.add('hidden');
                previewOverlay.classList.remove('flex');
            });
        };
        reader.readAsDataURL(file);
    }
}
</script>

</x-app-layout>