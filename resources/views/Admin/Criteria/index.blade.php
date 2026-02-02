@extends('Admin.Layouts.main')

@section('title', 'Data Kriteria AHP')

@section('container')
    <div class="row">
        <div class="col-12">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">
                    <i class="bi bi-diagram-3-fill me-2 text-primary"></i>Data Kriteria (AHP)
                </h4>

                <a href="{{ url('criteria/create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>Tambah Kriteria
                </a>
            </div>

            <!-- ALERT -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- TABLE CARD -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="50">No</th>
                                    <th>Kode</th>
                                    <th>Nama Kriteria</th>
                                    <th class="text-center">Atribut</th>
                                    {{-- <th class="text-center">Bobot</th> --}}
                                    <th class="text-center" width="150">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($criterias as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td class="fw-semibold">
                                            {{ $item->kode }}
                                        </td>

                                        <td class="fw-semibold">
                                            {{ $item->nama }}
                                        </td>

                                        <td class="text-center">
                                            @if ($item->atribut == 'benefit')
                                                <span class="badge bg-success">Benefit</span>
                                            @else
                                                <span class="badge bg-danger">Cost</span>
                                            @endif
                                        </td>

                                        {{-- <td class="text-center">
                                            <span class="badge bg-primary">
                                                {{ number_format($item->bobot ?? 0, 4) }}
                                            </span>
                                        </td> --}}

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">

                                                <a href="{{ url('criteria/' . $item->id . '/edit') }}"
                                                    class="btn btn-outline-warning btn-sm" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                <form action="{{ url('criteria', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger btn-sm"
                                                        onclick="return confirm('Kriteria akan dihapus?')" title="Hapus">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                            Data kriteria belum tersedia
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
