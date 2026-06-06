{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — KosKu</title>
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
            <a href="{{ route('login') }}"
               class="text-sm font-semibold px-4 py-2 rounded-xl border transition-colors text-gray-600 border-gray-200 hover:bg-gray-50">
                Sudah punya akun?
            </a>
        </div>
    </nav>

    {{-- ============================================================ --}}
    {{-- HERO SPLIT LAYOUT                                            --}}
    {{-- ============================================================ --}}
    <div class="flex flex-1">

        {{-- Kiri: Ilustrasi --}}
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden flex-col items-center justify-center p-12"
             style="background: linear-gradient(135deg, #004F99 0%, #0077CC 100%);">

            <div class="absolute -top-16 -left-16 w-64 h-64 rounded-full opacity-10" style="background:#fff;"></div>
            <div class="absolute -bottom-20 -right-20 w-80 h-80 rounded-full opacity-10" style="background:#fff;"></div>

            <div class="relative z-10 text-center">
                <div class="w-24 h-24 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-2xl"
                     style="background-color: rgba(255,255,255,0.15);">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>

                <h2 class="text-3xl font-extrabold text-white mb-3 leading-tight">
                    Mulai Langkah Anda<br>Bersama KosKu
                </h2>
                <p class="text-blue-100 text-sm leading-relaxed max-w-xs mx-auto">
                    Temukan hunian kos terbaik atau mulai pasarkan properti kos Anda di Banjarmasin dengan mudah.
                </p>

                {{-- Step indikator --}}
                <div class="mt-10 space-y-3 text-left">
                    @php
                        $steps = [
                            ['num' => '1', 'text' => 'Buat akun gratis dalam hitungan menit'],
                            ['num' => '2', 'text' => 'Pilih peran sebagai pencari atau pemilik kos'],
                            ['num' => '3', 'text' => 'Mulai cari hunian atau kelola properti Anda'],
                        ];
                    @endphp
                    @foreach ($steps as $step)
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-full flex items-center justify-center flex-shrink-0 text-xs font-bold text-white"
                                 style="background-color: #FF5E1F;">
                                {{ $step['num'] }}
                            </div>
                            <span class="text-blue-100 text-sm">{{ $step['text'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Kanan: Form Register --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12">
            <div class="w-full max-w-md">

                {{-- Header --}}
                <div class="mb-8">
                    <h1 class="text-2xl font-extrabold text-gray-800">Buat Akun Baru</h1>
                    <p class="text-gray-400 text-sm mt-1">Isi data di bawah untuk mendaftar sebagai pencari atau pemilik kos</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    {{-- Nama --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                            Nama Lengkap
                        </label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name') }}"
                                   placeholder="Nama lengkap Anda"
                                   required autofocus autocomplete="name"
                                   class="w-full pl-10 pr-4 py-3 text-sm border rounded-xl focus:outline-none focus:ring-2 transition
                                          {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                        </div>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

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
                                   required autocomplete="username"
                                   class="w-full pl-10 pr-4 py-3 text-sm border rounded-xl focus:outline-none focus:ring-2 transition
                                          {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                            Kata Sandi
                        </label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <input type="password"
                                   name="password"
                                   id="password"
                                   placeholder="Min. 8 karakter"
                                   required autocomplete="new-password"
                                   class="w-full pl-10 pr-11 py-3 text-sm border rounded-xl focus:outline-none focus:ring-2 transition
                                          {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                            <button type="button"
                                    onclick="togglePassword('password', 'eye-pass')"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                <svg id="eye-pass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                            Konfirmasi Kata Sandi
                        </label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <input type="password"
                                   name="password_confirmation"
                                   id="password_confirmation"
                                   placeholder="Ulangi kata sandi"
                                   required autocomplete="new-password"
                                   class="w-full pl-10 pr-11 py-3 text-sm border rounded-xl focus:outline-none focus:ring-2 transition
                                          {{ $errors->has('password_confirmation') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                            <button type="button"
                                    onclick="togglePassword('password_confirmation', 'eye-confirm')"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                <svg id="eye-confirm" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    {{-- Nomor WhatsApp --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                            Nomor WhatsApp
                        </label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.72l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.72.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <input type="text"
                                   name="no_wa"
                                   value="{{ old('no_wa') }}"
                                   placeholder="Contoh: 08123456789"
                                   required
                                   class="w-full pl-10 pr-4 py-3 text-sm border rounded-xl focus:outline-none focus:ring-2 transition
                                          {{ $errors->has('no_wa') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                        </div>
                        @error('no_wa')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Role --}}
                    <div class="grid grid-cols-2 gap-3">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="role" value="pencari" class="peer hidden" checked>
                            <div class="p-3 rounded-xl border-2 border-gray-200 peer-checked:border-[#005EAD] peer-checked:bg-blue-50 transition-all text-center">
                                <svg class="w-6 h-6 mx-auto mb-1 text-gray-400 peer-checked:text-[#005EAD]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <p class="text-xs font-semibold text-gray-600">Pencari Kos</p>
                                <p class="text-xs text-gray-400">Saya ingin cari kos</p>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="role" value="pemilik" class="peer hidden">
                            <div class="p-3 rounded-xl border-2 border-gray-200 peer-checked:border-[#FF5E1F] peer-checked:bg-orange-50 transition-all text-center">
                                <svg class="w-6 h-6 mx-auto mb-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                <p class="text-xs font-semibold text-gray-600">Pemilik Kos</p>
                                <p class="text-xs text-gray-400">Saya punya kos untuk disewakan</p>
                            </div>
                        </label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                            class="w-full py-3 rounded-xl text-white text-sm font-bold shadow-md hover:opacity-90 transition-opacity"
                            style="background-color: #FF5E1F;">
                        Buat Akun Sekarang
                    </button>

                    {{-- Divider --}}
                    <div class="relative flex items-center gap-3">
                        <div class="flex-1 h-px bg-gray-200"></div>
                        <span class="text-xs text-gray-400">atau</span>
                        <div class="flex-1 h-px bg-gray-200"></div>
                    </div>

                    {{-- Link login --}}
                    <p class="text-center text-sm text-gray-500">
                        Sudah punya akun?
                        <a href="{{ route('login') }}"
                           class="font-bold hover:underline ml-1" style="color: #005EAD;">
                            Masuk di Sini
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