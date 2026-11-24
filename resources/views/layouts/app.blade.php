<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Inventaris') | StokKu</title>
    <style>
        :root { --hijau: #0f766e; --hijau-tua: #134e4a; --oranye: #f97316; --abu: #f1f5f9; }
        * { box-sizing: border-box; }
        body { font-family: "Segoe UI", Tahoma, sans-serif; margin: 0; background: var(--abu); color: #1e293b; display: flex; min-height: 100vh; }

        /* Sidebar */
        aside { width: 230px; background: var(--hijau-tua); color: #fff; padding: 24px 16px; flex-shrink: 0; }
        aside .logo { font-size: 22px; font-weight: 700; margin-bottom: 28px; letter-spacing: 1px; }
        aside .logo span { color: var(--oranye); }
        aside a { display: block; color: #cbd5e1; text-decoration: none; padding: 10px 14px; border-radius: 8px; margin-bottom: 6px; }
        aside a:hover { background: var(--hijau); color: #fff; }

        /* Area kanan */
        .wrap { flex: 1; display: flex; flex-direction: column; min-width: 0; }
        header { background: #fff; padding: 18px 32px; border-bottom: 4px solid var(--oranye); }
        header h2 { margin: 0; color: var(--hijau-tua); }
        main { flex: 1; padding: 28px 32px; }
        .card { background: #fff; padding: 24px; border-radius: 14px; box-shadow: 0 2px 10px rgba(0,0,0,.06); }
        footer { text-align: center; padding: 14px; font-size: 13px; color: #64748b; background: #fff; }

        /* Tabel */
        table { width: 100%; border-collapse: collapse; }
        th { background: var(--hijau); color: #fff; padding: 10px; text-align: left; }
        td { padding: 10px; border-bottom: 1px solid #e2e8f0; }
        tbody tr:nth-child(even) { background: #f8fafc; }
        tbody tr:hover { background: #ccfbf1; }

        /* Tombol */
        .btn { display: inline-block; padding: 7px 14px; border: 0; border-radius: 20px; color: #fff; text-decoration: none; cursor: pointer; font-size: 13px; }
        .btn-primary { background: var(--hijau); } .btn-warning { background: var(--oranye); }
        .btn-danger { background: #dc2626; } .btn-info { background: #0284c7; } .btn-secondary { background: #64748b; }

        /* Alert */
        .alert { padding: 12px 16px; border-radius: 10px; margin-bottom: 18px; border-left: 5px solid; }
        .alert-success { background: #dcfce7; color: #166534; border-color: #16a34a; }
        .alert-error { background: #fee2e2; color: #991b1b; border-color: #dc2626; }

        /* Form */
        .form-group { margin-bottom: 16px; }
        label { display: block; margin-bottom: 5px; font-weight: 600; color: var(--hijau-tua); }
        input, select { width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; }
        input:focus, select:focus { outline: 2px solid var(--hijau); }
        .err { color: #dc2626; font-size: 13px; margin-top: 3px; }

        /* Badge kondisi */
        .badge { padding: 3px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; }
        .badge-baik { background: #dcfce7; color: #166534; }
        .badge-ringan { background: #fef9c3; color: #854d0e; }
        .badge-berat { background: #fee2e2; color: #991b1b; }

        @media (max-width: 700px) { body { flex-direction: column; } aside { width: 100%; } }
    </style>
</head>
<body>
    <aside>
        <div class="logo">Stok<span>Ku</span></div>
        <a href="{{ route('barang.index') }}">📦 Daftar Barang</a>
        <a href="{{ route('barang.create') }}">➕ Tambah Barang</a>
    </aside>

    <div class="wrap">
        <header><h2>@yield('judul', 'Inventaris')</h2></header>
        <main>
            <div class="card">
                @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
                @if (session('error')) <div class="alert alert-error">{{ session('error') }}</div> @endif
                @yield('content')
            </div>
        </main>
        <footer>&copy; {{ date('Y') }} Mustamid Abbas Syaputra - 20251020027 - Universitas Catur Insan Cendekia</footer>
    </div>
</body>
</html>