<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Member;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([UserSeeder::class]);

        $fiksi = Category::firstOrCreate(
            ['nama_kategori' => 'Fiksi'],
            ['deskripsi' => 'Buku karya sastra fiksi dan novel']
        );

        $teknologi = Category::firstOrCreate(
            ['nama_kategori' => 'Teknologi'],
            ['deskripsi' => 'Buku seputar komputer dan pemrograman']
        );

        $sejarah = Category::firstOrCreate(
            ['nama_kategori' => 'Sejarah'],
            ['deskripsi' => 'Buku peristiwa dan kajian sejarah']
        );

        Book::firstOrCreate(
            ['judul' => 'Laskar Pelangi'],
            [
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => 2005,
                'isbn' => '9789793062792',
                'stok' => 5,
                'category_id' => $fiksi->id,
            ]
        );

        Book::firstOrCreate(
            ['judul' => 'Bumi Manusia'],
            [
                'penulis' => 'Pramoedya Ananta Toer',
                'penerbit' => 'Hasta Mitra',
                'tahun_terbit' => 1980,
                'isbn' => '9789794330746',
                'stok' => 3,
                'category_id' => $fiksi->id,
            ]
        );

        Book::firstOrCreate(
            ['judul' => 'Clean Code'],
            [
                'penulis' => 'Robert C. Martin',
                'penerbit' => 'Prentice Hall',
                'tahun_terbit' => 2008,
                'isbn' => '9780132350884',
                'stok' => 7,
                'category_id' => $teknologi->id,
            ]
        );

        Member::firstOrCreate(
            ['nim' => '2310501001'],
            [
                'nama' => 'Siti Aminah',
                'email' => 'siti.aminah@pens.ac.id',
                'nomor_telepon' => '081234567890',
                'alamat' => 'Jl. Raya ITS, Sukolilo, Surabaya',
                'status' => 'aktif',
            ]
        );

        Member::firstOrCreate(
            ['nim' => '2310501002'],
            [
                'nama' => 'Budi Santoso',
                'email' => 'budi.santoso@pens.ac.id',
                'nomor_telepon' => '081298765432',
                'alamat' => 'Jl. Gebang Wetan No. 12, Surabaya',
                'status' => 'aktif',
            ]
        );

        Member::firstOrCreate(
            ['nim' => '2310501003'],
            [
                'nama' => 'Dewi Lestari',
                'email' => 'dewi.lestari@pens.ac.id',
                'nomor_telepon' => '081211122233',
                'alamat' => 'Jl. Menur Pumpungan, Surabaya',
                'status' => 'nonaktif',
            ]
        );
    }
}
