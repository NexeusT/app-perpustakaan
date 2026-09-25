@extends('layouts.app')

@section('content')
    <h1>Daftar Kategori</h1>

    @foreach($categories as $category)
        <p>{{ $category['name'] }}</p>
    @endforeach
@endsection