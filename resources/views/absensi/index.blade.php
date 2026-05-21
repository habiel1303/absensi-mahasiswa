@extends('layouts.app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Absensi</h1>
    <a href="{{ route('absensi.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus fa-sm"></i> Tambah Absensi
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead style="background:#4e73df;color:white;">
                    <tr>
                        <th>#</th><th>Mahasiswa</th><th>NIM</th>
                        <th>Mata Kuliah</th><th>Tanggal</th><th>Status</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($absensis as $i => $a)
                    <tr>
                        <td>{{ $absensis->firstItem() + $i }}</td>
                        <td>{{ $a->mahasiswa->nama }}</td>
                        <td>{{ $a->mahasiswa->nim }}</td>
                        <td>{{ $a->matakuliah->nama_mk }}</td>
                        <td>{{ $a->tanggal }}</td>
                        <td>
                            @php
                                $badge = [
                                    'hadir' => 'success',
                                    'izin'  => 'info',
                                    'sakit' => 'warning',
                                    'alpha' => 'danger',
                                ];
                            @endphp
                            <span class="badge badge-{{ $badge[$a->status] }}">
                                {{ strtoupper($a->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('absensi.edit', $a) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('absensi.destroy', $a) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $absensis->links() }}
    </div>
</div>
@endsection
