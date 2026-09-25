@extends('layouts.app')

@section('content')
    <h1>Daftar Buku</h1>

    @foreach($books as $book)
        <p>{{ $book['title'] }}</p>
    @endforeach
@endsection