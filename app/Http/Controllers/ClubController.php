<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
 
class ClubController extends Controller
{
    public function index(Request $request)
    {
        $query = Club::latest();
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->area) {
            $query->where('area', $request->area);
        }
        $clubs = $query->paginate(10)->withQueryString();
        return view('admin.clubs.index', compact('clubs'));
    }
 
    public function create()
    {
        return view('admin.clubs.form', ['club' => null]);
    }
 
    public function store(Request $request)
    {
        $data = $request->validate([
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
            'is_verified'      => 'boolean',
            'is_champion'      => 'boolean',
            'is_active'        => 'boolean',
        ]);
 
        $data['slug']        = Str::slug($request->name) . '-' . Str::random(4);
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
        $data = $request->validate([
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
            'is_verified'      => 'boolean',
            'is_champion'      => 'boolean',
            'is_active'        => 'boolean',
        ]);
 
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
}