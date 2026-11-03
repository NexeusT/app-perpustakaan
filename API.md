# Dokumentasi REST API - app-perpustakaan

Base URL: `http://127.0.0.1:8000/api`

> **Header wajib di setiap request:** `Accept: application/json`

---

## Daftar Endpoint

| Method | URL | Body (jika ada) | Status Sukses | Status Gagal |
|--------|-----|-----------------|---------------|--------------|
| GET | `/api/books` | - | 200 | - |
| GET | `/api/books/{id}` | - | 200 | 404 |
| POST | `/api/books` | JSON (lihat di bawah) | 201 | 422 |
| PUT | `/api/books/{id}` | JSON (lihat di bawah) | 200 | 404, 422 |
| DELETE | `/api/books/{id}` | - | 200 | 404 |
| GET | `/api/members` | - | 200 | - |
| GET | `/api/members/{id}` | - | 200 | 404 |
| GET | `/api/loans` | - | 200 | - |
| POST | `/api/loans` | JSON (lihat di bawah) | 201 | 422 |
| PUT | `/api/loans/{id}/kembalikan` | - | 200 | 404 |
| GET | `/api/stats` | - | 200 | - |

---

## Detail Endpoint

### 1. `GET /api/books`

Menampilkan daftar buku dengan pagination. Mendukung filter opsional:
- `?judul=` — filter berdasarkan judul (partial match)
- `?category_id=` — filter berdasarkan kategori

**Contoh Response (200 OK):**
```json
{
  "data": [
    {
      "id": 1,
      "judul": "Laskar Pelangi",
      "penulis": "Andrea Hirata",
      "penerbit": "Bentang Pustaka",
      "tahun_terbit": "2005",
      "isbn": "9789793062792",
      "stok": 5,
      "sampul": null,
      "category": {
        "id": 1,
        "nama_kategori": "Fiksi"
      },
      "created_at": "2026-11-03T13:22:05.000000Z",
      "updated_at": "2026-11-03T13:22:05.000000Z"
    }
  ],
  "links": {
    "first": "http://127.0.0.1:8000/api/books?page=1",
    "last": "http://127.0.0.1:8000/api/books?page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 1,
    "per_page": 10,
    "to": 3,
    "total": 3
  }
}
```

---

### 2. `GET /api/books/{id}`

Menampilkan detail satu buku.

**Contoh Response (200 OK):**
```json
{
  "data": {
    "id": 1,
    "judul": "Laskar Pelangi",
    "penulis": "Andrea Hirata",
    "penerbit": "Bentang Pustaka",
    "tahun_terbit": "2005",
    "isbn": "9789793062792",
    "stok": 5,
    "sampul": null,
    "category": {
      "id": 1,
      "nama_kategori": "Fiksi"
    },
    "created_at": "2026-11-03T13:22:05.000000Z",
    "updated_at": "2026-11-03T13:22:05.000000Z"
  }
}
```

**Contoh Response (404 Not Found):**
```json
{
  "message": "No query results for model [App\\Models\\Book] 999"
}
```

---

### 3. `POST /api/books`

Membuat buku baru.

**Body Request:**
```json
{
  "judul": "Test Buku API",
  "penulis": "Penulis API",
  "penerbit": "Penerbit API",
  "tahun_terbit": 2024,
  "isbn": "9999999999999",
  "stok": 10,
  "category_id": 1
}
```

**Contoh Response (201 Created):**
```json
{
  "data": {
    "id": 4,
    "judul": "Test Buku API",
    "penulis": "Penulis API",
    "penerbit": "Penerbit API",
    "tahun_terbit": 2024,
    "isbn": "9999999999999",
    "stok": 10,
    "sampul": null,
    "category": {
      "id": 1,
      "nama_kategori": "Fiksi"
    },
    "created_at": "2026-11-03T13:54:38.000000Z",
    "updated_at": "2026-11-03T13:54:38.000000Z"
  }
}
```

**Contoh Response (422 Unprocessable Entity) — validasi gagal:**
```json
{
  "message": "The judul field is required. (and 4 more errors)",
  "errors": {
    "judul": ["The judul field is required."],
    "penulis": ["The penulis field is required."],
    "penerbit": ["The penerbit field is required."],
    "tahun_terbit": ["The tahun terbit field is required."],
    "stok": ["The stok field is required."]
  }
}
```

---

### 4. `PUT /api/books/{id}`

Memperbarui data buku.

**Body Request:**
```json
{
  "judul": "Laskar Pelangi (Edisi Revisi)",
  "penulis": "Andrea Hirata",
  "penerbit": "Bentang Pustaka",
  "tahun_terbit": 2008,
  "isbn": "9789793062792",
  "stok": 8,
  "category_id": 1
}
```

**Contoh Response (200 OK):**
```json
{
  "data": {
    "id": 1,
    "judul": "Laskar Pelangi (Edisi Revisi)",
    "penulis": "Andrea Hirata",
    "penerbit": "Bentang Pustaka",
    "tahun_terbit": 2008,
    "isbn": "9789793062792",
    "stok": 8,
    "sampul": null,
    "category": {
      "id": 1,
      "nama_kategori": "Fiksi"
    },
    "created_at": "2026-11-03T13:22:05.000000Z",
    "updated_at": "2026-11-03T13:55:00.000000Z"
  }
}
```

