<?php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\Kos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // ── Dashboard utama admin ──
    public function index()
    {
        return view('admin.dashboard', [
            'totalUser'    => User::count(),
            'totalPemilik' => User::where('role', 'pemilik')->count(),
            'totalPencari' => User::where('role', 'pencari')->count(),
            'totalKos'     => Kos::count(),
            'kostersedia'  => Kos::where('status', 'tersedia')->count(),
            'kosPenuh'     => Kos::where('status', 'penuh')->count(),
            'kosTerbaru'   => Kos::with('pemilik')->latest()->take(5)->get(),
        ]);
    }

    // ── Kelola semua user ──
    public function users(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(fn($q) =>
                $q->where('name', 'like', "%$s%")
                  ->orWhere('email', 'like', "%$s%")
            );
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        return view('admin.users', [
            'users' => $query->latest()->paginate(10)->withQueryString(),
        ]);
    }

    // ── Hapus user ──
    public function destroyUser(User $user)
    {
        // Cegah admin hapus dirinya sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }

    // ── Kelola semua kos ──
    public function kos(Request $request)
    {
        $query = Kos::with('pemilik');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(fn($q) =>
                $q->where('nama', 'like', "%$s%")
                  ->orWhere('lokasi', 'like', "%$s%")
            );
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return view('admin.kos', [
            'kosList' => $query->latest()->paginate(10)->withQueryString(),
        ]);
    }

    // ── Hapus kos (oleh admin) ──
    public function destroyKos(Kos $kos)
    {
        if ($kos->foto) {
            Storage::disk('public')->delete($kos->foto);
        }

        $kos->delete();

        return back()->with('success', 'Kos berhasil dihapus.');
    }
}