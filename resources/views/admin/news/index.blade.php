@extends('layouts.admin')

@section('title', 'Kelola Berita')
@section('page-title', 'Berita')
@section('page-subtitle', 'Kelola artikel dan berita POSSI Bali')

@section('topbar-actions')
  <a href="{{ route('admin.news.create') }}" class="topbar-btn topbar-btn-primary">
    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M7 1v12M1 7h12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
    Tambah Berita
  </a>
@endsection

@section('content')

<div class="admin-card">
  <!-- Filter Bar -->
  <div class="admin-card-header">
    <form method="GET" class="admin-filter-bar" style="flex:1;">
      <div class="admin-search-wrap">
        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" style="flex-shrink:0; color:var(--text-muted)">
          <circle cx="6.5" cy="6.5" r="5" stroke="currentColor" stroke-width="1.4"/>
          <path d="M10 10l3 3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
        </svg>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul berita..." class="admin-search-input">
      </div>
      <select name="category" class="admin-filter-select" onchange="this.form.submit()">
        <option value="">Semua Kategori</option>
        <option value="organisasi" {{ request('category') == 'organisasi' ? 'selected' : '' }}>Organisasi</option>
        <option value="prestasi" {{ request('category') == 'prestasi' ? 'selected' : '' }}>Prestasi</option>
        <option value="edukasi" {{ request('category') == 'edukasi' ? 'selected' : '' }}>Edukasi</option>
        <option value="lingkungan" {{ request('category') == 'lingkungan' ? 'selected' : '' }}>Lingkungan</option>
      </select>
      <button type="submit" class="topbar-btn topbar-btn-primary" style="padding:8px 16px; font-size:.82rem;">Cari</button>
      @if(request()->hasAny(['search','category']))
      <a href="{{ route('admin.news.index') }}" style="font-size:.82rem; color:var(--text-muted); padding:8px 12px; border-radius:8px; border:1px solid var(--glass-border); text-decoration:none; transition:all .2s;"
         onmouseover="this.style.color='var(--ocean-white)'" onmouseout="this.style.color='var(--text-muted)'">Reset</a>
      @endif
    </form>
    <div style="font-size:.8rem; color:var(--text-muted);">{{ $news->total() }} berita</div>
  </div>

  <!-- Table -->
  <div class="admin-table-wrap">
    <table class="admin-table">
      <thead>
        <tr>
          <th style="width:40px;">#</th>
          <th>Judul Berita</th>
          <th>Kategori</th>
          <th>Penulis</th>
          <th>Waktu Baca</th>
          <th>Featured</th>
          <th>Status</th>
          <th>Dibuat</th>
          <th style="width:110px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($news as $i => $n)
        <tr>
          <td style="color:var(--text-muted); font-size:.78rem;">{{ $news->firstItem() + $i }}</td>
          <td>
            <div style="font-weight:500; color:var(--ocean-white); margin-bottom:3px;">{{ Str::limit($n->title, 55) }}</div>
            @if($n->excerpt)
            <div style="font-size:.75rem; color:var(--text-muted);">{{ Str::limit($n->excerpt, 60) }}</div>
            @endif
          </td>
          <td>
            @php
              $catColors = ['organisasi'=>'badge-info','prestasi'=>'badge-warning','edukasi'=>'badge-success','lingkungan'=>'badge-success'];
            @endphp
            <span class="badge {{ $catColors[$n->category] ?? 'badge-muted' }}">{{ $n->category }}</span>
          </td>
          <td style="font-size:.82rem; color:var(--text-muted);">{{ $n->user?->name ?? '-' }}</td>
          <td style="font-size:.82rem; color:var(--text-muted);">{{ $n->read_time }} mnt</td>
          <td>
            @if($n->is_featured)
              <span class="badge badge-warning">⭐ Ya</span>
            @else
              <span style="font-size:.75rem; color:var(--text-muted);">—</span>
            @endif
          </td>
          <td>
            @if($n->is_published)
              <span class="badge badge-success">Publik</span>
            @else
              <span class="badge badge-muted">Draft</span>
            @endif
          </td>
          <td style="font-size:.78rem; color:var(--text-muted);">{{ $n->created_at->format('d M Y') }}</td>
          <td>
            <div style="display:flex; gap:5px; align-items:center;">
              <!-- Toggle publish -->
              <form method="POST" action="{{ route('admin.news.toggle-publish', $n) }}" id="toggle-{{ $n->id }}">
                @csrf
                <button type="submit" class="action-btn action-btn-toggle" title="{{ $n->is_published ? 'Sembunyikan' : 'Publikasikan' }}">
                  @if($n->is_published)
                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><circle cx="6.5" cy="6.5" r="5" stroke="currentColor" stroke-width="1.3"/><path d="M4.5 6.5l1.5 1.5 2.5-2.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                  @else
                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><circle cx="6.5" cy="6.5" r="5" stroke="currentColor" stroke-width="1.3"/><path d="M6.5 4v5M4 6.5h5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
                  @endif
                </button>
              </form>
              <!-- Edit -->
              <a href="{{ route('admin.news.edit', $n) }}" class="action-btn action-btn-edit" title="Edit">
                <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><path d="M9 2l2 2-7 7H2V9L9 2z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/></svg>
              </a>
              <!-- Delete -->
              <button type="button" class="action-btn action-btn-delete" title="Hapus"
                      data-confirm="delete-news-{{ $n->id }}">
                <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><path d="M2 4h9M5 4V2.5h3V4M4.5 6v4M6.5 6v4M8.5 6v4M3 4l.5 7h6l.5-7H3z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
              </button>
              <form method="POST" action="{{ route('admin.news.destroy', $n) }}" id="delete-news-{{ $n->id }}" style="display:none;">
                @csrf @method('DELETE')
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="9" style="text-align:center; padding:3rem; color:var(--text-muted);">
            <div style="font-size:2rem; margin-bottom:.5rem;">📭</div>
            Belum ada berita. <a href="{{ route('admin.news.create') }}" style="color:var(--ocean-bright);">Tambah sekarang</a>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  @if($news->hasPages())
  <div class="admin-pagination">
    <span>{{ $news->firstItem() }}–{{ $news->lastItem() }} dari {{ $news->total() }}</span>
    {{ $news->links() }}
  </div>
  @endif
</div>

@endsection