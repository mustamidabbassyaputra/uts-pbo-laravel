@extends('layouts.app')
@section('title', 'Edit Barang')
@section('judul', 'Edit Barang')

@section('content')
    <form action="{{ route('barang.update', $barang['kode']) }}" method="POST">
        @csrf
        @method('PUT')
        @include('barang._form')
    </form>
@endsection