---

### 5. `DELETE /api/books/{id}`

Menghapus buku.

**Contoh Response (200 OK):**
```json
{
  "message": "Buku berhasil dihapus."
}
```

---

### 6. `GET /api/members`

Menampilkan daftar anggota dengan pagination.

**Contoh Response (200 OK):**
```json
{
  "data": [
    {
      "id": 1,
      "nama": "Siti Aminah",
      "nim": "2310501001",
      "email": "siti.aminah@pens.ac.id",
      "nomor_telepon": "081234567890",
      "alamat": "Jl. Raya ITS, Sukolilo, Surabaya",
      "status": "aktif",
      "created_at": "2026-11-03T13:22:05.000000Z",
      "updated_at": "2026-11-03T13:22:05.000000Z"
    }
  ],
  "links": { "first": "...", "last": "...", "prev": null, "next": null },
  "meta": { "current_page": 1, "per_page": 10, "total": 3 }
}
```

---

### 7. `GET /api/members/{id}`

Menampilkan detail satu anggota.

**Contoh Response (200 OK):**
```json
{
  "data": {
    "id": 1,
    "nama": "Siti Aminah",
    "nim": "2310501001",
    "email": "siti.aminah@pens.ac.id",
    "nomor_telepon": "081234567890",
    "alamat": "Jl. Raya ITS, Sukolilo, Surabaya",
    "status": "aktif",
    "created_at": "2026-11-03T13:22:05.000000Z",
    "updated_at": "2026-11-03T13:22:05.000000Z"
  }
}
```

---

### 8. `GET /api/loans`

Menampilkan daftar peminjaman dengan relasi member, petugas, dan buku yang dipinjam.

**Contoh Response (200 OK):**
```json
{
  "data": [
    {
      "id": 1,
      "member": { "id": 1, "nama": "Siti Aminah" },
      "petugas": { "id": 1, "name": "Admin Perpustakaan" },
      "tanggal_pinjam": "2026-11-03",
      "tanggal_kembali": "2026-11-10",
      "tanggal_dikembalikan": "2026-11-03",
      "status": "dikembalikan",
      "books": [
        { "id": 1, "judul": "Laskar Pelangi" },
        { "id": 2, "judul": "Bumi Manusia" }
      ]
    }
  ],
  "links": { "first": "...", "last": "...", "prev": null, "next": null },
  "meta": { "current_page": 1, "per_page": 10, "total": 1 }
}
```

---

### 9. `POST /api/loans`

Membuat transaksi peminjaman baru. `user_id` wajib dikirim eksplisit (API tidak menggunakan session auth).

**Body Request:**
```json
{
  "member_id": 1,
  "user_id": 1,
  "tanggal_pinjam": "2026-11-03",
  "tanggal_kembali": "2026-11-10",
  "book_ids": [1, 2]
}
```

**Contoh Response (201 Created):**
```json
{
  "data": {
    "id": 1,
    "member": { "id": 1, "nama": "Siti Aminah" },
    "petugas": { "id": 1, "name": "Admin Perpustakaan" },
    "tanggal_pinjam": "2026-11-03",
    "tanggal_kembali": "2026-11-10",
    "tanggal_dikembalikan": null,
    "status": "dipinjam",
    "books": [
      { "id": 1, "judul": "Laskar Pelangi" },
      { "id": 2, "judul": "Bumi Manusia" }
    ]
  }
}
```

**Contoh Response (422 Unprocessable Entity) — validasi gagal:**
```json
{
  "message": "Anggota wajib dipilih. (and 4 more errors)",
  "errors": {
    "member_id": ["Anggota wajib dipilih."],
    "user_id": ["Petugas (user_id) wajib diisi."],
    "tanggal_pinjam": ["Tanggal pinjam wajib diisi."],
    "tanggal_kembali": ["Tanggal kembali wajib diisi."],
    "book_ids": ["Pilih minimal satu buku."]
  }
}
```

---

### 10. `PUT /api/loans/{id}/kembalikan`

Mengubah status peminjaman menjadi `dikembalikan` dan mengisi `tanggal_dikembalikan` dengan tanggal hari ini.

**Contoh Response (200 OK):**
```json
{
  "data": {
    "id": 1,
    "member": { "id": 1, "nama": "Siti Aminah" },
    "petugas": { "id": 1, "name": "Admin Perpustakaan" },
    "tanggal_pinjam": "2026-11-03",
    "tanggal_kembali": "2026-11-10",
    "tanggal_dikembalikan": "2026-11-03",
    "status": "dikembalikan",
    "books": [
      { "id": 1, "judul": "Laskar Pelangi" },
      { "id": 2, "judul": "Bumi Manusia" }
    ]
  }
}
```

---

### 11. `GET /api/stats`

Menampilkan ringkasan statistik perpustakaan.

**Contoh Response (200 OK):**
```json
{
  "total_buku": 3,
  "total_anggota": 3,
  "peminjaman_aktif": 0
}
```
