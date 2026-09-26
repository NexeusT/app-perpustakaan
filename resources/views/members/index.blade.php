<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Anggota</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8">

<h1 class="text-3xl font-bold mb-4">Daftar Anggota</h1>

@if(session('success'))
    <p class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</p>
@endif

<form action="{{ route('members.index') }}" method="GET" class="mb-4 flex gap-2">
    <input
        type="text"
        name="search"
        placeholder="Cari nama anggota..."
        value="{{ request('search') }}"
        class="border rounded px-3 py-2 w-64"
    >
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
        Cari
    </button>
</form>

<p class="mb-4">
    <a href="{{ route('members.create') }}" class="text-blue-600 underline">
        + Tambah Anggota
    </a>
</p>

<table class="w-full bg-white border rounded shadow-sm">
    <tr class="bg-gray-100 text-left">
        <th class="p-3">ID</th>
        <th class="p-3">Nama</th>
        <th class="p-3">NIM</th>
        <th class="p-3">Email</th>
        <th class="p-3">Status</th>
        <th class="p-3">Aksi</th>
    </tr>

    @forelse($members as $member)
        <tr class="border-t">
            <td class="p-3">{{ $member->id }}</td>
            <td class="p-3">{{ $member->nama }}</td>
            <td class="p-3">{{ $member->nim }}</td>
            <td class="p-3">{{ $member->email }}</td>
            <td class="p-3 capitalize">{{ $member->status }}</td>
            <td class="p-3 space-x-2">
                <a href="{{ route('members.show', $member->id) }}" class="text-blue-600">Detail</a>
                <a href="{{ route('members.edit', $member->id) }}" class="text-yellow-600">Edit</a>
                <form action="{{ route('members.destroy', $member->id) }}"
                      method="POST"
                      class="inline"
                      onsubmit="return confirm('Yakin hapus anggota ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="p-3 text-center text-gray-500">Data tidak ditemukan.</td>
        </tr>
    @endforelse
</table>

<div class="mt-4">
    {{ $members->appends(request()->query())->links() }}
</div>

</body>
</html>