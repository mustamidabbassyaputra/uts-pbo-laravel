@extends('layouts.app')
@section('title', 'Tambah Barang')
@section('judul', 'Tambah Barang')

@section('content')
    <form action="{{ route('barang.store') }}" method="POST">
        @csrf
        @include('barang._form')
    </form>
@endsection