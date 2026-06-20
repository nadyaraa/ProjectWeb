<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KosController extends Controller
{
    // INDEX — Halaman daftar kos milik pemilik yang login
    public function index(Request $request)
    {
        $query = Kos::where('user_id', Auth::id());

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(fn($q) =>
                $q->where('nama', 'like', "%$s%")
                  ->orWhere('lokasi', 'like', "%$s%")
            );
        }

        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return view('kos.index', [
            'kosList' => $query->oldest()->paginate(9)->withQueryString(),
        ]);
    }

    // CREATE — Form tambah kos baru
    public function create()
    {
        return view('kos.create');
    }

    // STORE — Simpan kos baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'         => 'required|string|max:255',
            'tipe'         => 'required|in:Kos Putra,Kos Putri,Kos Campur',
            'lokasi'       => 'required|string|max:255',
            'harga'        => 'required|integer|min:0',
            'jumlah_kamar' => 'required|integer|min:1',
            'status'       => 'required|in:tersedia,penuh',
            'deskripsi'    => 'nullable|string|max:1000',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')
                                         ->store('kos', 'public');
        }

        $validated['user_id'] = Auth::id();

        Kos::create($validated);

        return redirect()->route('kos.index')
                         ->with('success', 'Kos berhasil ditambahkan!');
    }

    // SHOW — Halaman detail satu kos
    public function show(Kos $kos)
    {
        $this->authorizeOwner($kos);

        return view('kos.show', compact('kos'));
    }

    // EDIT — Form edit kos
    public function edit(Kos $kos)
    {
        $this->authorizeOwner($kos);

        return view('kos.edit', compact('kos'));
    }

    // UPDATE — Simpan perubahan kos ke database
    public function update(Request $request, Kos $kos)
    {
        $this->authorizeOwner($kos);

        $validated = $request->validate([
            'nama'         => 'required|string|max:255',
            'tipe'         => 'required|in:Kos Putra,Kos Putri,Kos Campur',
            'lokasi'       => 'required|string|max:255',
            'harga'        => 'required|integer|min:0',
            'jumlah_kamar' => 'required|integer|min:1',
            'status'       => 'required|in:tersedia,penuh',
            'deskripsi'    => 'nullable|string|max:1000',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // 🌟 BARIS PENYELAMAT: Amankan data gambar lama dari ancaman nilai null
        unset($validated['foto']);

        // Ganti foto lama jika ada upload foto baru
        if ($request->hasFile('foto')) {
            if ($kos->foto) {
                Storage::disk('public')->delete($kos->foto);
            }
            $validated['foto'] = $request->file('foto')->store('kos', 'public');
        } 
        // Jika tidak ada foto baru tapi user klik "Hapus Foto"
        elseif ($request->input('hapus_foto') == '1') {
            if ($kos->foto) {
                Storage::disk('public')->delete($kos->foto); 
            }
            $validated['foto'] = null; 
        }

        $kos->update($validated);

        return redirect()->route('kos.index')
                         ->with('success', 'Kos berhasil diperbarui!');
    }

    // DESTROY — Hapus kos dari database
    public function destroy(Kos $kos)
    {
        $this->authorizeOwner($kos);

        // Hapus foto dari storage sebelum hapus record
        if ($kos->foto) {
            Storage::disk('public')->delete($kos->foto);
        }

        $kos->delete();

        return redirect()->route('kos.index')
                         ->with('success', 'Kos berhasil dihapus.');
    }

    // HELPER — Cegah pemilik kos mengakses data milik user lain
    private function authorizeOwner(Kos $kos): void
    {
        if ($kos->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak. Anda bukan pemilik kos ini.');
        }
    }
}