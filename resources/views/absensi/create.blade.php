@extends('layouts.app')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('absensi.index') }}">Absensi</a>
                </li>
                <li class="breadcrumb-item active">Input Absensi</li>
            </ol>
        </nav>
        <h1 class="h3 mb-0 text-gray-800">Input Absensi per Kelas</h1>
    </div>
    <a href="{{ route('absensi.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

{{-- Form Pilih Matkul & Tanggal --}}
<div class="card shadow mb-4">
    <div class="card-header py-3 bg-primary">
        <h6 class="m-0 font-weight-bold text-white">
            <i class="fas fa-filter mr-1"></i> Pilih Mata Kuliah & Tanggal
        </h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5 mb-3">
                <label class="font-weight-bold">Mata Kuliah <span class="text-danger">*</span></label>
                <select id="pilihMatkul" class="form-control">
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach($matakuliahs as $mk)
                        <option value="{{ $mk->id }}"
                                data-kode="{{ $mk->kode_mk }}"
                                data-nama="{{ $mk->nama_mk }}"
                                data-dosen="{{ $mk->dosen }}"
                                data-sks="{{ $mk->sks }}">
                            {{ $mk->kode_mk }} - {{ $mk->nama_mk }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label class="font-weight-bold">Tanggal <span class="text-danger">*</span></label>
                <input type="date"
                       id="pilihTanggal"
                       class="form-control"
                       value="{{ date('Y-m-d') }}">
            </div>
            <div class="col-md-2 mb-3 d-flex align-items-end">
                <button type="button"
                        class="btn btn-primary w-100"
                        onclick="tampilkanDaftar()">
                    <i class="fas fa-users mr-1"></i> Tampilkan
                </button>
            </div>
            <div class="col-md-2 mb-3 d-flex align-items-end">
                <button type="button"
                        class="btn btn-success w-100"
                        onclick="hadirSemua()">
                    <i class="fas fa-check-double mr-1"></i> Hadir Semua
                </button>
            </div>
        </div>

        {{-- Info Matkul --}}
        <div id="infoMatkul" style="display:none">
            <div class="alert alert-info py-2 mb-0">
                <i class="fas fa-info-circle mr-1"></i>
                <span id="infoMatkulText"></span>
            </div>
        </div>
    </div>
</div>

{{-- Form Absensi --}}
<form action="{{ route('absensi.store') }}" method="POST" id="formAbsensi">
    @csrf
    <input type="hidden" name="matakuliah_id" id="matkulId">
    <input type="hidden" name="tanggal" id="tanggalInput">

    <div id="tabelAbsensi" style="display:none">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-clipboard-list mr-1"></i>
                    Daftar Hadir — <span id="headerMatkul"></span>
                    — <span id="headerTanggal"></span>
                </h6>
                <span class="badge badge-primary" id="totalMahasiswa"></span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0"
                           style="font-size:13px">
                        <thead style="background:#4e73df;color:white;">
                            <tr>
                                <th width="50">#</th>
                                <th width="80">Foto</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th width="200">Status Kehadiran</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody id="bodyAbsensi"></tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div>
                    <span class="badge badge-success px-3 py-2" id="countHadir">Hadir: 0</span>
                    <span class="badge badge-warning px-3 py-2 ml-1" id="countIzin">Izin: 0</span>
                    <span class="badge badge-info px-3 py-2 ml-1" id="countSakit">Sakit: 0</span>
                    <span class="badge badge-danger px-3 py-2 ml-1" id="countAlpha">Alpha: 0</span>
                </div>
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save mr-1"></i> Simpan Absensi
                </button>
            </div>
        </div>
    </div>

    {{-- Pesan jika belum pilih --}}
    <div id="pesanPilih" class="text-center py-5">
        <i class="fas fa-hand-point-up fa-3x text-muted mb-3 d-block"></i>
        <p class="text-muted">Pilih mata kuliah dan tanggal terlebih dahulu,<br>
        lalu klik tombol <strong>Tampilkan</strong></p>
    </div>

</form>

{{-- Data mahasiswa (hidden) --}}
<script>
var mahasiswas = @json($mahasiswas);

function tampilkanDaftar() {
    var matkulId  = document.getElementById('pilihMatkul').value;
    var tanggal   = document.getElementById('pilihTanggal').value;
    var matkulOpt = document.getElementById('pilihMatkul')
                            .options[document.getElementById('pilihMatkul').selectedIndex];

    if (!matkulId) {
        alert('Pilih mata kuliah terlebih dahulu!');
        return;
    }
    if (!tanggal) {
        alert('Pilih tanggal terlebih dahulu!');
        return;
    }

    // Set hidden input
    document.getElementById('matkulId').value    = matkulId;
    document.getElementById('tanggalInput').value = tanggal;

    // Info matkul
    var namaMatku = matkulOpt.getAttribute('data-nama');
    var dosen     = matkulOpt.getAttribute('data-dosen');
    var sks       = matkulOpt.getAttribute('data-sks');
    document.getElementById('infoMatkulText').innerHTML =
        '<strong>' + namaMatku + '</strong> | Dosen: ' + dosen + ' | SKS: ' + sks;
    document.getElementById('infoMatkul').style.display = 'block';

    // Header tabel
    document.getElementById('headerMatkul').textContent = namaMatku;
    document.getElementById('headerTanggal').textContent = tanggal;
    document.getElementById('totalMahasiswa').textContent = mahasiswas.length + ' Mahasiswa';

    // Generate tabel
    var tbody = document.getElementById('bodyAbsensi');
    tbody.innerHTML = '';

    mahasiswas.forEach(function(m, i) {
        var foto = m.foto
            ? '<img src="/storage/' + m.foto + '" class="rounded-circle" width="35" height="35" style="object-fit:cover">'
            : '<div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mx-auto" style="width:35px;height:35px;color:#fff;font-weight:600;font-size:12px">' + m.nama.substring(0,2).toUpperCase() + '</div>';

        tbody.innerHTML += `
        <tr id="row-${m.id}">
            <td>${i + 1}</td>
            <td class="text-center">${foto}</td>
            <td>${m.nim}</td>
            <td><strong>${m.nama}</strong><br><small class="text-muted">${m.angkatan}</small></td>
            <td>
                <div class="d-flex" style="gap:6px;flex-wrap:wrap">
                    <label class="btn btn-sm btn-outline-success mb-0 status-btn" onclick="setStatus(${m.id},'hadir',this)">
                        <input type="radio" name="absensi[${m.id}][status]" value="hadir" style="display:none"> ✓ Hadir
                    </label>
                    <label class="btn btn-sm btn-outline-warning mb-0 status-btn" onclick="setStatus(${m.id},'izin',this)">
                        <input type="radio" name="absensi[${m.id}][status]" value="izin" style="display:none"> 📋 Izin
                    </label>
                    <label class="btn btn-sm btn-outline-info mb-0 status-btn" onclick="setStatus(${m.id},'sakit',this)">
                        <input type="radio" name="absensi[${m.id}][status]" value="sakit" style="display:none"> 🤒 Sakit
                    </label>
                    <label class="btn btn-sm btn-outline-danger mb-0 status-btn" onclick="setStatus(${m.id},'alpha',this)">
                        <input type="radio" name="absensi[${m.id}][status]" value="alpha" style="display:none"> ✗ Alpha
                    </label>
                </div>
            </td>
            <td>
                <input type="text"
                       name="absensi[${m.id}][keterangan]"
                       class="form-control form-control-sm"
                       placeholder="Keterangan (opsional)">
            </td>
        </tr>`;
    });

    // Default semua hadir
    hadirSemua();

    // Tampilkan tabel
    document.getElementById('tabelAbsensi').style.display = 'block';
    document.getElementById('pesanPilih').style.display   = 'none';
}

function setStatus(id, status, el) {
    // Reset semua button di baris ini
    var row = document.getElementById('row-' + id);
    var btns = row.querySelectorAll('.status-btn');
    btns.forEach(function(b) {
        b.classList.remove('btn-success','btn-warning','btn-info','btn-danger');
        b.classList.remove('active');
    });

    // Set aktif
    var colorMap = {
        'hadir': 'btn-success',
        'izin':  'btn-warning',
        'sakit': 'btn-info',
        'alpha': 'btn-danger'
    };
    el.classList.add(colorMap[status], 'active');

    // Check radio
    var radio = el.querySelector('input[type=radio]');
    if (radio) radio.checked = true;

    updateCounter();
}

function hadirSemua() {
    mahasiswas.forEach(function(m) {
        var row  = document.getElementById('row-' + m.id);
        if (!row) return;
        var btns = row.querySelectorAll('.status-btn');
        btns.forEach(function(b) {
            b.classList.remove('btn-success','btn-warning','btn-info','btn-danger','active');
        });
        var hadirBtn = row.querySelector('.btn-outline-success');
        if (hadirBtn) {
            hadirBtn.classList.add('btn-success', 'active');
            var radio = hadirBtn.querySelector('input[type=radio]');
            if (radio) radio.checked = true;
        }
    });
    updateCounter();
}

function updateCounter() {
    var hadir = 0, izin = 0, sakit = 0, alpha = 0;
    document.querySelectorAll('input[type=radio]:checked').forEach(function(r) {
        if (r.value === 'hadir') hadir++;
        else if (r.value === 'izin')  izin++;
        else if (r.value === 'sakit') sakit++;
        else if (r.value === 'alpha') alpha++;
    });
    document.getElementById('countHadir').textContent = 'Hadir: ' + hadir;
    document.getElementById('countIzin').textContent  = 'Izin: '  + izin;
    document.getElementById('countSakit').textContent = 'Sakit: ' + sakit;
    document.getElementById('countAlpha').textContent = 'Alpha: ' + alpha;
}

// Validasi sebelum submit
document.getElementById('formAbsensi').addEventListener('submit', function(e) {
    var matkulId = document.getElementById('matkulId').value;
    var tanggal  = document.getElementById('tanggalInput').value;
    if (!matkulId || !tanggal) {
        e.preventDefault();
        alert('Pilih mata kuliah dan tanggal terlebih dahulu!');
        return;
    }

    var radios = document.querySelectorAll('input[type=radio]:checked');
    if (radios.length === 0) {
        e.preventDefault();
        alert('Belum ada data absensi yang diisi!');
        return;
    }
});
</script>

@endsection
