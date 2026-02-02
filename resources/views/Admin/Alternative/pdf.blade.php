<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan TOPSIS</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 12px;
            line-height: 1.6;
        }

        h3,
        h4 {
            margin-top: 20px;
        }

        h3 {
            text-align: center;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0 20px 0;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background: #eee;
        }

        p {
            text-align: justify;
        }
    </style>
</head>

<body>

    <h3>Laporan Perhitungan Metode TOPSIS</h3>

    {{-- ================= PENDAHULUAN ================= --}}
    <h4>1. Pendahuluan</h4>
    <p>
        Technique for Order Preference by Similarity to Ideal Solution (TOPSIS) merupakan metode
        pengambilan keputusan multikriteria yang didasarkan pada konsep bahwa alternatif terbaik
        memiliki jarak terdekat dengan solusi ideal positif dan jarak terjauh dari solusi ideal negatif.
        Bobot kriteria pada penelitian ini diperoleh dari metode AHP.
    </p>

    {{-- ================= BOBOT KRITERIA ================= --}}
    <h4>2. Bobot Kriteria (Hasil AHP)</h4>
    <p>
        Bobot kriteria diperoleh dari hasil perhitungan Analytical Hierarchy Process (AHP) yang telah
        melalui uji konsistensi (CR ≤ 0,1). Bobot ini digunakan dalam proses pembobotan pada metode TOPSIS.
    </p>

    <table>
        <tr>
            <th>Kriteria</th>
            <th>Bobot</th>
        </tr>
        @foreach ($criterias as $c)
            <tr>
                <td>{{ $c->nama }}</td>
                <td>{{ number_format($c->bobot, 4) }}</td>
            </tr>
        @endforeach
    </table>

    {{-- ================= MATRIX KEPUTUSAN ================= --}}
    <h4>3. Matriks Keputusan</h4>
    <p>
        Matriks keputusan dibentuk berdasarkan nilai setiap alternatif terhadap masing-masing kriteria.
        Nilai ini merupakan data awal yang digunakan dalam perhitungan TOPSIS.
    </p>

    <table>
        <tr>
            <th>Alternatif</th>
            @foreach ($criterias as $c)
                <th>{{ $c->nama }}</th>
            @endforeach
        </tr>
        @foreach ($matrix as $i => $row)
            <tr>
                <td>{{ $alternatives[$i]->nama }}</td>
                @foreach ($row as $val)
                    <td>{{ number_format($val, 2) }}</td>
                @endforeach
            </tr>
        @endforeach
    </table>

    {{-- ================= NORMALISASI ================= --}}
    <h4>4. Matriks Normalisasi</h4>
    <p>
        Normalisasi matriks keputusan dilakukan menggunakan metode vector normalization dengan tujuan
        menyamakan skala antar kriteria.
    </p>

    <table>
        <tr>
            <th>Alternatif</th>
            @foreach ($criterias as $c)
                <th>{{ $c->nama }}</th>
            @endforeach
        </tr>
        @foreach ($normalized as $i => $row)
            <tr>
                <td>{{ $alternatives[$i]->nama }}</td>
                @foreach ($row as $val)
                    <td>{{ number_format($val, 4) }}</td>
                @endforeach
            </tr>
        @endforeach
    </table>

    {{-- ================= TERBOBOT ================= --}}
    <h4>5. Matriks Normalisasi Terbobot</h4>
    <p>
        Matriks normalisasi terbobot diperoleh dengan mengalikan nilai normalisasi dengan bobot kriteria
        hasil AHP.
    </p>

    <table>
        <tr>
            <th>Alternatif</th>
            @foreach ($criterias as $c)
                <th>{{ $c->nama }}</th>
            @endforeach
        </tr>
        @foreach ($weighted as $i => $row)
            <tr>
                <td>{{ $alternatives[$i]->nama }}</td>
                @foreach ($row as $val)
                    <td>{{ number_format($val, 4) }}</td>
                @endforeach
            </tr>
        @endforeach
    </table>

    {{-- ================= IDEAL ================= --}}
    <h4>6. Solusi Ideal Positif dan Negatif</h4>
    <p>
        Solusi ideal positif merupakan nilai terbaik dari setiap kriteria, sedangkan solusi ideal negatif
        merupakan nilai terburuk. Penentuan nilai terbaik dan terburuk disesuaikan dengan atribut
        benefit atau cost pada masing-masing kriteria.
    </p>

    <table>
        <tr>
            <th>Kriteria</th>
            @foreach ($criterias as $c)
                <th>{{ $c->nama }}</th>
            @endforeach
        </tr>
        <tr>
            <td>Ideal Positif (A⁺)</td>
            @foreach ($idealPositive as $val)
                <td>{{ number_format($val, 4) }}</td>
            @endforeach
        </tr>
        <tr>
            <td>Ideal Negatif (A⁻)</td>
            @foreach ($idealNegative as $val)
                <td>{{ number_format($val, 4) }}</td>
            @endforeach
        </tr>
    </table>

    {{-- ================= RANKING ================= --}}
    <h4>7. Nilai Preferensi dan Perankingan</h4>
    <p>
        Nilai preferensi dihitung berdasarkan jarak setiap alternatif terhadap solusi ideal positif dan
        negatif. Alternatif dengan nilai preferensi tertinggi merupakan alternatif terbaik.
    </p>

    <table>
        <tr>
            <th>Rank</th>
            <th>Alternatif</th>
            <th>Nilai Preferensi</th>
        </tr>
        @foreach ($rankings as $i => $alt)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $alt->nama }}</td>
                <td>{{ number_format($alt->skor, 4) }}</td>
            </tr>
        @endforeach
    </table>

    <h4>8. Kesimpulan</h4>
    <p>
        Berdasarkan hasil perhitungan metode TOPSIS, alternatif dengan nilai preferensi tertinggi
        menjadi alternatif terbaik dan direkomendasikan sebagai solusi optimal dalam pengambilan
        keputusan.
    </p>

    <h3 style="margin-top:30px;">Grafik Perangkingan TOPSIS</h3>

    @if (!empty($chartImage))
        <img src="{{ $chartImage }}" style="width:100%; max-height:350px;">
    @endif


</body>

</html>
