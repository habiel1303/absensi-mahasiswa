<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah;

class MatakuliahController extends Controller
{public function index() {
    $matakuliahs = Matakuliah::latest()->paginate(10);
    return view('matakuliah.index', compact('matakuliahs'));
}
public function store(Request $request) {
    $request->validate([
        'kode_mk' => 'required|unique:matakuliahs',
        'nama_mk' => 'required', 'sks' => 'required', 'dosen' => 'required',
    ]);
    Matakuliah::create($request->all());
    return redirect()->route('matakuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan!');
}
public function edit(Matakuliah $matakuliah) {
    return view('matakuliah.edit', compact('matakuliah'));
}
public function update(Request $request, Matakuliah $matakuliah) {
    $request->validate([
        'kode_mk' => 'required|unique:matakuliahs,kode_mk,'.$matakuliah->id,
        'nama_mk' => 'required', 'sks' => 'required', 'dosen' => 'required',
    ]);
    $matakuliah->update($request->all());
    return redirect()->route('matakuliah.index')->with('success', 'Data berhasil diupdate!');
}
public function destroy(Matakuliah $matakuliah) {
    $matakuliah->delete();
    return redirect()->route('matakuliah.index')->with('success', 'Data berhasil dihapus!');
}
}
