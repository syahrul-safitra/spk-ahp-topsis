<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Seleksi Karyawan Terbaik - BULOG</title>
    <style>
        @page {
            margin: 1.5cm;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10px;
            color: #1e293b;
            line-height: 1.4;
            /* Sedikit lebih rapat agar efisien */
        }

        /* Header Bulog Style */
        .header {
            text-align: center;
            border-bottom: 3px solid #1d4ed8;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h3 {
            margin: 0;
            color: #1e3a8a;
            font-size: 18px;
            text-transform: uppercase;
        }

        /* Badge Method */
        .method-badge {
            display: inline-block;
            padding: 1px 6px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
        }

        .badge-ahp {
            background-color: #dbeafe;
            color: #1e40af;
            border: 1px solid #bfdbfe;
        }

        .badge-topsis {
            background-color: #fef9c3;
            color: #854d0e;
            border: 1px solid #fef08a;
        }

        h4 {
            color: #1e3a8a;
            font-size: 11px;
            border-left: 4px solid #eab308;
            padding-left: 10px;
            margin-top: 15px;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            /* Mencegah tabel terpotong di tengah baris jika ganti halaman */
            page-break-inside: auto;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        th {
            background-color: #1e3a8a;
            color: white;
            font-size: 8px;
            border: 1px solid #1e3a8a;
            padding: 8px 4px;
        }

        td {
            border: 1px solid #e2e8f0;
            padding: 6px 4px;
            text-align: center;
        }

        .rank-1 {
            background-color: #fefce8;
            font-weight: bold;
        }

        .number {
            font-family: 'Courier', monospace;
        }

        .summary-box {
            background-color: #f8fafc;
            border-radius: 8px;
            padding: 12px;
            margin-top: 10px;
            border: 1px solid #cbd5e1;
        }

        /* PERBAIKAN GRAFIK: Ukuran Penuh */
        .chart-container {
            text-align: center;
            margin-top: 20px;
            width: 100%;
        }

        .chart-image {
            width: 100% !important;
            /* Memaksa grafik memenuhi lebar kontainer */
            height: auto;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }

        .footer {
            position: fixed;
            bottom: -0.5cm;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 8px;
            color: #94a3b8;
        }
    </style>
</head>

<body>

    <div class="footer">
        Dokumen Resmi Perum BULOG | Sistem Seleksi Karyawan Terbaik (AHP-TOPSIS)
    </div>

    <div class="header">
        <h3>LAPORAN HASIL SELEKSI KARYAWAN TERBAIK</h3>
        <p>PERUM BADAN URUSAN LOGISTIK (BULOG)</p>
    </div>

    <h4>1. PENDAHULUAN</h4>
    <p>
        Laporan ini disusun menggunakan metode gabungan <strong>AHP (Analytic Hierarchy Process)</strong> untuk
        pembobotan kriteria dan <strong>TOPSIS</strong> untuk perankingan karyawan. Pendekatan ini memastikan penilaian
        dilakukan secara objektif, transparan, dan terukur berdasarkan parameter kinerja yang telah ditetapkan oleh
        Human Capital Management.
    </p>

    <h4>2. PEMBOBOTAN KRITERIA <span class="method-badge badge-ahp">AHP</span></h4>
    <table>
        <thead>
            <tr>
                <th style="width: 10%">No</th>
                <th style="width: 60%; text-align: left; padding-left: 15px;">Parameter Penilaian</th>
                <th style="width: 30%">Bobot Prioritas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($criterias as $index => $c)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="text-align: left; padding-left: 15px;">{{ $c->nama }}</td>
                    <td class="number">{{ number_format($c->bobot, 4) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>3. MATRIKS KEPUTUSAN KARYAWAN <span class="method-badge badge-topsis">TOPSIS</span></h4>
    <table>
        <thead>
            <tr>
                <th>Nama Karyawan</th>
                @foreach ($criterias as $c)
                    <th>{{ $c->nama }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($matrix as $i => $row)
                <tr>
                    <td style="font-weight: bold; text-align: left; padding-left: 5px;">{{ $alternatives[$i]->nama }}
                    </td>
                    @foreach ($row as $val)
                        <td class="number">{{ number_format($val, 2) }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>4. ANALISIS SOLUSI IDEAL <span class="method-badge badge-topsis">TOPSIS</span></h4>
    <table>
        <thead>
            <tr>
                <th style="background-color: #1e3a8a;">Kategori Solusi</th>
                @foreach ($criterias as $c)
                    <th style="background-color: #334155;">{{ $c->nama }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-weight: bold; color: #1e40af; text-align: left;">Solusi Ideal Positif (A⁺)</td>
                @foreach ($idealPositive as $val)
                    <td class="number">{{ number_format($val, 4) }}</td>
                @endforeach
            </tr>
            <tr>
                <td style="font-weight: bold; color: #b91c1c; text-align: left;">Solusi Ideal Negatif (A⁻)</td>
                @foreach ($idealNegative as $val)
                    <td class="number">{{ number_format($val, 4) }}</td>
                @endforeach
            </tr>
        </tbody>
    </table>

    <h4>5. HASIL AKHIR & PERANKINGAN <span class="method-badge badge-topsis">TOPSIS</span></h4>
    <table>
        <thead>
            <tr>
                <th style="width: 15%">Peringkat</th>
                <th style="width: 50%; text-align: left; padding-left: 15px;">Nama Karyawan</th>
                <th style="width: 35%">Skor Kedekatan (Vᵢ)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rankings as $i => $alt)
                <tr class="{{ $i == 0 ? 'rank-1' : '' }}">
                    <td>{{ $i + 1 }}</td>
                    <td style="text-align: left; padding-left: 15px;">{{ $alt->nama }}</td>
                    <td class="number">{{ number_format($alt->skor, 4) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary-box">
        <strong>REKOMENDASI:</strong> Karyawan terbaik adalah <strong>{{ $rankings[0]->nama }}</strong> (Skor:
        {{ number_format($rankings[0]->skor, 4) }}).
    </div>

    @if (!empty($chartImage))
        <div class="chart-container">
            <h4>GRAFIK VISUALISASI PERANKINGAN</h4>
            <img src="{{ $chartImage }}" class="chart-image">
        </div>
    @endif

</body>

</html>
