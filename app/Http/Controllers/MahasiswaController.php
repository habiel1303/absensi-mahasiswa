<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index() {
    $mahasiswas = Mahasiswa::latest()->paginate(10);
    return view('mahasiswa.index', compact('mahasiswas'));
}
public function store(Request $request) {
    $request->validate([
        'nama' => 'required', 'nim' => 'required|unique:mahasiswas',
        'email' => 'required|email|unique:mahasiswas', 'angkatan' => 'required',
    ]);
    Mahasiswa::create($request->all());
    return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan!');
}
public function edit(Mahasiswa $mahasiswa) {
    return view('mahasiswa.edit', compact('mahasiswa'));
}
public function update(Request $request, Mahasiswa $mahasiswa) {
    $request->validate([
        'nama' => 'required',
        'nim'  => 'required|unique:mahasiswas,nim,'.$mahasiswa->id,
        'email'=> 'required|email|unique:mahasiswas,email,'.$mahasiswa->id,
        'angkatan' => 'required',
    ]);
    $mahasiswa->update($request->all());
    return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil diupdate!');
}
public function destroy(Mahasiswa $mahasiswa) {
    $mahasiswa->delete();
    return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil dihapus!');
}
}
