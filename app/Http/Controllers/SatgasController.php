<?php

namespace App\Http\Controllers;

use App\Models\Satgas;
use Illuminate\Http\Request;

class SatgasController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PUBLIC (FRONTEND)
    |--------------------------------------------------------------------------
    */

    public function publicIndex(Request $request)
    {
        $query = Satgas::where('is_active', true)->latest();

        $query = $this->applyFilter($query, $request);

        $satgas = $query->get();

        // BASE QUERY (biar hemat)
        $base = Satgas::where('is_active', true);

        $stats = [
            'sar'        => (clone $base)->where('unit', 'sar')->count(),
            'konservasi' => (clone $base)->where('unit', 'konservasi')->count(),
            'prestasi'   => (clone $base)->where('unit', 'prestasi')->count(),
            'regulasi'   => (clone $base)->where('unit', 'regulasi')->count(),
        ];

        return view('satgas.index', compact('satgas', 'stats'));
    }

    public function show(Satgas $satgas)
    {
        abort_if(!$satgas->is_active, 404);

        return view('satgas.show', compact('satgas'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN (BACKEND)
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = Satgas::latest();

        $query = $this->applyFilter($query, $request);

        $satgas = $query->paginate(10)->withQueryString();

        return view('admin.satgas.index', compact('satgas'));
    }

    public function create()
    {
        return view('admin.satgas.form', ['satgas' => null]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $data['certifications'] = $this->parseCertifications($request->certifications);
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
        $data = $this->validateData($request);

        $data['certifications'] = $this->parseCertifications($request->certifications);
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
            ->when($request->filled('unit') && $request->unit !== 'semua', fn($q) =>
                $q->where('unit', $request->unit)
            );
    }

    private function validateData(Request $request)
    {
        return $request->validate([
            'name'            => 'required|string|max:255',
            'role'            => 'required|string|max:255',
            'unit'            => 'required|in:sar,konservasi,prestasi,regulasi',
            'badge'           => 'nullable|string|max:100',
            'avatar_initials' => 'required|string|max:5',
            'joined_year'     => 'required|integer|min:2000|max:' . now()->year,
            'certifications'  => 'nullable|string',
            'phone'           => 'nullable|string|max:30',
            'email'           => 'nullable|email|max:255',
            'is_active'       => 'nullable|boolean',
        ]);
    }

    private function parseCertifications($certifications)
    {
        if (!empty($certifications)) {
            return array_map('trim', explode(',', $certifications));
        }

        return [];
    }
}