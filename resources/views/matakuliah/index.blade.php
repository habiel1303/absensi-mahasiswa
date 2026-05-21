@extends('layouts.app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Mata Kuliah</h1>
    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambah">
        <i class="fas fa-plus fa-sm"></i> Tambah Mata Kuliah
    </button>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead style="background:#4e73df;color:white;">
                    <tr>
                        <th>#</th><th>Kode MK</th><th>Nama MK</th>
                        <th>SKS</th><th>Dosen</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($matakuliahs as $i => $mk)
                    <tr>
                        <td>{{ $matakuliahs->firstItem() + $i }}</td>
                        <td>{{ $mk->kode_mk }}</td>
                        <td>{{ $mk->nama_mk }}</td>
                        <td>{{ $mk->sks }}</td>
                        <td>{{ $mk->dosen }}</td>
                        <td>
                            <a href="{{ route('matakuliah.edit', $mk) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('matakuliah.destroy', $mk) }}" method="POST" class="d-inline"
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
        {{ $matakuliahs->links() }}
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Tambah Mata Kuliah</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('matakuliah.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode MK</label>
                        <input type="text" name="kode_mk" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama MK</label>
                        <input type="text" name="nama_mk" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>SKS</label>
                        <select name="sks" class="form-control" required>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Dosen</label>
                        <input type="text" name="dosen" class="form-control" required>
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
