@extends('layouts.app')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Mahasiswa</h1>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambah">
            <i class="fas fa-plus fa-sm"></i> Tambah Mahasiswa
        </button>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead style="background:#4e73df;color:white;">
                        <tr>
                            <th width="50">#</th>
                            <th width="70">Foto</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Angkatan</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswas as $i => $m)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td class="text-center">
                                    @if ($m->foto)
                                        <img src="{{ asset('storage/' . $m->foto) }}" class="rounded-circle" width="40"
                                            height="40" style="object-fit:cover">
                                    @else
                                        <div class="rounded-circle bg-primary d-flex
                                            align-items-center justify-content-center mx-auto"
                                            style="width:40px;height:40px;color:#fff;
                                            font-weight:600;font-size:14px">
                                            {{ strtoupper(substr($m->nama, 0, 2)) }}
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $m->nim }}</td>
                                <td>{{ $m->nama }}</td>
                                <td>{{ $m->email }}</td>
                                <td>{{ $m->angkatan }}</td>
                                <td>
                                    <a href="{{ route('mahasiswa.show', $m) }}" class="btn btn-info btn-sm" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('mahasiswa.edit', $m) }}" class="btn btn-warning btn-sm"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('mahasiswa.destroy', $m) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-2x d-block mb-2"></i>
                                    Belum ada data mahasiswa
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ===== MODAL TAMBAH MAHASISWA ===== --}}
        <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="modalTambahLabel">
                            <i class="fas fa-user-plus mr-1"></i> Tambah Mahasiswa
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group">
                                <label>NIM <span class="text-danger">*</span></label>
                                <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror"
                                    value="{{ old('nim') }}" placeholder="Masukkan NIM" required>
                                @error('nim')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama"
                                    class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}"
                                    placeholder="Masukkan nama lengkap" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    placeholder="Masukkan email" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Angkatan <span class="text-danger">*</span></label>
                                <select name="angkatan" class="form-control @error('angkatan') is-invalid @enderror"
                                    required>
                                    <option value="">-- Pilih Angkatan --</option>
                                    @foreach (['2021', '2022', '2023', '2024'] as $thn)
                                        <option value="{{ $thn }}"
                                            {{ old('angkatan') == $thn ? 'selected' : '' }}>
                                            {{ $thn }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('angkatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- FOTO PALING BAWAH --}}
                            <div class="form-group mb-0">
                                <label>
                                    Foto
                                    <small class="text-muted">(opsional, maks 2MB)</small>
                                </label>

                                {{-- Preview Foto --}}
                                <div id="previewWrap" class="text-center mb-2" style="display:none">
                                    <img id="preview" class="rounded-circle" width="80" height="80"
                                        style="object-fit:cover;border:3px solid #4e73df">
                                    <div class="mt-1">
                                        <small class="text-muted" id="namaFile"></small>
                                    </div>

                                    <div class="custom-file">
                                        <input type="file" name="foto" id="fotoInput" class="custom-file-input"
                                            accept="image/jpg,image/jpeg,image/png" onchange="previewFoto(this)">
                                        <label class="custom-file-label" for="fotoInput">
                                            Pilih foto...
                                        </label>
                                    </div>
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Format: JPG, JPEG, PNG. Maksimal 2MB.
                                    </small>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        <i class="fas fa-times mr-1"></i> Batal
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save mr-1"></i> Simpan
                                    </button>
                                </div>
                    </form>

                </div>
            </div>

            <script>
                function previewFoto(input) {
                    var label = document.querySelector('.custom-file-label');
                    var wrap = document.getElementById('previewWrap');
                    var prev = document.getElementById('preview');
                    var nama = document.getElementById('namaFile');

                    if (input.files && input.files[0]) {
                        var file = input.files[0];

                        // Cek ukuran file max 2MB
                        if (file.size > 2 * 1024 * 1024) {
                            alert('Ukuran foto terlalu besar! Maksimal 2MB.');
                            input.value = '';
                            label.textContent = 'Pilih foto...';
                            wrap.style.display = 'none';
                            return;
                        }

                        label.textContent = file.name;
                        nama.textContent = file.name;

                        var reader = new FileReader();
                        reader.onload = function(e) {
                            prev.src = e.target.result;
                            wrap.style.display = 'block';
                        }
                        reader.readAsDataURL(file);
                    }
                }

                // Reset modal saat ditutup
                document.getElementById('modalTambah').addEventListener('hidden.bs.modal', function() {
                    document.getElementById('previewWrap').style.display = 'none';
                    document.getElementById('preview').src = '';
                    document.querySelector('.custom-file-label').textContent = 'Pilih foto...';
                });
            </script>
        @endsection
