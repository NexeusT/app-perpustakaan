# DEMO.md — Skenario Demo Aplikasi Perpustakaan Digital Kampus

## Persiapan Sebelum Demo

1. Pastikan dua terminal terbuka:
   ```bash
   # Terminal 1 (server utama untuk browser)
   php artisan serve --port=8000

   # Terminal 2 (server API internal)
   php artisan serve --port=8011
   ```
2. Database sudah ter-seed: `php artisan migrate:fresh --seed`
3. Buka browser di `http://127.0.0.1:8000`

---

## Urutan Langkah Demo

### 1. Login

- Buka `http://127.0.0.1:8000/login`
- Masukkan kredensial admin: **Email:** `admin@pens.ac.id` | **Password:** `password`
- Klik tombol **Login**
- **Ekspektasi:** Diarahkan ke Dashboard, navbar menampilkan "Bambang Sutrisno (Admin)"

---

### 2. Tampilkan Dashboard

- Setelah login, halaman **Dashboard** (`/`) otomatis terbuka
- **Ekspektasi:** Tiga kartu statistik tampil:
  - **Total Buku:** 20
  - **Total Anggota:** 15
  - **Peminjaman Aktif:** (sesuai data LoanSeeder)
- Data diambil dari `GET /api/stats` melalui Laravel HTTP Client

---

### 3. Tambah Kategori

- Klik menu **Kategori** di navbar
- Klik tombol **Tambah Kategori**
- Isi form:
  - **Nama Kategori:** `Biografi`
  - **Deskripsi:** `Buku kisah hidup tokoh nyata`
- Klik **Simpan**
- **Ekspektasi:** Kategori baru muncul di daftar

---

### 4. Tambah Buku

- Klik menu **Buku** di navbar
- Klik tombol **Tambah Buku**
- Isi form:
  - **Judul:** `Habibie & Ainun`
  - **Penulis:** `B.J. Habibie`
  - **Penerbit:** `THC Mandiri`
  - **Tahun Terbit:** `2010`
  - **ISBN:** `9789792780437`
  - **Stok:** `5`
  - **Kategori:** `Biografi`
- Klik **Simpan**
- **Ekspektasi:** Buku baru muncul di daftar, pagination aktif (lebih dari 10 buku)

---

### 5. Tambah Anggota

- Klik menu **Anggota** di navbar
- Klik tombol **Tambah Anggota**
- Isi form:
  - **Nama:** `Rizky Pratama`
  - **NIM:** `2310501099`
  - **Email:** `rizky.pratama@pens.ac.id`
  - **Nomor Telepon:** `081234567899`
  - **Alamat:** `Jl. Raya ITS No. 5, Surabaya`
  - **Status:** `aktif`
- Klik **Simpan**
- **Ekspektasi:** Anggota baru muncul di daftar

---

### 6. Buat Peminjaman

- Klik menu **Peminjaman** di navbar
- Klik tombol **Tambah Peminjaman**
- Isi form:
  - **Anggota:** `Rizky Pratama`
  - **Tanggal Pinjam:** (hari ini)
  - **Tanggal Kembali:** (7 hari ke depan)
  - **Buku:** pilih `Habibie & Ainun` dan satu buku lain
- Klik **Simpan**
- **Ekspektasi:** Transaksi peminjaman baru muncul di daftar dengan status "Dipinjam"

---

### 7. Lihat Daftar Peminjaman Aktif

- Di halaman **Peminjaman** (`/loans`), tabel menampilkan semua transaksi
- Filter/perhatikan baris dengan status **Dipinjam** dan **Terlambat**
- **Ekspektasi:** Minimal 10 transaksi dari LoanSeeder + 1 yang baru dibuat

---

### 8. Proses Pengembalian

- Cari transaksi yang berstatus **Dipinjam** dari langkah sebelumnya
- Klik tombol **Kembalikan** pada baris tersebut
- **Ekspektasi:** Status berubah menjadi **Dikembalikan**, field tanggal dikembalikan terisi otomatis

---

### 9. Tampilkan Laporan Peminjaman

- Klik menu **Laporan** di navbar (atau klik tombol di Dashboard)
- **Ekspektasi:** Halaman `/loans/report` menampilkan tabel transaksi dari `GET /api/loans` dengan kolom: ID, Anggota, Petugas, Buku, Tgl Pinjam, Tgl Kembali, Status

---

### 10. Demo API di Postman

Buka Postman dan uji endpoint berikut (gunakan server port 8000 atau 8011):

| Method | URL | Keterangan |
|--------|-----|------------|
| GET | `http://127.0.0.1:8000/api/stats` | Statistik perpustakaan |
| GET | `http://127.0.0.1:8000/api/books` | Daftar buku (paginated) |
| GET | `http://127.0.0.1:8000/api/members` | Daftar anggota |
| GET | `http://127.0.0.1:8000/api/loans` | Daftar peminjaman |
| POST | `http://127.0.0.1:8000/api/books` | Tambah buku baru (JSON body) |

**Contoh respons `GET /api/stats`:**
```json
{
  "total_buku": 21,
  "total_anggota": 16,
  "peminjaman_aktif": 3
}
```

---

## Kredensial Demo

| Role | Email | Password |
|------|-------|----------|
| Admin | `admin@pens.ac.id` | `password` |
| Petugas | `petugas1@pens.ac.id` | `password` |
| Petugas | `petugas2@pens.ac.id` | `password` |
