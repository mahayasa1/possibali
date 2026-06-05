<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClubController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PUBLIC (FRONTEND)
    |--------------------------------------------------------------------------
    */

    public function publicIndex(Request $request)
    {
        $query = Club::where('is_active', true)->latest();

        $query = $this->applyFilter($query, $request);

        $clubs = $query->get();

        // STATS (pakai base query biar hemat)
        $base = Club::where('is_active', true);

        $stats = [
            'total_clubs'   => (clone $base)->count(),
            'total_members' => (clone $base)->sum('member_count'),
            'total_areas'   => (clone $base)->distinct('area')->count('area'),
        ];

        // AREA LIST (untuk tab/filter)
        $areas = (clone $base)
            ->select('area')
            ->distinct()
            ->orderBy('area')
            ->pluck('area');

        return view('clubs.index', compact('clubs', 'stats', 'areas'));
    }

    public function show(Club $club)
    {
        abort_if(!$club->is_active, 404);

        return view('clubs.show', compact('club'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN (BACKEND)
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = Club::latest();

        $query = $this->applyFilter($query, $request);

        $clubs = $query->paginate(10)->withQueryString();

        return view('admin.clubs.index', compact('clubs'));
    }

    public function create()
    {
        return view('admin.clubs.form', ['club' => null]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $data['slug'] = Str::slug($request->name) . '-' . Str::random(4);
        $data['is_verified'] = $request->boolean('is_verified');
        $data['is_champion'] = $request->boolean('is_champion');
        $data['is_active']   = $request->boolean('is_active');

        Club::create($data);

        return redirect()->route('admin.clubs.index')
            ->with('success', 'Club berhasil ditambahkan!');
    }

    public function edit(Club $club)
    {
        return view('admin.clubs.form', compact('club'));
    }

    public function update(Request $request, Club $club)
    {
        $data = $this->validateData($request);

        $data['is_verified'] = $request->boolean('is_verified');
        $data['is_champion'] = $request->boolean('is_champion');
        $data['is_active']   = $request->boolean('is_active');

        $club->update($data);

        return redirect()->route('admin.clubs.index')
            ->with('success', 'Club berhasil diperbarui!');
    }

    public function destroy(Club $club)
    {
        $club->delete();

        return redirect()->route('admin.clubs.index')
            ->with('success', 'Club berhasil dihapus!');
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER (BIAR GAK DUPLIKASI)
    |--------------------------------------------------------------------------
    */

    private function applyFilter($query, Request $request)
    {
        return $query
            ->when($request->filled('search'), fn($q) =>
                $q->where('name', 'like', '%' . $request->search . '%')
            )
            ->when($request->filled('area') && $request->area !== 'semua', fn($q) =>
                $q->where('area', $request->area)
            );
    }

    private function validateData(Request $request)
    {
        return $request->validate([
            'name'             => 'required|string|max:255',
            'city'             => 'required|string|max:100',
            'area'             => 'required|string|max:100',
            'icon'             => 'nullable|string|max:10',
            'established_year' => 'required|integer|min:1900|max:' . now()->year,
            'member_count'     => 'required|integer|min:0',
            'specialty'        => 'nullable|string|max:255',
            'description'      => 'nullable|string',
            'contact_phone'    => 'nullable|string|max:30',
            'contact_email'    => 'nullable|email|max:255',
            'is_verified'      => 'nullable|boolean',
            'is_champion'      => 'nullable|boolean',
            'is_active'        => 'nullable|boolean',
        ]);
    }
}