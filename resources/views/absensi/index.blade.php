@extends('layouts.app')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Absensi</h1>
    <a href="{{ route('absensi.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus mr-1"></i> Input Absensi
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" style="font-size:13px">
                <thead style="background:#4e73df;color:white;">
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Mahasiswa</th>
                        <th>NIM</th>
                        <th>Mata Kuliah</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($absensis as $i => $a)
                    @php
                        $badge = [
                            'hadir' => 'success',
                            'izin'  => 'warning',
                            'sakit' => 'info',
                            'alpha' => 'danger',
                        ];
                    @endphp
                    <tr>
                        <td>{{ $absensis->firstItem() + $i }}</td>
                        <td>{{ \Carbon\Carbon::parse($a->tanggal)->format('d M Y') }}</td>
                        <td>{{ $a->mahasiswa->nama }}</td>
                        <td>{{ $a->mahasiswa->nim }}</td>
                        <td>{{ $a->matakuliah->nama_mk }}</td>
                        <td>
                            <span class="badge badge-{{ $badge[$a->status] ?? 'secondary' }}">
                                {{ ucfirst($a->status) }}
                            </span>
                        </td>
                        <td class="text-muted">{{ $a->keterangan ?? '-' }}</td>
                        <td>
                            <a href="{{ route('absensi.edit', $a) }}"
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('absensi.destroy', $a) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-2x d-block mb-2"></i>
                            Belum ada data absensi
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $absensis->links() }}
    </div>
</div>

@endsection
