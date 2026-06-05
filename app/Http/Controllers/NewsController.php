<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
 
class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::with('user')->latest();
 
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->category) {
            $query->where('category', $request->category);
        }
 
        $news = $query->paginate(10)->withQueryString();
        return view('admin.news.index', compact('news'));
    }
 
    public function create()
    {
        return view('admin.news.form', ['news' => null]);
    }
 
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'category'     => 'required|in:organisasi,prestasi,edukasi,lingkungan',
            'icon'         => 'nullable|string|max:10',
            'excerpt'      => 'nullable|string|max:500',
            'content'      => 'required|string',
            'read_time'    => 'required|integer|min:1',
            'is_featured'  => 'boolean',
            'is_published' => 'boolean',
        ]);
 
        $data['slug']       = Str::slug($request->title) . '-' . Str::random(4);
        $data['user_id']    = Auth::id();
        $data['is_featured']  = $request->boolean('is_featured');
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
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'category'     => 'required|in:organisasi,prestasi,edukasi,lingkungan',
            'icon'         => 'nullable|string|max:10',
            'excerpt'      => 'nullable|string|max:500',
            'content'      => 'required|string',
            'read_time'    => 'required|integer|min:1',
            'is_featured'  => 'boolean',
            'is_published' => 'boolean',
        ]);
 
        $data['is_featured']  = $request->boolean('is_featured');
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
        $news->update(['is_published' => !$news->is_published]);
        $status = $news->is_published ? 'dipublikasikan' : 'disembunyikan';
        return back()->with('success', "Berita berhasil {$status}!");
    }
}