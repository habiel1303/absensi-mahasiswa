<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
public function index()
    {
        $mahasiswas = Mahasiswa::latest()->get();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'nim'      => 'required|unique:mahasiswas',
            'email'    => 'required|email|unique:mahasiswas',
            'angkatan' => 'required',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-mahasiswa', 'public');
        }

        Mahasiswa::create($data);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('absensis.matakuliah', 'matakuliahs');

        $query = $mahasiswa->absensis()->with('matakuliah');

        if (request('cari')) {
            $cari = request('cari');
            $query->whereHas('matakuliah', function($q) use ($cari) {
                $q->where('nama_mk', 'like', '%' . $cari . '%');
            });
        }

        if (request('mk')) {
            $mk = request('mk');
            $query->where('matakuliah_id', $mk);
        }

        if (request('status')) {
            $status = request('status');
            $query->where('status', $status);
        }

        $absensis = $query->latest('tanggal')->paginate(10);

        return view('mahasiswa.show', compact('mahasiswa', 'absensis'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'nim'      => 'required|unique:mahasiswas,nim,' . $mahasiswa->id,
            'email'    => 'required|email|unique:mahasiswas,email,' . $mahasiswa->id,
            'angkatan' => 'required',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            if ($mahasiswa->foto) {
                Storage::disk('public')->delete($mahasiswa->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto-mahasiswa', 'public');
        }

        $mahasiswa->update($data);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diupdate!');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        if ($mahasiswa->foto) {
            Storage::disk('public')->delete($mahasiswa->foto);
        }

        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus!');
    }
}
