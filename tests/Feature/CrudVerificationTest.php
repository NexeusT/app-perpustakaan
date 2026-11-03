<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CrudVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_categories_crud_and_validation(): void
    {
        // 1. Index
        $response = $this->get(route('categories.index'));
        $response->assertStatus(200);

        // 2. Create form
        $response = $this->get(route('categories.create'));
        $response->assertStatus(200);

        // 3. Validation error on store
        $response = $this->post(route('categories.store'), []);
        $response->assertSessionHasErrors(['nama_kategori']);

        // 4. Store
        $response = $this->post(route('categories.store'), [
            'nama_kategori' => 'Kategori Uji Coba',
            'deskripsi' => 'Deskripsi uji coba',
        ]);
        $response->assertRedirect(route('categories.index'));
        $this->assertDatabaseHas('categories', ['nama_kategori' => 'Kategori Uji Coba']);

        $category = Category::where('nama_kategori', 'Kategori Uji Coba')->first();

        // 5. Edit form
        $response = $this->get(route('categories.edit', $category->id));
        $response->assertStatus(200);

        // 6. Update
        $response = $this->put(route('categories.update', $category->id), [
            'nama_kategori' => 'Kategori Uji Coba Diubah',
            'deskripsi' => 'Deskripsi update',
        ]);
        $response->assertRedirect(route('categories.index'));
        $this->assertDatabaseHas('categories', ['nama_kategori' => 'Kategori Uji Coba Diubah']);

        // 7. Delete
        $response = $this->delete(route('categories.destroy', $category->id));
        $response->assertRedirect(route('categories.index'));
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    public function test_books_crud_and_validation(): void
    {
        $category = Category::firstOrCreate(['nama_kategori' => 'Fiksi'], ['deskripsi' => 'Fiksi']);

        // 1. Index
        $response = $this->get(route('books.index'));
        $response->assertStatus(200);

        // 2. Create form
        $response = $this->get(route('books.create'));
        $response->assertStatus(200);

        // 3. Validation error on store
        $response = $this->post(route('books.store'), []);
        $response->assertSessionHasErrors(['judul', 'penulis', 'penerbit', 'tahun_terbit', 'stok', 'category_id']);

        // 4. Store
        $response = $this->post(route('books.store'), [
            'judul' => 'Buku Uji Coba',
            'penulis' => 'Penulis Uji',
            'penerbit' => 'Penerbit Uji',
            'tahun_terbit' => 2024,
            'isbn' => '9781234567890',
            'stok' => 10,
            'category_id' => $category->id,
        ]);
        $response->assertRedirect(route('books.index'));
        $this->assertDatabaseHas('books', ['judul' => 'Buku Uji Coba']);

        $book = Book::where('judul', 'Buku Uji Coba')->first();

        // 5. Show
        $response = $this->get(route('books.show', $book->id));
        $response->assertStatus(200);

        // 6. Edit form
        $response = $this->get(route('books.edit', $book->id));
        $response->assertStatus(200);

        // 7. Update
        $response = $this->put(route('books.update', $book->id), [
            'judul' => 'Buku Uji Coba Diperbarui',
            'penulis' => 'Penulis Baru',
            'penerbit' => 'Penerbit Baru',
            'tahun_terbit' => 2025,
            'isbn' => '9781234567890',
            'stok' => 15,
            'category_id' => $category->id,
        ]);
        $response->assertRedirect(route('books.index'));
        $this->assertDatabaseHas('books', ['judul' => 'Buku Uji Coba Diperbarui']);

        // 8. Delete
        $response = $this->delete(route('books.destroy', $book->id));
        $response->assertRedirect(route('books.index'));
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }

    public function test_members_crud_and_validation(): void
    {
        // 1. Index
        $response = $this->get(route('members.index'));
        $response->assertStatus(200);

        // 2. Create form
        $response = $this->get(route('members.create'));
        $response->assertStatus(200);

        // 3. Validation error on store
        $response = $this->post(route('members.store'), []);
        $response->assertSessionHasErrors(['nama', 'nim', 'email', 'nomor_telepon', 'alamat', 'status']);

        // 4. Store
        $response = $this->post(route('members.store'), [
            'nama' => 'Anggota Uji',
            'nim' => '9999999999',
            'email' => 'anggota.uji@example.com',
            'nomor_telepon' => '089999999999',
            'alamat' => 'Jl. Pengujian No. 1',
            'status' => 'aktif',
        ]);
        $response->assertRedirect(route('members.index'));
        $this->assertDatabaseHas('members', ['nim' => '9999999999']);

        $member = Member::where('nim', '9999999999')->first();

        // 5. Show
        $response = $this->get(route('members.show', $member->id));
        $response->assertStatus(200);

        // 6. Edit form
        $response = $this->get(route('members.edit', $member->id));
        $response->assertStatus(200);

        // 7. Update
        $response = $this->put(route('members.update', $member->id), [
            'nama' => 'Anggota Uji Diperbarui',
            'nim' => '9999999999',
            'email' => 'anggota.uji.updated@example.com',
            'nomor_telepon' => '089999999998',
            'alamat' => 'Jl. Pengujian No. 2',
            'status' => 'nonaktif',
        ]);
        $response->assertRedirect(route('members.index'));
        $this->assertDatabaseHas('members', ['email' => 'anggota.uji.updated@example.com']);

        // 8. Delete
        $response = $this->delete(route('members.destroy', $member->id));
        $response->assertRedirect(route('members.index'));
        $this->assertDatabaseMissing('members', ['id' => $member->id]);
    }
}
