@php $isEdit = isset($barang); @endphp

<div class="form-group">
    <label>Kode</label>
    <input type="text" name="kode" value="{{ old('kode', $barang['kode'] ?? '') }}" {{ $isEdit ? 'readonly' : '' }}>
    @error('kode') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="form-group">
    <label>Nama Barang</label>
    <input type="text" name="nama" value="{{ old('nama', $barang['nama'] ?? '') }}">
    @error('nama') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="form-group">
    <label>Kategori</label>
    <input type="text" name="kategori" value="{{ old('kategori', $barang['kategori'] ?? '') }}">
    @error('kategori') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="form-group">
    <label>Lokasi</label>
    <input type="text" name="lokasi" value="{{ old('lokasi', $barang['lokasi'] ?? '') }}">
    @error('lokasi') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="form-group">
    <label>Jumlah</label>
    <input type="number" name="jumlah" min="0" value="{{ old('jumlah', $barang['jumlah'] ?? '') }}">
    @error('jumlah') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="form-group">
    <label>Kondisi</label>
    @php $kondisi = old('kondisi', $barang['kondisi'] ?? ''); @endphp
    <select name="kondisi">
        @foreach (['Baik', 'Rusak Ringan', 'Rusak Berat'] as $k)
            <option value="{{ $k }}" {{ $kondisi === $k ? 'selected' : '' }}>{{ $k }}</option>
        @endforeach
    </select>
    @error('kondisi') <div class="err">{{ $message }}</div> @enderror
</div>
<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>