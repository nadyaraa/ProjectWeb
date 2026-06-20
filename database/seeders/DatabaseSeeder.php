<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kos; 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\File;   

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ============================================================
        // OTOMATISASI PENYALINAN FILE FISIK GAMBAR DUMMY
        // ============================================================
        
        Storage::disk('public')->makeDirectory('kos');
        $sourceFile = public_path('images/dummy-kos.jpg');

        if (File::exists($sourceFile)) {
            Storage::disk('public')->put('kos/dummy-kos.jpg', File::get($sourceFile));
        }

        // ============================================================
        // SEED DATA USER 
        // ============================================================
        
        $admin = User::create([
            'name' => 'Aan Admin',
            'email' => 'admin@kosku.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'no_wa' => '085124209070',
        ]);

        $pemilik = User::create([
            'name' => 'Aan Pemilik',
            'email' => 'pemilik@kosku.com',
            'password' => Hash::make('password'),
            'role' => 'pemilik',
            'no_wa' => '085124209070',
        ]);

        User::create([
            'name' => 'Andi Pencari',
            'email' => 'pencari@kosku.com',
            'password' => Hash::make('password'),
            'role' => 'pencari',
            'no_wa' => '085124209070',
        ]);

        // ============================================================
        // SEED DATA KOS
        // ============================================================

        $dataKos = [
            [
                'user_id' => $pemilik->id,
                'nama' => 'Kos Contoh',
                'tipe' => 'Kos Putra',
                'lokasi' => 'Jl. Tomoro No. 8, Banjarbaru',
                'harga' => 500000,
                'jumlah_kamar' => 10,
                'status' => 'tersedia',
                'deskripsi' => 'Kos putra strategis dekat dengan fasilitas umum, lingkungan tenang, dan aman.',
                'foto' => 'kos/dummy-kos.jpg',
            ],
            [
                'user_id' => $pemilik->id,
                'nama' => 'Kos Barokah Mandala',
                'tipe' => 'Kos Putri',
                'lokasi' => 'Jl. Hasan Basri, Jalur 2, Banjarmasin',
                'harga' => 750000,
                'jumlah_kamar' => 15,
                'status' => 'tersedia',
                'deskripsi' => 'Kos khusus putri, dekat kampus, sudah termasuk listrik dan Wi-Fi kecepatan tinggi.',
                'foto' => 'kos/dummy-kos.jpg',
            ],
            [
                'user_id' => $pemilik->id,
                'nama' => 'Kos Eksklusif Pinus',
                'tipe' => 'Kos Campur',
                'lokasi' => 'Jl. Pinus Raya No. 12, Banjarbaru',
                'harga' => 1200000,
                'jumlah_kamar' => 8,
                'status' => 'penuh',
                'deskripsi' => 'Fasilitas premium dengan AC, kamar mandi dalam, kasur springbed, dan parkir luas.',
                'foto' => 'kos/dummy-kos.jpg',
            ],
            [
                'user_id' => $pemilik->id,
                'nama' => 'Pondok Hijau Syariah',
                'tipe' => 'Kos Putra',
                'lokasi' => 'Jl. Brigjend Hasan Basri No. 45, Banjarmasin',
                'harga' => 600000,
                'jumlah_kamar' => 12,
                'status' => 'tersedia',
                'deskripsi' => 'Kos putra lingkungan islami, bersih, aman dengan pengawasan CCTV 24 jam.',
                'foto' => 'kos/dummy-kos.jpg',
            ],
            [
                'user_id' => $pemilik->id,
                'nama' => 'Kos Anggrek Jingga',
                'tipe' => 'Kos Putri',
                'lokasi' => 'Jl. Cendana, Kayu Tangi, Banjarmasin',
                'harga' => 650000,
                'jumlah_kamar' => 20,
                'status' => 'tersedia',
                'deskripsi' => 'Lokasi sangat dekat dengan area kuliner and swalayan, akses jalan mobil lancar.',
                'foto' => 'kos/dummy-kos.jpg',
            ],
            [
                'user_id' => $pemilik->id,
                'nama' => 'Kos Smart Living 21',
                'tipe' => 'Kos Campur',
                'lokasi' => 'Jl. Perdagangan, Komplek HKSN, Banjarmasin',
                'harga' => 1500000,
                'jumlah_kamar' => 6,
                'status' => 'tersedia',
                'deskripsi' => 'Kos modern dengan sistem kartu akses, kamar mandi dalam modern, dan fully furnished.',
                'foto' => 'kos/dummy-kos.jpg',
            ],
            [
                'user_id' => $pemilik->id,
                'nama' => 'Wisma Panglima',
                'tipe' => 'Kos Putra',
                'lokasi' => 'Jl. Panglima Batur No. 34, Banjarbaru',
                'harga' => 550000,
                'jumlah_kamar' => 10,
                'status' => 'tersedia',
                'deskripsi' => 'Kos murah meriah, kipas angin tersedia, dapur umum bersih, dekat perkantoran.',
                'foto' => 'kos/dummy-kos.jpg',
            ],
            [
                'user_id' => $pemilik->id,
                'nama' => 'Kos Lestari Bahagia',
                'tipe' => 'Kos Putri',
                'lokasi' => 'Jl. Sungai Miai Dalam, Banjarmasin',
                'harga' => 450000,
                'jumlah_kamar' => 8,
                'status' => 'tersedia',
                'deskripsi' => 'Lingkungan asri di pinggir sungai miai, suasana tenang sangat cocok untuk belajar.',
                'foto' => 'kos/dummy-kos.jpg',
            ],
            [
                'user_id' => $pemilik->id,
                'nama' => 'Kos Tulip Amuntai',
                'tipe' => 'Kos Putri',
                'lokasi' => 'Jl. Kebun Karet No. 19, Banjarbaru',
                'harga' => 700000,
                'jumlah_kamar' => 14,
                'status' => 'penuh',
                'deskripsi' => 'Kamar luas ukuran 4x4 meter, sirkulasi udara sangat bagus, parkiran motor aman berpagar.',
                'foto' => 'kos/dummy-kos.jpg',
            ],
            [
                'user_id' => $pemilik->id,
                'nama' => 'Premium Residence 99',
                'tipe' => 'Kos Campur',
                'lokasi' => 'Jl. Gatot Subroto, Komplek Kelapa Gading, Banjarmasin',
                'harga' => 1800000,
                'jumlah_kamar' => 5,
                'status' => 'tersedia',
                'deskripsi' => 'Kos eksekutif dengan fasilitas setara hotel berbintang, water heater, dan keamanan ketat.',
                'foto' => 'kos/dummy-kos.jpg',
            ],
        ];

        foreach ($dataKos as $kos) {
            Kos::create($kos);
        }
    }
}