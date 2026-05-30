<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Redirect ke halaman sesuai role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'pencari') {
            return redirect()->route('pencari.index');
        }

        // Default: pemilik kos
        $query = Kos::where('user_id', $user->id);

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

        return view('dashboard.pemilik', [
            'kosList'         => $query->oldest()->paginate(10)->withQueryString(),
            'totalProperti'   => Kos::where('user_id', $user->id)->count(),
            'kamarTersedia'   => Kos::where('user_id', $user->id)->where('status', 'tersedia')->count(),
            'totalPengunjung' => 0,
        ]);
    }
}