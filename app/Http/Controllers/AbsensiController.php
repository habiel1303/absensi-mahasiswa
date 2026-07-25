<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensis = Absensi::with(['mahasiswa', 'matakuliah'])
            ->latest()
            ->paginate(15);
        return view('absensi.index', compact('absensis'));
    }

    public function create()
    {
        $matakuliahs = Matakuliah::all();
        $mahasiswas  = Mahasiswa::orderBy('nama')->get();
        return view('absensi.create', compact('matakuliahs', 'mahasiswas'));
    }

    public function getMahasiswaByMatkul(Request $request)
    {
        $mahasiswas = Mahasiswa::orderBy('nama')->get();
        return response()->json($mahasiswas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'matakuliah_id' => 'required',
            'tanggal'       => 'required|date',
            'absensi'       => 'required|array',
        ], [
            'matakuliah_id.required' => 'Mata kuliah wajib dipilih.',
            'tanggal.required'       => 'Tanggal wajib diisi.',
            'absensi.required'       => 'Data absensi wajib diisi.',
        ]);

        foreach ($request->absensi as $mahasiswa_id => $data) {
            // Cek apakah sudah ada absensi di hari dan matkul yang sama
            $existing = Absensi::where('mahasiswa_id', $mahasiswa_id)
                ->where('matakuliah_id', $request->matakuliah_id)
                ->where('tanggal', $request->tanggal)
                ->first();

            if ($existing) {
                // Update jika sudah ada
                $existing->update([
                    'status'     => $data['status'],
                    'keterangan' => $data['keterangan'] ?? null,
                ]);
            } else {
                // Buat baru jika belum ada
                Absensi::create([
                    'mahasiswa_id'  => $mahasiswa_id,
                    'matakuliah_id' => $request->matakuliah_id,
                    'tanggal'       => $request->tanggal,
                    'status'        => $data['status'],
                    'keterangan'    => $data['keterangan'] ?? null,
                ]);
            }
        }

        return redirect()->route('absensi.index')
            ->with('success', 'Absensi berhasil disimpan!');
    }

    public function edit(Absensi $absensi)
    {
        $matakuliahs = Matakuliah::all();
        $mahasiswas  = Mahasiswa::orderBy('nama')->get();
        return view('absensi.edit', compact('absensi', 'matakuliahs', 'mahasiswas'));
    }

    public function update(Request $request, Absensi $absensi)
    {
        $request->validate([
            'mahasiswa_id'  => 'required',
            'matakuliah_id' => 'required',
            'tanggal'       => 'required|date',
            'status'        => 'required',
        ]);

        $absensi->update($request->all());

        return redirect()->route('absensi.index')
            ->with('success', 'Absensi berhasil diupdate!');
    }

    public function destroy(Absensi $absensi)
    {
        $absensi->delete();
        return redirect()->route('absensi.index')
            ->with('success', 'Absensi berhasil dihapus!');
    }
}
