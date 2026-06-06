# KosKu : Platform Pencarian & Pengelolaan Kos Banjarmasin

Aplikasi web untuk memudahkan mahasiswa dan masyarakat dalam menemukan serta mengelola hunian kos secara digital di wilayah Banjarmasin dan sekitarnya. 
Dibangun sebagai Proyek Akhir mata kuliah Pemrograman Web II, Fakultas Teknik, Program Studi Teknologi Informasi, Universitas Lambung Mangkurat.

---

## Tim Pengembang

| Nama                | NIM           | Peran (Role)               | GitHub               |
| ------------------- | ------------- | -------------------------- |----------------------|
| M. Anshary          | 2410817310008 | Frontend & UI Designer     | @Aan97yxh            |
| Nadya Ramadhani     | 2410817120019 | Database Engineer          | @nadyaraa            |
| Rachel Wina Yuda    | 2410817220030 | Backend Developer          | @raequellee          |

---

## Tech Stack

| Komponen          | Teknologi                      |
| ----------------- | ------------------------------ |
| Bahasa            | PHP, JavaScript                |
| Backend Framework | Laravel (v11.x)                |
| Frontend Engine   | Blade Templates & Tailwind CSS |
| Database          | SQLite                         |
| Starter Kit Auth  | Laravel Breeze (Blade)         |
| Version Control   | GitHub                         |

---

## Fitur Utama
- **Sistem Otentikasi Multi-Role:** Registrasi dan login terpisah untuk Admin, Pemilik Kos, dan Pencari Kos.
- **Manajemen Data Kos (CRUD):** Pemilik kos dapat menambah, melihat, mengubah, dan menghapus data properti kos mereka.
- **Pencarian Hunian Efisien:** Pencari kos dapat menjelajahi daftar kos di Banjarmasin lengkap dengan detail fasilitas dan integrasi tombol hubungi pemilik via WhatsApp.
- **Panel Kendali Admin:** Manajemen penuh terhadap data seluruh pengguna dan properti kos yang terdaftar dalam sistem.

---

## Cara Instalasi

### Prasyarat

Pastikan perangkat Anda sudah terinstall komponen berikut:
- PHP (Minimal v8.2)
- Composer
- Node.js & NPM (Untuk kompilasi Tailwind CSS)

### Langkah Instalasi

1. Clone repository kelompok ke direktori lokal Anda:
    ```bash
    git clone https://github.com/nadyaraa/Web-Project.git
    cd Web-Project
    ```
    *(Catatan: Sesuaikan URL di atas dengan tautan resmi repositori organisasi/kelompok kalian jika berbeda)*

2. Install seluruh dependensi backend (PHP):
    ```bash
    composer install
    ```

3. Salin file konfigurasi environment:
    ```bash
    cp .env.example .env
    ```

4. Buat kunci enkripsi aplikasi baru:
    ```bash
    php artisan key:generate
    ```

5. Konfigurasi basis data SQLite lokal:
    - Di Windows (Command Prompt), buat file database kosong:
    ```bash
    type nul > database/database.sqlite
    ```
    - Buka file `.env` Anda, lalu sesuaikan bagian database menjadi seperti ini:
    ```env
    DB_CONNECTION=sqlite
    # Hapus baris DB_HOST, DB_PORT, DB_DATABASE lama, cukup sisakan DB_CONNECTION
    ```

6. Jalankan migrasi database sekaligus tanam data tiruan (dummy data) awal:
    ```bash
    php artisan migrate --seed
    ```

7. Buat tautan simbolis (symbolic link) agar aset gambar kos hasil seeder dapat diakses oleh browser:
    ```bash
    php artisan storage:link
    ```

8. Install dependensi frontend dan lakukan kompilasi aset Tailwind CSS:
    ```bash
    npm install
    npm run build
    ```

9. Jalankan server lokal Laravel:
    ```bash
    php artisan serve
    ```
    Aplikasi dapat diakses melalui browser di alamat: **http://127.0.0.1:8000**

---

## Akun Default & Hak Akses (Testing Ready)

Untuk mempermudah proses pengujian dan demo aplikasi, sistem telah menyediakan 3 akun default dengan role yang berbeda melalui mekanisme database seeder. Semua akun menggunakan password seragam: **`password`**.

| Role Pengguna | Email Login | Password | Hak Akses Utama |
| :--- | :--- | :--- | :--- |
| **👨‍💼 Admin** | `admin@kosku.com` | `password` | Manajemen penuh seluruh data pengguna dan properti kos di platform. |
| **🏠 Pemilik Kos** | `pemilik@kosku.com` | `password` | Manajemen (CRUD) properti kos pribadi dan integrasi WhatsApp. |
| **🎓 Pencari Kos** | `pencari@kosku.com` | `password` | Menjelajahi katalog kos dan mengakses fitur hubungi pemilik. |

*(Catatan: Anda tetap dapat mendaftarkan akun baru secara organik melalui form halaman Register bawaan aplikasi)*

---

## Struktur Database (Migration Utama)

Proyek ini menggunakan beberapa file migrasi khusus di luar bawaan framework untuk mendukung fungsionalitas sistem:
- `xxxx_create_kos_table.php` : Menyimpan data detail kos (nama, harga, fasilitas, alamat, gambar, dan relasi `user_id`).
- `xxxx_add_role_to_users_table.php` : Menambahkan kolom hak akses tipe pengguna (`admin`, `pemilik`, `pencari`).
- `xxxx_add_no_wa_to_users_table.php` : Menambahkan kolom nomor telepon WhatsApp aktif untuk keperluan komunikasi langsung.

---

## Hak Akses Pengguna

### 👨‍💼 Admin
- Memantau ringkasan statistik total data pada halaman utama Dashboard Admin.
- Melihat, melacak, dan mengelola seluruh data pengguna sistem (Melihat daftar pengguna aktif).
- Memantau dan mengelola seluruh properti kos yang dipublikasikan di platform.

### 🏠 Pemilik Kos
- Mengakses panel Dashboard khusus Pemilik Kos.
- Melakukan manajemen penuh (Create, Read, Update, Delete) pada properti kos pribadi miliknya.
- Menyantumkan nomor WhatsApp untuk memudahkan komunikasi dengan calon penyewa.

### 🎓 Pencari Kos (Mahasiswa / Umum)
- Menjelajahi beranda utama platform yang menampilkan seluruh daftar kos di Banjarmasin secara real-time.
- Mengakses halaman detail kos untuk melihat informasi harga, fasilitas, lokasi, serta foto bangunan.
- Menghubungi pemilik kos secara langsung melalui tautan tombol integrasi API WhatsApp.

---

## Lisensi

Proyek aplikasi web ini dikembangkan murni untuk keperluan akademik tugas Proyek Akhir mata kuliah Pemrograman Web II, Program Studi Teknologi Informasi, Universitas Lambung Mangkurat, tahun 2026.