@extends('layouts.app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Mata Kuliah</h1>
    <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('matakuliah.update', $matakuliah) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label>Kode MK</label>
                <input type="text" name="kode_mk" class="form-control" value="{{ $matakuliah->kode_mk }}" required>
            </div>
            <div class="form-group">
                <label>Nama MK</label>
                <input type="text" name="nama_mk" class="form-control" value="{{ $matakuliah->nama_mk }}" required>
            </div>
            <div class="form-group">
                <label>SKS</label>
                <select name="sks" class="form-control">
                    @foreach([2,3,4] as $sks)
                        <option value="{{ $sks }}" {{ $matakuliah->sks == $sks ? 'selected' : '' }}>{{ $sks }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Dosen</label>
                <input type="text" name="dosen" class="form-control" value="{{ $matakuliah->dosen }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
