@extends('layouts.app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Mahasiswa</h1>
    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambah">
        <i class="fas fa-plus fa-sm"></i> Tambah Mahasiswa
    </button>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-primary" style="background:#4e73df;color:white;">
                    <tr>
                        <th>#</th><th>NIM</th><th>Nama</th>
                        <th>Email</th><th>Angkatan</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mahasiswas as $i => $m)
                    <tr>
                        <td>{{ $mahasiswas->firstItem() + $i }}</td>
                        <td>{{ $m->nim }}</td>
                        <td>{{ $m->nama }}</td>
                        <td>{{ $m->email }}</td>
                        <td>{{ $m->angkatan }}</td>
                        <td>
                            <a href="{{ route('mahasiswa.edit', $m) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('mahasiswa.destroy', $m) }}" method="POST" class="d-inline"
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
        {{ $mahasiswas->links() }}
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Tambah Mahasiswa</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('mahasiswa.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" name="nim" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Angkatan</label>
                        <select name="angkatan" class="form-control" required>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
