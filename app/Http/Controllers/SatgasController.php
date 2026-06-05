<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Satgas;
use Illuminate\Http\Request;
 
class SatgasController extends Controller
{
    public function index(Request $request)
    {
        $query = Satgas::latest();
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->unit) {
            $query->where('unit', $request->unit);
        }
        $satgas = $query->paginate(10)->withQueryString();
        return view('admin.satgas.index', compact('satgas'));
    }
 
    public function create()
    {
        return view('admin.satgas.form', ['satgas' => null]);
    }
 
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'role'            => 'required|string|max:255',
            'unit'            => 'required|in:sar,konservasi,prestasi,regulasi',
            'badge'           => 'nullable|string|max:100',
            'avatar_initials' => 'required|string|max:5',
            'joined_year'     => 'required|integer|min:2000|max:' . now()->year,
            'certifications'  => 'nullable|string',
            'phone'           => 'nullable|string|max:30',
            'email'           => 'nullable|email|max:255',
            'is_active'       => 'boolean',
        ]);
 
        // Parse certifications string to array
        if (!empty($data['certifications'])) {
            $data['certifications'] = array_map('trim', explode(',', $data['certifications']));
        } else {
            $data['certifications'] = [];
        }
 
        $data['is_active'] = $request->boolean('is_active');
 
        Satgas::create($data);
 
        return redirect()->route('admin.satgas.index')
            ->with('success', 'Personel satgas berhasil ditambahkan!');
    }
 
    public function edit(Satgas $satgas)
    {
        $certString = is_array($satgas->certifications)
            ? implode(', ', $satgas->certifications)
            : '';
        return view('admin.satgas.form', compact('satgas', 'certString'));
    }
 
    public function update(Request $request, Satgas $satgas)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'role'            => 'required|string|max:255',
            'unit'            => 'required|in:sar,konservasi,prestasi,regulasi',
            'badge'           => 'nullable|string|max:100',
            'avatar_initials' => 'required|string|max:5',
            'joined_year'     => 'required|integer|min:2000|max:' . now()->year,
            'certifications'  => 'nullable|string',
            'phone'           => 'nullable|string|max:30',
            'email'           => 'nullable|email|max:255',
            'is_active'       => 'boolean',
        ]);
 
        if (!empty($data['certifications'])) {
            $data['certifications'] = array_map('trim', explode(',', $data['certifications']));
        } else {
            $data['certifications'] = [];
        }
 
        $data['is_active'] = $request->boolean('is_active');
 
        $satgas->update($data);
 
        return redirect()->route('admin.satgas.index')
            ->with('success', 'Personel satgas berhasil diperbarui!');
    }
 
    public function destroy(Satgas $satgas)
    {
        $satgas->delete();
        return redirect()->route('admin.satgas.index')
            ->with('success', 'Personel satgas berhasil dihapus!');
    }
}