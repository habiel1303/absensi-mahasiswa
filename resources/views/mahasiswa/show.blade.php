@extends('layouts.app')
@section('content')

{{-- Topbar --}}
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('mahasiswa.index') }}">Mahasiswa</a>
                </li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
        <h1 class="h3 mb-0 text-gray-800">Detail Mahasiswa</h1>
    </div>
    <div class="d-flex flex-wrap" style="gap:8px">
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="btn btn-warning btn-sm">
            <i class="fas fa-edit"></i> Edit
        </a>
    </div>
</div>

<div class="row">

    {{-- ===== KOLOM PROFIL ===== --}}
    <div class="col-lg-3 mb-4">
        <div class="card shadow h-100">
            <div class="card-body text-center">

                {{-- Foto Profil --}}
                <div class="mb-3">
                    @if($mahasiswa->foto)
                        <img src="{{ asset('storage/' . $mahasiswa->foto) }}"
                             class="rounded-circle"
                             width="100" height="100"
                             style="object-fit:cover;border:3px solid #4e73df">
                    @else
                        <div class="rounded-circle bg-primary d-flex align-items-center
                                    justify-content-center mx-auto"
                             style="width:100px;height:100px;font-size:2rem;
                                    color:#fff;font-weight:600">
                            {{ strtoupper(substr($mahasiswa->nama, 0, 2)) }}
                        </div>
                    @endif
                </div>

                <h5 class="font-weight-bold mb-1">{{ $mahasiswa->nama }}</h5>
                <p class="text-muted mb-2" style="font-size:13px">
                    {{ $mahasiswa->nim }}
                </p>
                <span class="badge badge-success px-3 py-1">Aktif</span>
            </div>

            <hr class="my-0">

            <div class="card-body p-0">
                <ul class="list-group list-group-flush" style="font-size:13px">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="text-muted">
                            <i class="fas fa-id-card mr-1"></i> NIM
                        </span>
                        <strong>{{ $mahasiswa->nim }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="text-muted">
                            <i class="fas fa-envelope mr-1"></i> Email
                        </span>
                        <strong style="font-size:12px">{{ $mahasiswa->email }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="text-muted">
                            <i class="fas fa-calendar mr-1"></i> Angkatan
                        </span>
                        <strong>{{ $mahasiswa->angkatan }}</strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- ===== KOLOM KANAN ===== --}}
    <div class="col-lg-9">

        {{-- STATISTIK KEHADIRAN --}}
        @php
            $total = $mahasiswa->absensis->count();
            $hadir = $mahasiswa->absensis->where('status','hadir')->count();
            $izin  = $mahasiswa->absensis->where('status','izin')->count();
            $sakit = $mahasiswa->absensis->where('status','sakit')->count();
            $alpha = $mahasiswa->absensis->where('status','alpha')->count();
            $pct   = $total > 0 ? round($hadir / $total * 100) : 0;
        @endphp

        <div class="row mb-4">
            <div class="col-6 col-md-2 mb-3">
                <div class="card border-left-primary shadow py-2 h-100">
                    <div class="card-body p-2 text-center">
                        <div class="text-xs text-primary font-weight-bold mb-1 text-uppercase">
                            Total
                        </div>
                        <div class="h4 mb-0 font-weight-bold text-gray-800">
                            {{ $total }}
                        </div>
                        <small class="text-muted">Pertemuan</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-2 mb-3">
                <div class="card border-left-success shadow py-2 h-100">
                    <div class="card-body p-2 text-center">
                        <div class="text-xs text-success font-weight-bold mb-1 text-uppercase">
                            Hadir
                        </div>
                        <div class="h4 mb-0 font-weight-bold text-success">
                            {{ $hadir }}
                        </div>
                        <small class="text-muted">Kali</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-2 mb-3">
                <div class="card border-left-warning shadow py-2 h-100">
                    <div class="card-body p-2 text-center">
                        <div class="text-xs text-warning font-weight-bold mb-1 text-uppercase">
                            Izin
                        </div>
                        <div class="h4 mb-0 font-weight-bold text-warning">
                            {{ $izin }}
                        </div>
                        <small class="text-muted">Kali</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-2 mb-3">
                <div class="card border-left-info shadow py-2 h-100">
                    <div class="card-body p-2 text-center">
                        <div class="text-xs text-info font-weight-bold mb-1 text-uppercase">
                            Sakit
                        </div>
                        <div class="h4 mb-0 font-weight-bold text-info">
                            {{ $sakit }}
                        </div>
                        <small class="text-muted">Kali</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-2 mb-3">
                <div class="card border-left-danger shadow py-2 h-100">
                    <div class="card-body p-2 text-center">
                        <div class="text-xs text-danger font-weight-bold mb-1 text-uppercase">
                            Alfa
                        </div>
                        <div class="h4 mb-0 font-weight-bold text-danger">
                            {{ $alpha }}
                        </div>
                        <small class="text-muted">Kali</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-2 mb-3">
                <div class="card border-left-success shadow py-2 h-100">
                    <div class="card-body p-2 text-center">
                        <div class="text-xs text-success font-weight-bold mb-1 text-uppercase">
                            % Hadir
                        </div>
                        <div class="h4 mb-0 font-weight-bold text-success">
                            {{ $pct }}%
                        </div>
                        <small class="text-muted">Kehadiran</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- MATA KULIAH YANG DIAMBIL --}}
        @php
            $matakuliahs = $mahasiswa->matakuliahs->unique('id');
        @endphp

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-book mr-1"></i> Mata Kuliah yang Diambil
                </h6>
            </div>
            <div class="card-body">
                @if($matakuliahs->isEmpty())
                    <p class="text-muted text-center py-3">
                        <i class="fas fa-inbox fa-2x d-block mb-2"></i>
                        Belum ada mata kuliah.
                    </p>
                @else
                    <div class="row">
                        @foreach($matakuliahs as $mk)
                        <div class="col-md-6 mb-3">
                            <div class="card border-left-primary h-100">
                                <div class="card-body p-3">
                                    <span class="badge badge-primary mb-1">
                                        {{ $mk->kode_mk }}
                                    </span>
                                    <h6 class="font-weight-bold mb-1">
                                        {{ $mk->nama_mk }}
                                    </h6>
                                    <small class="text-muted">
                                        <i class="fas fa-user mr-1"></i>{{ $mk->dosen }}
                                        &nbsp;|&nbsp;
                                        <i class="fas fa-layer-group mr-1"></i>{{ $mk->sks }} SKS
                                    </small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- REKAP KEHADIRAN PER MATKUL --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-chart-bar mr-1"></i> Rekap Kehadiran per Mata Kuliah
                </h6>
            </div>
            <div class="card-body">
                @if($matakuliahs->isEmpty())
                    <p class="text-muted text-center py-3">
                        <i class="fas fa-inbox fa-2x d-block mb-2"></i>
                        Belum ada data.
                    </p>
                @else
                    @foreach($matakuliahs as $mk)
                    @php
                        $mkTotal = $mahasiswa->absensis
                            ->where('matakuliah_id', $mk->id)->count();
                        $mkHadir = $mahasiswa->absensis
                            ->where('matakuliah_id', $mk->id)
                            ->where('status','hadir')->count();
                        $mkPct   = $mkTotal > 0 ? round($mkHadir / $mkTotal * 100) : 0;
                        $warna   = $mkPct >= 75 ? 'success' : ($mkPct >= 50 ? 'warning' : 'danger');
                    @endphp
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="font-weight-bold" style="font-size:13px">
                                {{ $mk->nama_mk }}
                            </span>
                            <span class="text-{{ $warna }} font-weight-bold">
                                {{ $mkPct }}%
                            </span>
                        </div>
                        <div class="progress" style="height:12px;border-radius:6px">
                            <div class="progress-bar bg-{{ $warna }}"
                                 role="progressbar"
                                 style="width:{{ $mkPct }}%"
                                 aria-valuenow="{{ $mkPct }}"
                                 aria-valuemin="0"
                                 aria-valuemax="100">
                            </div>
                        </div>
                        <small class="text-muted">
                            {{ $mkHadir }} hadir dari {{ $mkTotal }} pertemuan
                        </small>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>

        {{-- RIWAYAT ABSENSI --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-clipboard-list mr-1"></i> Riwayat Absensi
                </h6>
            </div>
            <div class="card-body">

                {{-- Form Filter --}}
                <form method="GET"
                      action="{{ route('mahasiswa.show', $mahasiswa) }}"
                      class="row mb-3">
                    <div class="col-md-4 mb-2">
                        <input type="text"
                               name="cari"
                               class="form-control form-control-sm"
                               placeholder="Cari mata kuliah..."
                               value="{{ request('cari') }}">
                    </div>
                    <div class="col-md-3 mb-2">
                        <select name="mk" class="form-control form-control-sm">
                            <option value="">Semua mata kuliah</option>
                            @foreach($matakuliahs as $mk)
                            <option value="{{ $mk->id }}"
                                {{ request('mk') == $mk->id ? 'selected' : '' }}>
                                {{ $mk->nama_mk }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <select name="status" class="form-control form-control-sm">
                            <option value="">Semua status</option>
                            @foreach(['hadir','izin','sakit','alpha'] as $s)
                            <option value="{{ $s }}"
                                {{ request('status') == $s ? 'selected' : '' }}>
                                {{ ucfirst($s) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mb-2">
                        <button type="submit" class="btn btn-primary btn-sm w-100">
                            <i class="fas fa-search"></i> Filter
                        </button>
                    </div>
                </form>

                {{-- Tabel --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover"
                           style="font-size:13px">
                        <thead style="background:#4e73df;color:white;">
                            <tr>
                                <th width="40">#</th>
                                <th>Tanggal</th>
                                <th>Mata Kuliah</th>
                                <th width="100">Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($absensis as $i => $a)
                            @php
                                $badge = [
                                    'hadir' => 'success',
                                    'izin'  => 'warning',
                                    'sakit' => 'info',
                                    'alpha' => 'danger',
                                ];
                            @endphp
                            <tr>
                                <td>{{ $absensis->firstItem() + $i }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($a->tanggal)
                                        ->format('d M Y') }}
                                </td>
                                <td>{{ $a->matakuliah->nama_mk }}</td>
                                <td>
                                    <span class="badge badge-{{ $badge[$a->status] ?? 'secondary' }}">
                                        {{ ucfirst($a->status) }}
                                    </span>
                                </td>
                                <td class="text-muted">
                                    {{ $a->keterangan ?? '-' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-2x d-block mb-2"></i>
                                    Tidak ada data absensi
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <small class="text-muted">
                        @if($absensis->total() > 0)
                            Menampilkan {{ $absensis->firstItem() }}
                            - {{ $absensis->lastItem() }}
                            dari {{ $absensis->total() }} data
                        @else
                            Tidak ada data
                        @endif
                    </small>
                    {{ $absensis->appends(request()->query())->links() }}
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
