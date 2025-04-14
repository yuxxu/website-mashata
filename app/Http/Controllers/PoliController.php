<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poli;
use Illuminate\Support\Facades\Storage;


class PoliController extends Controller
{
    public function index()
    {
        $polis = Poli::all();
        return view('admin.poli.index', compact('polis'));
    }

    public function create()
    {
        return view('admin.poli.create');
    }

    public function edit($id)
    {
        $poli = Poli::findOrFail($id);
        return view('admin.poli.edit', compact('poli'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('poli_images', 'public'); // Simpan ke storage/app/public/poli_images
        }

        Poli::create([
            'nama_poli' => $request->nama_poli,
            'deskripsi' => $request->deskripsi,
            'image' => $imagePath,
        ]);

        return redirect()->route('poli.index')->with('success', 'Poli berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $poli = Poli::findOrFail($id);
    
        // Jika ada gambar baru di-upload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($poli->image) {
                Storage::delete('public/' . $poli->image);
            }
            // Simpan gambar baru dan update path-nya
            $imagePath = $request->file('image')->store('poli_images', 'public');
            $poli->image = $imagePath;
        }
    
        // Update data poli
        $poli->update([
            'nama_poli' => $request->nama_poli,
            'deskripsi' => $request->deskripsi,
            'image' => $poli->image, // Jika gambar tidak diubah, tetap pakai gambar lama
        ]);
    
        return redirect()->route('poli.index')->with('success', 'Poli berhasil diperbarui');
    }    

    public function destroy($id)
    {
        $poli = Poli::findOrFail($id);
    
        if ($poli->antrian()->exists()) {
            return redirect()->back()->with('error', 'Tidak bisa menghapus poli yang memiliki antrian.');
        }
    
        // Hapus gambar jika ada
        if ($poli->image) {
            Storage::delete('public/' . $poli->image);
        }
    
        $poli->delete();
    
        return redirect()->route('poli.index')->with('success', 'Poli berhasil dihapus.');
    }
    

}

