@extends('layouts.app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Mahasiswa</h1>
    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('mahasiswa.update', $mahasiswa) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label>NIM</label>
                <input type="text" name="nim" class="form-control" value="{{ $mahasiswa->nim }}" required>
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ $mahasiswa->nama }}" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $mahasiswa->email }}" required>
            </div>
            <div class="form-group">
                <label>Angkatan</label>
                <select name="angkatan" class="form-control" required>
                    @foreach(['2021','2022','2023','2024'] as $thn)
                        <option value="{{ $thn }}" {{ $mahasiswa->angkatan == $thn ? 'selected' : '' }}>
                            {{ $thn }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
