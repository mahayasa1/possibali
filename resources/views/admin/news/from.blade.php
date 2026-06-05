@extends('layouts.admin')

@section('title', $news ? 'Edit Berita' : 'Tambah Berita')
@section('page-title', $news ? 'Edit Berita' : 'Tambah Berita')
@section('page-subtitle', $news ? 'Perbarui informasi berita' : 'Buat berita baru')

@section('topbar-actions')
  <a href="{{ route('admin.news.index') }}" style="font-size:.82rem; color:var(--text-muted); padding:7px 14px; border-radius:8px; border:1px solid var(--glass-border); text-decoration:none; display:inline-flex; align-items:center; gap:6px; transition:all .2s;"
     onmouseover="this.style.borderColor='var(--ocean-bright)'; this.style.color='var(--ocean-white)'"
     onmouseout="this.style.borderColor='var(--glass-border)'; this.style.color='var(--text-muted)'">
    ← Kembali
  </a>
@endsection

@section('content')

<form method="POST" action="{{ $news ? route('admin.news.update', $news) : route('admin.news.store') }}">
  @csrf
  @if($news) @method('PUT') @endif

  <div style="display:grid; grid-template-columns:1fr 320px; gap:1.5rem; align-items:start;">

    <!-- Left -->
    <div style="display:flex; flex-direction:column; gap:1.25rem;">
      <div class="admin-card">
        <div class="admin-card-header"><div class="admin-card-title">Informasi Berita</div></div>
        <div class="admin-card-body">

          <div class="admin-form-group">
            <label class="admin-form-label">Judul Berita <span class="req">*</span></label>
            <input type="text" name="title" value="{{ old('title', $news?->title) }}"
                   class="admin-input {{ $errors->has('title') ? 'is-invalid' : '' }}"
                   placeholder="Masukkan judul berita...">
            @error('title')<div class="admin-form-error">{{ $message }}</div>@enderror
          </div>

          <div class="admin-form-group">
            <label class="admin-form-label">Ringkasan / Excerpt</label>
            <textarea name="excerpt" rows="2" class="admin-input {{ $errors->has('excerpt') ? 'is-invalid' : '' }}"
                      placeholder="Ringkasan singkat berita (opsional)...">{{ old('excerpt', $news?->excerpt) }}</textarea>
            @error('excerpt')<div class="admin-form-error">{{ $message }}</div>@enderror
          </div>

          <div class="admin-form-group">
            <label class="admin-form-label">Konten <span class="req">*</span></label>
            <textarea name="content" rows="12" class="admin-input {{ $errors->has('content') ? 'is-invalid' : '' }}"
                      placeholder="Tulis konten berita lengkap di sini...">{{ old('content', $news?->content) }}</textarea>
            @error('content')<div class="admin-form-error">{{ $message }}</div>@enderror
          </div>

        </div>
      </div>
    </div>

    <!-- Right Sidebar -->
    <div style="display:flex; flex-direction:column; gap:1.25rem; position:sticky; top:80px;">

      <div class="admin-card">
        <div class="admin-card-header"><div class="admin-card-title">Pengaturan</div></div>
        <div class="admin-card-body" style="display:flex; flex-direction:column; gap:1.1rem;">

          <div class="admin-form-group" style="margin:0;">
            <label class="admin-form-label">Kategori <span class="req">*</span></label>
            <select name="category" class="admin-input {{ $errors->has('category') ? 'is-invalid' : '' }}">
              <option value="">Pilih kategori...</option>
              @foreach(['organisasi','prestasi','edukasi','lingkungan'] as $cat)
              <option value="{{ $cat }}" {{ old('category', $news?->category) == $cat ? 'selected' : '' }}>
                {{ ucfirst($cat) }}
              </option>
              @endforeach
            </select>
            @error('category')<div class="admin-form-error">{{ $message }}</div>@enderror
          </div>

          <div class="admin-form-group" style="margin:0;">
            <label class="admin-form-label">Ikon Emoji</label>
            <input type="text" name="icon" value="{{ old('icon', $news?->icon ?? '🌊') }}"
                   class="admin-input" placeholder="Contoh: 🌊 🏆 🌿" maxlength="10">
          </div>

          <div class="admin-form-group" style="margin:0;">
            <label class="admin-form-label">Waktu Baca (menit) <span class="req">*</span></label>
            <input type="number" name="read_time" value="{{ old('read_time', $news?->read_time ?? 3) }}"
                   class="admin-input" min="1" max="60">
            @error('read_time')<div class="admin-form-error">{{ $message }}</div>@enderror
          </div>

          <div style="border-top:1px solid var(--glass-border); padding-top:1rem; display:flex; flex-direction:column; gap:.75rem;">
            <label class="toggle-wrap">
              <div class="toggle-switch">
                <input type="checkbox" name="is_published" value="1"
                       {{ old('is_published', $news?->is_published) ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
              </div>
              <span class="toggle-label">Publikasikan</span>
            </label>

            <label class="toggle-wrap">
              <div class="toggle-switch">
                <input type="checkbox" name="is_featured" value="1"
                       {{ old('is_featured', $news?->is_featured) ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
              </div>
              <span class="toggle-label">Jadikan Unggulan</span>
            </label>
          </div>

        </div>
      </div>

      <button type="submit" class="btn-login" style="border-radius:10px; padding:12px;">
        {{ $news ? 'Simpan Perubahan' : 'Tambah Berita' }}
      </button>

      @if($news)
      <button type="button" class="action-btn action-btn-delete" style="width:100%; height:38px; font-size:.82rem; border-radius:8px; gap:6px; justify-content:center; color:rgba(247,251,252,.6);"
              data-confirm="delete-news-{{ $news->id }}">
        🗑️ Hapus Berita Ini
      </button>
      <form method="POST" action="{{ route('admin.news.destroy', $news) }}" id="delete-news-{{ $news->id }}" style="display:none;">
        @csrf @method('DELETE')
      </form>
      @endif
    </div>

  </div>
</form>

@endsection