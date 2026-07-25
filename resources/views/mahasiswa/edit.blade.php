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
        <form action="{{ route('mahasiswa.update', $mahasiswa) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf @method('PUT')

            {{-- Preview Foto --}}
            <div class="text-center mb-4">
                @if($mahasiswa->foto)
                    <img id="preview"
                         src="{{ asset('storage/' . $mahasiswa->foto) }}"
                         class="rounded-circle"
                         width="100" height="100"
                         style="object-fit:cover;border:3px solid #4e73df">
                @else
                    <div id="preview-inisial"
                         class="rounded-circle bg-primary d-flex align-items-center
                                justify-content-center mx-auto"
                         style="width:100px;height:100px;color:#fff;
                                font-weight:600;font-size:2rem">
                        {{ strtoupper(substr($mahasiswa->nama, 0, 2)) }}
                    </div>
                    <img id="preview" src="" style="display:none"
                         class="rounded-circle" width="100" height="100"
                         style="object-fit:cover;border:3px solid #4e73df">
                @endif
                <div class="mt-2">
                    <small class="text-muted">Foto saat ini</small>
                </div>
            </div>

            <div class="form-group">
                <label>Ganti Foto <small class="text-muted">(opsional, maks 2MB)</small></label>
                <input type="file"
                       name="foto"
                       class="form-control-file"
                       accept="image/*"
                       onchange="previewFoto(this)">
            </div>

            <div class="form-group">
                <label>NIM <span class="text-danger">*</span></label>
                <input type="text" name="nim"
                       class="form-control @error('nim') is-invalid @enderror"
                       value="{{ old('nim', $mahasiswa->nim) }}" required>
                @error('nim')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="nama"
                       class="form-control @error('nama') is-invalid @enderror"
                       value="{{ old('nama', $mahasiswa->nama) }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Email <span class="text-danger">*</span></label>
                <input type="email" name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $mahasiswa->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Angkatan <span class="text-danger">*</span></label>
                <select name="angkatan"
                        class="form-control @error('angkatan') is-invalid @enderror"
                        required>
                    <option value="">-- Pilih Angkatan --</option>
                    @foreach(['2021','2022','2023','2024'] as $thn)
                        <option value="{{ $thn }}"
                            {{ old('angkatan', $mahasiswa->angkatan) == $thn ? 'selected' : '' }}>
                            {{ $thn }}
                        </option>
                    @endforeach
                </select>
                @error('angkatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update
            </button>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
                Batal
            </a>

        </form>
    </div>
</div>

<script>
function previewFoto(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var preview = document.getElementById('preview');
            preview.src = e.target.result;
            preview.style.display = 'block';
            var inisial = document.getElementById('preview-inisial');
            if (inisial) inisial.style.display = 'none';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection
