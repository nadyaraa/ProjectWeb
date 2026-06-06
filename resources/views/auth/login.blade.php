{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — KosKu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background-color: #F0F4F8;" class="min-h-screen flex flex-col">

    {{-- ============================================================ --}}
    {{-- NAVBAR MINIMAL                                               --}}
    {{-- ============================================================ --}}
    <nav class="bg-white shadow-sm">
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
            <a href="{{ route('register') }}"
               class="text-sm font-semibold px-4 py-2 rounded-xl border transition-colors text-gray-600 border-gray-200 hover:bg-gray-50">
                Daftar Akun
            </a>
        </div>
    </nav>

    {{-- ============================================================ --}}
    {{-- HERO SPLIT LAYOUT                                            --}}
    {{-- ============================================================ --}}
    <div class="flex flex-1">

        {{-- Kiri: Ilustrasi (hanya tampil di layar besar) --}}
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden flex-col items-center justify-center p-12"
             style="background: linear-gradient(135deg, #004F99 0%, #0077CC 100%);">

            {{-- Dekorasi lingkaran --}}
            <div class="absolute -top-16 -left-16 w-64 h-64 rounded-full opacity-10" style="background:#fff;"></div>
            <div class="absolute -bottom-20 -right-20 w-80 h-80 rounded-full opacity-10" style="background:#fff;"></div>
            <div class="absolute top-1/2 left-1/4 w-32 h-32 rounded-full opacity-5" style="background:#fff;"></div>

            {{-- Konten ilustrasi --}}
            <div class="relative z-10 text-center">
                <div class="w-24 h-24 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-2xl"
                     style="background-color: rgba(255,255,255,0.15);">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>

                <h2 class="text-3xl font-extrabold text-white mb-3 leading-tight">
                    Cari Kos Mudah di<br>Banjarmasin & Sekitarnya
                </h2>
                <p class="text-blue-100 text-sm leading-relaxed max-w-sm mx-auto mb-8">
                    Platform tepercaya untuk menemukan hunian kos mahasiswa dan pekerja di Banjarmasin dengan cepat dan akurat.
                </p>

                {{-- Poin Informasi Baru --}}
                <div class="space-y-4 text-left max-w-xs mx-auto">
                    <div class="flex items-center gap-3 text-blue-50 text-sm">
                        <svg class="w-5 h-5 text-orange-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Banyak pilihan kos di sekitar kampus
                    </div>
                    <div class="flex items-center gap-3 text-blue-50 text-sm">
                        <svg class="w-5 h-5 text-orange-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Informasi harga dan status kamar real-time
                    </div>
                    <div class="flex items-center gap-3 text-blue-50 text-sm">
                        <svg class="w-5 h-5 text-orange-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Hubungi pemilik langsung via WhatsApp
                    </div>
                </div>
            </div>
        </div>

        {{-- Kanan: Form Login --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12">
            <div class="w-full max-w-md">

                {{-- Header form --}}
                <div class="mb-8">
                    <h1 class="text-2xl font-extrabold text-gray-800">Selamat Datang Kembali</h1>
                    <p class="text-gray-400 text-sm mt-1">Masuk ke akun KosKu Anda</p>
                </div>

                {{-- Session Status (misal setelah reset password) --}}
                @if (session('status'))
                    <div class="mb-5 flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('status') }}
                    </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                            Alamat Email
                        </label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="nama@email.com"
                                   required autofocus autocomplete="username"
                                   class="w-full pl-10 pr-4 py-3 text-sm border rounded-xl focus:outline-none focus:ring-2 transition
                                          {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="text-xs font-semibold text-gray-600">Kata Sandi</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                   class="text-xs font-semibold hover:underline" style="color: #005EAD;">
                                    Lupa kata sandi?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <input type="password"
                                   name="password"
                                   id="password"
                                   placeholder="••••••••"
                                   required autocomplete="current-password"
                                   class="w-full pl-10 pr-11 py-3 text-sm border rounded-xl focus:outline-none focus:ring-2 transition
                                          {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                            {{-- Toggle show/hide password --}}
                            <button type="button"
                                    onclick="togglePassword('password', 'eye-login')"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                <svg id="eye-login" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Remember me --}}
                    <div class="flex items-center gap-2.5">
                        <input type="checkbox"
                               name="remember"
                               id="remember"
                               class="w-4 h-4 rounded border-gray-300 cursor-pointer"
                               style="accent-color: #005EAD;">
                        <label for="remember" class="text-sm text-gray-500 cursor-pointer select-none">
                            Ingat saya di perangkat ini
                        </label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                            class="w-full py-3 rounded-xl text-white text-sm font-bold shadow-md hover:opacity-90 transition-opacity"
                            style="background-color: #FF5E1F;">
                        Masuk ke Dashboard
                    </button>

                    {{-- Divider --}}
                    <div class="relative flex items-center gap-3">
                        <div class="flex-1 h-px bg-gray-200"></div>
                        <span class="text-xs text-gray-400">atau</span>
                        <div class="flex-1 h-px bg-gray-200"></div>
                    </div>

                    {{-- Link register --}}
                    <p class="text-center text-sm text-gray-500">
                        Belum punya akun?
                        <a href="{{ route('register') }}"
                           class="font-bold hover:underline ml-1" style="color: #005EAD;">
                            Daftar Sekarang
                        </a>
                    </p>

                </form>
            </div>
        </div>

    </div>

    {{-- ============================================================ --}}
    {{-- FOOTER MINIMAL                                               --}}
    {{-- ============================================================ --}}
    <footer class="bg-white border-t border-gray-100 py-4">
        <p class="text-center text-xs text-gray-400">
            © {{ date('Y') }} KosKu — Platform Pencarian Kos Banjarmasin
        </p>
    </footer>

    {{-- Script toggle password --}}
    <script>
    function togglePassword(inputId, eyeId) {
        const input = document.getElementById(inputId);
        const eye   = document.getElementById(eyeId);
        const isHidden = input.type === 'password';

        input.type = isHidden ? 'text' : 'password';
        eye.innerHTML = isHidden
            ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`
            : `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
    }
    </script>

</body>
</html>