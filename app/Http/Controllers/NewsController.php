<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PUBLIC (FRONTEND)
    |--------------------------------------------------------------------------
    */

    public function publicIndex(Request $request)
    {
        $query = News::with('user')
            ->where('is_published', true)
            ->latest();

        $query = $this->applyFilter($query, $request);

        $news = $query->paginate(9)->withQueryString();

        $featured = (clone $query)->where('is_featured', true)->first()
            ?? (clone $query)->first();

        return view('news.index', compact('news', 'featured'));
    }

    public function show(News $news)
    {
        abort_if(!$news->is_published, 404);

        $related = News::where('is_published', true)
            ->where('category', $news->category)
            ->where('id', '!=', $news->id)
            ->latest()
            ->take(3)
            ->get();

        return view('news.show', compact('news', 'related'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN (BACKEND)
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = News::with('user')->latest();

        $query = $this->applyFilter($query, $request);

        $news = $query->paginate(10)->withQueryString();

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.form', ['news' => null]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $data['slug'] = Str::slug($request->title) . '-' . Str::random(4);
        $data['user_id'] = Auth::id();
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');

        News::create($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit(News $news)
    {
        return view('admin.news.form', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $data = $this->validateData($request);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');

        $news->update($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil dihapus!');
    }

    public function togglePublish(News $news)
    {
        $news->update([
            'is_published' => !$news->is_published
        ]);

        return back()->with('success', 'Status publish berhasil diubah!');
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER (BIAR GA DUPLIKASI)
    |--------------------------------------------------------------------------
    */

    private function applyFilter($query, Request $request)
    {
        return $query
            ->when($request->filled('search'), fn($q) =>
                $q->where('title', 'like', '%' . $request->search . '%')
            )
            ->when($request->filled('category') && $request->category !== 'semua', fn($q) =>
                $q->where('category', $request->category)
            );
    }

    private function validateData(Request $request)
    {
        return $request->validate([
            'title'        => 'required|string|max:255',
            'category'     => 'required|in:organisasi,prestasi,edukasi,lingkungan',
            'icon'         => 'nullable|string|max:10',
            'excerpt'      => 'nullable|string|max:500',
            'content'      => 'required|string',
            'read_time'    => 'required|integer|min:1',
            'is_featured'  => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
        ]);
    }
}