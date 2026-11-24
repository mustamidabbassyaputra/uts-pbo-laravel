<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    private function semua(): array
    {
        return session('barang', []);
    }

    private function aturan(): array
    {
        return [
            'nama'     => 'required|string|max:100',
            'kategori' => 'required|string|max:50',
            'lokasi'   => 'required|string|max:100',
            'jumlah'   => 'required|integer|min:0',
            'kondisi'  => 'required|in:Baik,Rusak Ringan,Rusak Berat',
        ];
    }

    public function index(Request $request)
    {
        $daftarBarang = $this->semua();
        $kataKunci = trim($request->query('q', ''));

        if ($kataKunci !== '') {
            $daftarBarang = array_filter($daftarBarang, function ($b) use ($kataKunci) {
                return stripos($b['kode'], $kataKunci) !== false
                    || stripos($b['nama'], $kataKunci) !== false
                    || stripos($b['kategori'], $kataKunci) !== false
                    || stripos($b['lokasi'], $kataKunci) !== false;
            });
        }

        return view('barang.index', compact('daftarBarang', 'kataKunci'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(['kode' => 'required|string|max:20'] + $this->aturan());

        $semua = $this->semua();
        if (isset($semua[$data['kode']])) {
            return back()->withInput()->with('error', 'Kode barang sudah dipakai.');
        }

        $semua[$data['kode']] = $data;
        session(['barang' => $semua]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show($kode)
    {
        $barang = $this->semua()[$kode] ?? null;
        if (!$barang) {
            return redirect()->route('barang.index')->with('error', 'Barang tidak ditemukan.');
        }
        return view('barang.show', compact('barang'));
    }

    public function edit($kode)
    {
        $barang = $this->semua()[$kode] ?? null;
        if (!$barang) {
            return redirect()->route('barang.index')->with('error', 'Barang tidak ditemukan.');
        }
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $kode)
    {
        $semua = $this->semua();
        if (!isset($semua[$kode])) {
            return redirect()->route('barang.index')->with('error', 'Barang tidak ditemukan.');
        }

        $data = $request->validate($this->aturan());
        $semua[$kode] = ['kode' => $kode] + $data;
        session(['barang' => $semua]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy($kode)
    {
        $semua = $this->semua();
        if (!isset($semua[$kode])) {
            return redirect()->route('barang.index')->with('error', 'Barang tidak ditemukan.');
        }

        unset($semua[$kode]);
        session(['barang' => $semua]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}