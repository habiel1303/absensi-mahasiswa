@extends('layouts.app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Absensi</h1>
    <a href="{{ route('absensi.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('absensi.update', $absensi) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label>Mahasiswa</label>
                <select name="mahasiswa_id" class="form-control" required>
                    @foreach($mahasiswas as $m)
                        <option value="{{ $m->id }}" {{ $absensi->mahasiswa_id == $m->id ? 'selected' : '' }}>
                            {{ $m->nim }} - {{ $m->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Mata Kuliah</label>
                <select name="matakuliah_id" class="form-control" required>
                    @foreach($matakuliahs as $mk)
                        <option value="{{ $mk->id }}" {{ $absensi->matakuliah_id == $mk->id ? 'selected' : '' }}>
                            {{ $mk->kode_mk }} - {{ $mk->nama_mk }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ $absensi->tanggal }}" required>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    @foreach(['hadir','izin','sakit','alpha'] as $s)
                        <option value="{{ $s }}" {{ $absensi->status == $s ? 'selected' : '' }}>
                            {{ ucfirst($s) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
