@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
    <h1>Profil Saya</h1>

    <table>
        <tr>
            <th>Nama</th>
            <td>{{ auth()->user()->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ auth()->user()->email }}</td>
        </tr>
        <tr>
            <th>Role</th>
            <td>{{ ucfirst(auth()->user()->role) }}</td>
        </tr>
    </table>

    <h2 style="margin-top: 32px;">Ganti Password</h2>

    <form action="{{ route('profile.password') }}" method="POST" style="max-width: 400px;">
        @csrf
        @method('PUT')

        <label for="current_password">Password Lama</label>
        <input type="password" name="current_password" id="current_password">
        @error('current_password')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="password">Password Baru</label>
        <input type="password" name="password" id="password">
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="password_confirmation">Konfirmasi Password Baru</label>
        <input type="password" name="password_confirmation" id="password_confirmation">

        <button type="submit" class="btn" style="margin-top: 16px;">Simpan Password</button>
    </form>
@endsection
