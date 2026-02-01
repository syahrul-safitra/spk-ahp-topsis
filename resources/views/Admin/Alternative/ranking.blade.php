@extends('Admin.Layouts.main')

@section('title', 'Perhitungan TOPSIS')

@section('container')
    <div class="row">
        <div class="col-12">

            <h4 class="mb-3">TOPSIS Perankingan</h4>

            <h5>Matriks Keputusan</h5>
            <table class="table table-bordered text-center">
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

            <h5>Matriks Normalisasi</h5>
            <table class="table table-bordered text-center">
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
                            <td>{{ number_format($val, 3) }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </table>

            <h5>Matriks Terbobot</h5>
            <table class="table table-bordered text-center">
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

            <h5>Solusi Ideal</h5>
            <table class="table table-bordered text-center">
                <tr>
                    <th>Kriteria</th>
                    @foreach ($criterias as $c)
                        <th>{{ $c->nama }}</th>
                    @endforeach
                </tr>
                <tr>
                    <th>Ideal Positif</th>
                    @foreach ($idealPositive as $val)
                        <td>{{ number_format($val, 4) }}</td>
                    @endforeach
                </tr>
                <tr>
                    <th>Ideal Negatif</th>
                    @foreach ($idealNegative as $val)
                        <td>{{ number_format($val, 4) }}</td>
                    @endforeach
                </tr>
            </table>

            <h5>Skor & Ranking</h5>
            <table class="table table-bordered text-center">
                <tr>
                    <th>Rank</th>
                    <th>Alternatif</th>
                    <th>Skor</th>
                </tr>
                @foreach ($rankings as $i => $alt)
                    <tr @if ($i == 0) class="table-success" @endif>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $alt->nama }}</td>
                        <td>{{ number_format($alt->skor, 4) }}</td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>
@endsection
