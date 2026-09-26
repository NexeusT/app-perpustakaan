<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Anggota</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8">

<h1 class="text-3xl font-bold mb-4">Detail Anggota</h1>

<p class="mb-6">
    <a href="{{ route('members.index') }}" class="text-purple-700 underline">← Kembali ke daftar anggota</a>
</p>

<div class="bg-white border rounded shadow-sm p-6 max-w-xl space-y-2">
    <p><span class="font-semibold">Nama:</span> {{ $member->nama }}</p>
    <p><span class="font-semibold">NIM:</span> {{ $member->nim }}</p>
    <p><span class="font-semibold">Email:</span> {{ $member->email }}</p>
    <p><span class="font-semibold">Nomor Telepon:</span> {{ $member->nomor_telepon }}</p>
    <p><span class="font-semibold">Alamat:</span> {{ $member->alamat }}</p>
    <p><span class="font-semibold">Status:</span> <span class="capitalize">{{ $member->status }}</span></p>
</div>

</body>
</html>