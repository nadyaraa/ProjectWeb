<?php
// app/Http/Controllers/PencariController.php

namespace App\Http\Controllers;

use App\Models\Kos;
use Illuminate\Http\Request;

class PencariController extends Controller
{
    // ── Daftar semua kos (dengan filter & search) ──
    public function index(Request $request)
    {
        $query = Kos::with('pemilik');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(fn($q) =>
                $q->where('nama',   'like', "%$s%")
                  ->orWhere('lokasi', 'like', "%$s%")
            );
        }

        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('harga_max')) {
            $query->where('harga', '<=', $request->harga_max);
        }

        // Default: tampilkan yang tersedia dulu
        $query->orderByRaw("CASE WHEN status = 'tersedia' THEN 1 WHEN status = 'penuh' THEN 2 ELSE 3 END")
            ->latest();

        return view('pencari.index', [
            'kosList'      => $query->paginate(9)->withQueryString(),
            'totalKos'     => Kos::count(),
            'kosTersedia'  => Kos::where('status', 'tersedia')->count(),
        ]);
    }

    // ── Detail satu kos ──
    public function show(Kos $kos)
    {
        $kos->load('pemilik');

        // Rekomendasi: kos lain di lokasi yang sama, maks 3
        $rekomendasi = Kos::with('pemilik')
            ->where('id', '!=', $kos->id)
            ->where('lokasi', 'like', '%' . explode(',', $kos->lokasi)[0] . '%')
            ->where('status', 'tersedia')
            ->take(3)
            ->get();

        return view('pencari.show', compact('kos', 'rekomendasi'));
    }
}