@extends('layouts.app')
@section('title', 'Daftar Barang')
@section('judul', 'Daftar Barang')

@section('content')
    <div style="display:flex; justify-content:space-between; gap:12px; margin-bottom:16px; flex-wrap:wrap;">
        <a href="{{ route('barang.create') }}" class="btn btn-primary">+ Tambah Barang</a>

        <form action="{{ route('barang.index') }}" method="GET" style="display:flex; gap:8px;">
            <input type="text" name="q" value="{{ $kataKunci }}" placeholder="Cari kode, nama, kategori, lokasi..." style="width:260px;">
            <button type="submit" class="btn btn-info">Cari</button>
            @if ($kataKunci !== '')
                <a href="{{ route('barang.index') }}" class="btn btn-secondary">Reset</a>
            @endif
        </form>
    </div>

    @if (count($daftarBarang) === 0)
        @if ($kataKunci !== '')
            <p>Tidak ada barang yang cocok dengan "{{ $kataKunci }}".</p>
        @else
            <p>Belum ada data barang.</p>
        @endif
    @else
        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Jumlah</th>
                    <th>Kondisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($daftarBarang as $b)
                    <tr>
                        <td>{{ $b['kode'] }}</td>
                        <td>{{ $b['nama'] }}</td>
                        <td>{{ $b['kategori'] }}</td>
                        <td>{{ $b['lokasi'] }}</td>
                        <td>{{ $b['jumlah'] }}</td>
                        <td>
                            @php
                                $kelas = match ($b['kondisi']) {
                                    'Baik' => 'badge-baik',
                                    'Rusak Ringan' => 'badge-ringan',
                                    default => 'badge-berat',
                                };
                            @endphp
                            <span class="badge {{ $kelas }}">{{ $b['kondisi'] }}</span>
                        </td>
                        <td>
                            <a href="{{ route('barang.show', $b['kode']) }}" class="btn btn-info">Detail</a>
                            <a href="{{ route('barang.edit', $b['kode']) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('barang.destroy', $b['kode']) }}" method="POST" style="display:inline"
                                  onsubmit="return confirm('Yakin hapus barang ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection