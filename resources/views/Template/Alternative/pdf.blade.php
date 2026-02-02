<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Laporan Perhitungan TOPSIS</title>
        <style>
            /* Tipografi & Dasar */
            @page {
                margin: 2cm;
            }

            body {
                font-family: 'Helvetica', 'Arial', sans-serif;
                font-size: 11px;
                color: #334155;
                line-height: 1.5;
            }

            /* Header Style */
            .header {
                text-align: center;
                border-bottom: 3px solid #10b981;
                padding-bottom: 20px;
                margin-bottom: 30px;
            }

            .header h3 {
                margin: 0;
                color: #0f172a;
                font-size: 20px;
                text-transform: uppercase;
                letter-spacing: 2px;
            }

            .header p {
                margin: 5px 0 0;
                color: #64748b;
                font-style: italic;
            }

            /* Judul Section */
            h4 {
                color: #065f46;
                font-size: 13px;
                border-left: 4px solid #10b981;
                padding-left: 10px;
                margin-top: 25px;
                margin-bottom: 10px;
                text-transform: uppercase;
            }

            /* Tabel Design */
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
                table-layout: fixed;
                /* Mencegah tabel meluap */
            }

            th {
                background-color: #f8fafc;
                color: #475569;
                font-weight: bold;
                text-transform: uppercase;
                font-size: 9px;
                border: 1px solid #e2e8f0;
                padding: 10px 5px;
            }

            td {
                border: 1px solid #e2e8f0;
                padding: 8px 5px;
                text-align: center;
                word-wrap: break-word;
            }

            /* Highlight Row untuk Ranking 1 */
            .rank-1 {
                background-color: #ecfdf5;
                font-weight: bold;
                color: #065f46;
            }

            /* Klasifikasi Angka (Monospace-like) */
            .number {
                font-family: 'Courier', monospace;
                font-size: 10px;
            }

            /* Kesimpulan Box */
            .summary-box {
                background-color: #f1f5f9;
                border-radius: 8px;
                padding: 15px;
                margin-top: 20px;
                border: 1px solid #e2e8f0;
            }

            p {
                text-align: justify;
                margin-bottom: 10px;
            }

            /* Footer Halaman */
            .footer {
                position: fixed;
                bottom: -1cm;
                left: 0;
                right: 0;
                height: 1cm;
                text-align: right;
                font-size: 9px;
                color: #94a3b8;
                border-top: 1px solid #f1f5f9;
                padding-top: 5px;
            }
        </style>
    </head>

    <body>

        <div class="footer">Dicetak pada: {{ date("d/m/Y H:i") }} | Halaman Perhitungan TOPSIS</div>

        <div class="header">
            <h3>Laporan Hasil Analisis TOPSIS</h3>
            <p>Sistem Pendukung Keputusan Berbasis Multikriteria</p>
        </div>

        <h4>1. Pendahuluan</h4>
        <p>
            Laporan ini menyajikan hasil perhitungan menggunakan metode <strong>TOPSIS</strong> (Technique for Order
            Preference by Similarity to Ideal Solution). Metode ini memilih alternatif yang memiliki jarak terpendek
            dari solusi ideal positif dan jarak terjauh dari solusi ideal negatif.
        </p>

        <h4>2. Bobot Kriteria (Integrasi AHP)</h4>
        <table>
            <thead>
                <tr>
                    <th style="width: 10%">No</th>
                    <th style="width: 60%; text-align: left; padding-left: 15px;">Nama Kriteria</th>
                    <th style="width: 30%">Bobot Kepentingan</th>
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

        <h4>3. Ringkasan Matriks Keputusan</h4>
        <table>
            <thead>
                <tr>
                    <th>Alternatif</th>
                    @foreach ($criterias as $c)
                        <th>{{ $c->nama }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($matrix as $i => $row)
                    <tr>
                        <td style="font-weight: bold; font-size: 9px;">{{ $alternatives[$i]->nama }}</td>
                        @foreach ($row as $val)
                            <td class="number">{{ number_format($val, 2) }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="page-break-after: always;"></div>

        <h4>4. Solusi Ideal (A+ & A-)</h4>
        <table>
            <thead>
                <tr>
                    <th style="background-color: #10b981; color: white;">Jenis Solusi</th>
                    @foreach ($criterias as $c)
                        <th style="background-color: #1e293b; color: white;">{{ $c->nama }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight: bold; color: #059669;">Ideal Positif (A⁺)</td>
                    @foreach ($idealPositive as $val)
                        <td class="number">{{ number_format($val, 4) }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td style="font-weight: bold; color: #dc2626;">Ideal Negatif (A⁻)</td>
                    @foreach ($idealNegative as $val)
                        <td class="number">{{ number_format($val, 4) }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>

        <h4>5. Hasil Akhir & Perankingan</h4>
        <p>Berikut adalah urutan alternatif dari yang terbaik berdasarkan nilai preferensi:</p>
        <table>
            <thead>
                <tr>
                    <th style="width: 15%">Peringkat</th>
                    <th style="width: 50%; text-align: left; padding-left: 15px;">Nama Alternatif</th>
                    <th style="width: 35%">Skor Kedekatan (Vᵢ)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rankings as $i => $alt)
                    <tr class="{{ $i == 0 ? "rank-1" : "" }}">
                        <td>{{ $i + 1 }}</td>
                        <td style="text-align: left; padding-left: 15px;">{{ $alt->nama }}</td>
                        <td class="number">{{ number_format($alt->skor, 4) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary-box">
            <strong>Kesimpulan:</strong> Berdasarkan analisis di atas, alternatif
            <span style="color: #059669; font-weight: bold;">{{ $rankings[0]->nama }}</span>
            menempati urutan pertama dengan skor tertinggi sebesar {{ number_format($rankings[0]->skor, 4) }}.
        </div>

        @if (!empty($chartImage))
            <div style="text-align: center; margin-top: 30px;">
                <h4 style="border: none; text-align: center;">Visualisasi Perbandingan Skor</h4>
                <img src="{{ $chartImage }}"
                    style="width: 100%; height: auto; border: 1px solid #e2e8f0; border-radius: 10px;">
            </div>
        @endif

    </body>

</html>
