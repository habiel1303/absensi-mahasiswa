@extends('layouts.app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Absensi</h1>
    <a href="{{ route('absensi.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('absensi.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Mahasiswa</label>
                <select name="mahasiswa_id" class="form-control" required>
                    <option value="">-- Pilih Mahasiswa --</option>
                    @foreach($mahasiswas as $m)
                        <option value="{{ $m->id }}">{{ $m->nim }} - {{ $m->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Mata Kuliah</label>
                <select name="matakuliah_id" class="form-control" required>
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach($matakuliahs as $mk)
                        <option value="{{ $mk->id }}">{{ $mk->kode_mk }} - {{ $mk->nama_mk }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="hadir">Hadir</option>
                    <option value="izin">Izin</option>
                    <option value="sakit">Sakit</option>
                    <option value="alpha">Alpha</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
