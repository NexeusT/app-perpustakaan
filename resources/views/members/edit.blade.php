<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Anggota</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8">

<h1 class="text-3xl font-bold mb-4">Edit Anggota</h1>

<p class="mb-6">
    <a href="{{ route('members.index') }}" class="text-purple-700 underline">← Kembali ke daftar anggota</a>
</p>

<form action="{{ route('members.update', $member->id) }}" method="POST" class="space-y-4 max-w-xl">
    @csrf
    @method('PUT')

    <div>
        <label class="block font-semibold mb-1">Nama Lengkap</label>
        <input type="text" name="nama" value="{{ old('nama', $member->nama) }}"
               class="border rounded w-full px-3 py-2">
        @error('nama') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block font-semibold mb-1">NIM</label>
        <input type="text" name="nim" value="{{ old('nim', $member->nim) }}"
               class="border rounded w-full px-3 py-2">
        @error('nim') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block font-semibold mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email', $member->email) }}"
               class="border rounded w-full px-3 py-2">
        @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block font-semibold mb-1">Nomor Telepon</label>
        <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon', $member->nomor_telepon) }}"
               class="border rounded w-full px-3 py-2">
        @error('nomor_telepon') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block font-semibold mb-1">Alamat</label>
        <textarea name="alamat" class="border rounded w-full px-3 py-2">{{ old('alamat', $member->alamat) }}</textarea>
        @error('alamat') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block font-semibold mb-1">Status</label>
        <select name="status" class="border rounded w-full px-3 py-2">
            <option value="aktif" {{ old('status', $member->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="nonaktif" {{ old('status', $member->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
        </select>
        @error('status') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
</form>

</body>
</html>