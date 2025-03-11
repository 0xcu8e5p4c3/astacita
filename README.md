# ASTACITA
# News Website

## 📌 Tentang Proyek
Website ini merupakan platform berita modern yang dikembangkan menggunakan **Laravel** dan **PostgreSQL**. Website ini dirancang untuk menyajikan berita terkini dengan sistem manajemen konten (CMS) yang memungkinkan pengelolaan artikel, SEO, dan analisis data secara efisien.

## 🚀 Fitur Utama
- **Manajemen Berita**: Tambah, edit, dan hapus artikel berita dengan mudah.
- **SEO Optimization**: Sistem SEO-friendly untuk meningkatkan visibilitas di mesin pencari.
- **Dashboard Admin**: Panel admin untuk mengelola konten dan pengguna.
- **Kategori & Tagging**: Pengelompokan berita berdasarkan kategori dan tag.
- **Sistem Komentar**: Pengguna dapat berinteraksi dengan memberikan komentar pada artikel.
- **Mode Gelap/Terang**: Pilihan tampilan sesuai preferensi pengguna.

## 🛠️ Teknologi yang Digunakan
- **Framework**: Laravel
- **Database**: PostgreSQL/MySQL

## 📦 Instalasi dan Menjalankan Proyek
### 1. Clone Repository
```bash
git clone https://github.com/0xcu8e5p4c3/astacita.git
cd astacita
```

### 2. Instal Dependensi
```bash
composer install
cp .env.example .env
php artisan key:generate
npm install
```

### 3. Konfigurasi Database
- Pastikan PostgreSQL/MySQL sudah terinstal.
- Buat database baru dan sesuaikan konfigurasi di `.env`.
- Jalankan migrasi database:
```bash
php artisan migrate
```

### 4. Menjalankan Proyek
```bash
composer run dev
```
Akses website melalui `http://localhost:8000`

### 4. Update Proyek
```bash
git add .
git commit -m "deskripsi"
git pull origin main
git push origin main
```

## 🔒 Akses Terbatas
Proyek ini hanya untuk tim internal dan **tidak untuk publik**. Jika Anda adalah bagian dari tim, pastikan Anda memiliki izin sebelum mengakses atau mengubah kode.

## 📜 Lisensi
Proyek ini bersifat privat dan hanya dapat digunakan oleh tim pengembang yang berwenang.

---
Dibuat dengan ❤️ oleh 0x3u8e5p4ce.
