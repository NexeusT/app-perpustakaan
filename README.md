# app-perpustakaan

Aplikasi manajemen perpustakaan digital kampus dibangun dengan **Laravel 12**, mencakup CRUD buku, anggota, kategori, peminjaman, REST API, serta dashboard statistik yang mengonsumsi API internal.

## Teknologi

- **Backend:** Laravel 12 (PHP 8.2+)
- **Database:** SQLite (default) / MySQL
- **Auth:** Laravel built-in session auth
- **API:** Laravel API Resources + HTTP Client

## Cara Menjalankan

### 1. Clone Repository

```bash
git clone https://github.com/NexeusT/app-perpustakaan.git
cd app-perpustakaan
```

### 2. Install Dependency

```bash
composer install
```

### 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` sesuai kebutuhan lokal. Variabel penting:

```env
# URL aplikasi utama
APP_URL=http://localhost:8000

# URL instance server kedua khusus panggilan API internal
# (DashboardController dan LoanController@report menggunakan ini)
# Wajib diisi dengan port berbeda dari APP_URL
INTERNAL_API_URL=http://127.0.0.1:8011

# Locale Faker untuk data dummy bergaya Indonesia
APP_FAKER_LOCALE=id_ID

# Konfigurasi database (SQLite default sudah tersedia)
DB_CONNECTION=sqlite
```

### 4. Migrate & Seed Database

```bash
php artisan migrate:fresh --seed
```

Perintah ini akan:
- Membuat ulang semua tabel dari nol
- Menjalankan 5 seeder: UserSeeder, CategorySeeder, BookSeeder, MemberSeeder, LoanSeeder
- Menghasilkan data dummy: 3 user, 5 kategori, 20 buku, 15 anggota, 10 peminjaman

### 5. Jalankan Dua Server

> **Penting:** Dashboard (`/`) dan Laporan Peminjaman (`/loans/report`) mengonsumsi API internal via Laravel HTTP Client. Karena `php artisan serve` hanya memproses satu request per waktu, diperlukan **dua instance server di port berbeda** agar tidak terjadi deadlock.

Buka dua terminal:

```bash
# Terminal 1 — Server utama untuk browser
php artisan serve --port=8000

# Terminal 2 — Server API internal (dipanggil dari dalam aplikasi)
php artisan serve --port=8011
```

Kemudian buka browser di: `http://127.0.0.1:8000`

---

## Kredensial Default

| Role | Email | Password |
|------|-------|----------|
| Admin | `admin@pens.ac.id` | `password` |
| Petugas | `petugas1@pens.ac.id` | `password` |
| Petugas | `petugas2@pens.ac.id` | `password` |

---

## Fitur

| Fitur | URL | Akses |
|-------|-----|-------|
| Dashboard statistik | `/` | Auth |
| CRUD Buku | `/books` | Auth |
| CRUD Anggota | `/members` | Auth |
| CRUD Peminjaman | `/loans` | Auth |
| Pengembalian buku | `/loans/{id}/kembalikan` | Auth |
| Laporan peminjaman | `/loans/report` | Auth |
| CRUD Kategori | `/categories` | Admin only |
| REST API Buku | `GET /api/books` | Public |
| REST API Anggota | `GET /api/members` | Public |
| REST API Peminjaman | `GET /api/loans` | Public |
| REST API Statistik | `GET /api/stats` | Public |

---

## Struktur Branch

- `main` — Branch stabil, siap demo/produksi
- `dev` — Branch pengembangan aktif

---

## Riwayat Pertemuan

| Pertemuan | Topik |
|-----------|-------|
| P-4 | Setup project & migration |
| P-5 | CRUD lengkap buku & anggota |
| P-6 | Refactor ke master layout & test otomatis |
| P-7 | CRUD peminjaman & pengembalian |
| P-8 | Autentikasi login/logout & middleware role |
| P-9 | REST API (books, members, loans, stats) |
| P-10 | Dashboard konsumsi API, Seeder & Factory, finalisasi |
