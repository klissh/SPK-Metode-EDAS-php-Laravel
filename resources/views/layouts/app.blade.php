<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SPK EDAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Bootstrap CSS & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #ecf0f3, #f5f7fa);
            font-family: 'Segoe UI', sans-serif;
        }
        .sidebar {
            height: 100vh;
            width: 260px;
            position: fixed;
            background: linear-gradient(160deg, #2c3e50, #34495e);
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.2);
            padding: 30px 0;
            display: flex;
            flex-direction: column;
        }
        .sidebar h4 {
            color: #f1f1f1;
            font-weight: bold;
            text-align: center;
            margin-bottom: 40px;
            font-size: 1.6rem;
        }
        .sidebar a {
            color: #bdc3c7;
            padding: 12px 30px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255, 255, 255, 0.1);
            color: #1ABC9C;
            font-weight: bold;
            border-left: 4px solid #1ABC9C;
        }
        .sidebar .btn-new-analysis {
            background: linear-gradient(135deg, #8e44ad, #9b59b6);
            color: white;
            font-weight: 600;
            text-align: center;
            margin: 30px 30px 0;
            border-radius: 10px;
            padding: 12px;
            display: block;
            text-decoration: none;
            transition: background 0.3s ease;
        }
        .sidebar .btn-new-analysis:hover {
            background: #8e44ad;
        }
        .content {
            margin-left: 260px;
            padding: 30px;
        }
        .logout-button {
            margin: 20px 30px 0;
            border-radius: 10px;
            padding: 10px;
            font-weight: bold;
            transition: 0.3s;
        }
        .logout-button:hover {
            background-color: #e74c3c;
            color: white;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <h4><i class="bi bi-graph-up"></i> SPK EDAS</h4>

            <a href="{{ route('alternatif.index') }}" class="{{ request()->is('alternatif*') ? 'active' : '' }}">
                <i class="bi bi-calculator-fill"></i>
                Data Alternatif
            </a>
            <a href="{{ route('kriteria.index') }}" class="{{ request()->is('kriteria*') ? 'active' : '' }}">
                <i class="bi bi-sliders2-vertical"></i>
                Data Kriteria
            </a>
            <a href="{{ route('nilai.index') }}" class="{{ request()->is('nilai-alternatif*') ? 'active' : '' }}">
                <i class="bi bi-pencil-square"></i>
                Nilai Alternatif
            </a>
            <a href="{{ route('edas.index') }}" class="{{ request()->is('perhitungan') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-fill"></i>
                Hasil Perhitungan
            </a>

            <!-- Tombol Aksi -->
            <a href="{{ route('pilih-jenis-analisis') }}"
               class="w-75 mx-auto d-flex align-items-center justify-content-center gap-2 fw-semibold mt-4 py-2 px-4 rounded-3 text-white bg-success bg-gradient text-decoration-none transition">
               <i class="bi bi-plus-circle"></i> Pilih Analisis
            </a>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                  class="btn btn-danger w-75 mx-auto d-flex align-items-center justify-content-center gap-2 fw-semibold mt-3 py-2 px-4 rounded-3 transition">
                  <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>

        <!-- Konten -->
        <div class="content w-100">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

</body>
</html>
