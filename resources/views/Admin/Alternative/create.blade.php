@extends('Admin.Layouts.main')

@section('title', 'Tambah Alternatif (Topsis)')

@section('container')
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <h5 class="mb-4">
                        <i class="bi bi-plus-circle text-success me-2"></i>Tambah Alternatif
                    </h5>

                    <form action="{{ url('alternative') }}" method="POST">
                        @csrf

                        <div class="row g-3">

                            <!-- NAMA ALTERNATIF -->
                            <div class="col-md-6">
                                <label class="form-label">Nama Alternatif</label>
                                <input type="text" name="nama"
                                    class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}"
                                    placeholder="Contoh: Alternatif 1" autofocus>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- DESKRIPSI -->
                            <div class="col-md-6">
                                <label class="form-label">Keterangan</label>
                                <input type="text" name="keterangan"
                                    class="form-control @error('keterangan') is-invalid @enderror"
                                    value="{{ old('keterangan') }}" placeholder="keterangan alternatif (opsional)">
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- NILAI KRITERIA -->
                            <div class="col-12">
                                <h6 class="mt-3 mb-2">Nilai Kriteria</h6>
                                @foreach ($criterias as $c)
                                    <div class="mb-2 row align-items-center">
                                        <label class="col-md-3 col-form-label">{{ $c->nama }}
                                            ({{ $c->atribut }})
                                        </label>
                                        <div class="col-md-3">
                                            <input type="number" step="0.01" min="0"
                                                name="nilai[{{ $c->id }}]"
                                                class="form-control @error('nilai.' . $c->id) is-invalid @enderror"
                                                value="{{ old('nilai.' . $c->id) }}" placeholder="Masukkan nilai" required>
                                            @error('nilai.' . $c->id)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                        <div class="d-flex justify-content-end mt-4 gap-2">
                            <a href="{{ url('alternative') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Batal
                            </a>
                            <button class="btn btn-success">
                                <i class="bi bi-save me-1"></i> Simpan
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
