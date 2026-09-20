<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    // Data dummy sementara untuk anggota
    private array $members = [
        ['id' => 1, 'nama' => 'Budi Santoso', 'nim' => '2104111001', 'email' => 'budi@student.pens.ac.id', 'nomor_telepon' => '081234567890', 'alamat' => 'Surabaya', 'status' => 'Aktif'],
        ['id' => 2, 'nama' => 'Siti Aminah', 'nim' => '2104111002', 'email' => 'siti@student.pens.ac.id', 'nomor_telepon' => '089876543210', 'alamat' => 'Sidoarjo', 'status' => 'Aktif'],
    ];

    public function index()
    {
        $members = $this->members;
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(StoreMemberRequest $request)
    {
        $validated = $request->validated();

        return redirect()->route('members.index')
            ->with('success', "Anggota \"{$validated['nama']}\" berhasil ditambahkan (data dummy, belum tersimpan ke database).");
    }

    public function show(string $id)
    {
        return "MemberController@show, id: {$id}";
    }

    public function edit(string $id)
    {
        return "MemberController@edit, id: {$id}";
    }

    public function update(Request $request, string $id)
    {
        return "MemberController@update, id: {$id}";
    }

    public function destroy(string $id)
    {
        return "MemberController@destroy, id: {$id}";
    }
}