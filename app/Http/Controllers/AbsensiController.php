<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
class AbsensiController extends Controller
{public function index() {
    $absensis = Absensi::with(['mahasiswa','matakuliah'])->latest()->paginate(10);
    return view('absensi.index', compact('absensis'));
}
public function create() {
    $mahasiswas  = Mahasiswa::all();
    $matakuliahs = Matakuliah::all();
    return view('absensi.create', compact('mahasiswas','matakuliahs'));
}
public function store(Request $request) {
    $request->validate([
        'mahasiswa_id' => 'required', 'matakuliah_id' => 'required',
        'tanggal' => 'required|date', 'status' => 'required',
    ]);
    Absensi::create($request->all());
    return redirect()->route('absensi.index')->with('success', 'Absensi berhasil ditambahkan!');
}
public function edit(Absensi $absensi) {
    $mahasiswas  = Mahasiswa::all();
    $matakuliahs = Matakuliah::all();
    return view('absensi.edit', compact('absensi','mahasiswas','matakuliahs'));
}
public function update(Request $request, Absensi $absensi) {
    $request->validate([
        'mahasiswa_id' => 'required', 'matakuliah_id' => 'required',
        'tanggal' => 'required|date', 'status' => 'required',
    ]);
    $absensi->update($request->all());
    return redirect()->route('absensi.index')->with('success', 'Absensi berhasil diupdate!');
}
public function destroy(Absensi $absensi) {
    $absensi->delete();
    return redirect()->route('absensi.index')->with('success', 'Absensi berhasil dihapus!');
}
}
