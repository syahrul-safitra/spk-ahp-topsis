@extends('Admin.Layouts.main')

@section('title', 'Edit Kriteria AHP')

@section('container')
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <h5 class="mb-4">
                        <i class="bi bi-plus-circle text-primary me-2"></i>
                        Edit Kriteria AHP
                    </h5>

                    <form action="{{ url('criteria/' . $criteria->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">

                            <!-- NAMA KRITERIA -->
                            <div class="col-md-6">
                                <label class="form-label">Nama Kriteria</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" value="{{ old('nama', $criteria->nama) }}"
                                    placeholder="Contoh: Harga, Jarak, Fasilitas" autofocus>

                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- TIPE KRITERIA -->
                            <div class="col-md-6">
                                <label class="form-label">Atribut Kriteria</label>
                                <select name="atribut" class="form-select @error('tipe') is-invalid @enderror">
                                    <option value="">-- Pilih Tipe --</option>
                                    <option value="benefit"
                                        {{ old('atribut', $criteria->atribut) == 'benefit' ? 'selected' : '' }}>
                                        Benefit (semakin besar semakin baik)
                                    </option>
                                    <option value="cost"
                                        {{ old('atribut', $criteria->atribut) == 'cost' ? 'selected' : '' }}>
                                        Cost (semakin kecil semakin baik)
                                    </option>
                                </select>

                                @error('atribut')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- INFO BOBOT -->
                            <div class="col-12">
                                <div class="alert alert-info mb-0">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Bobot kriteria akan dihitung otomatis menggunakan metode
                                    <strong>AHP</strong> setelah proses perbandingan kriteria dilakukan.
                                </div>
                            </div>

                        </div>

                        <div class="d-flex justify-content-end mt-4 gap-2">
                            <a href="{{ url('criteria') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Batal
                            </a>

                            <button class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Simpan
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
