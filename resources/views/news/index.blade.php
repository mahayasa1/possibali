@extends('layouts.app')

@section('title', 'Berita')

@section('content')

<!-- ═══════════════ PAGE HEADER ═══════════════ -->
<section class="page-header">
  <div class="page-header-orb page-header-orb-1"></div>
  <div class="page-header-orb page-header-orb-2"></div>
  <div class="container" style="position:relative;z-index:2;">
    <div class="page-header-eyebrow fade-in-up">Informasi Terkini</div>
    <h1 class="page-header-title fade-in-up delay-1">Berita <em>POSSI Bali</em></h1>
    <p class="page-header-desc fade-in-up delay-2">
      Update terbaru seputar dunia selam, kegiatan organisasi, prestasi atlet,
      dan pelestarian laut Indonesia.
    </p>
  </div>
</section>

<!-- ═══════════════ FILTER BAR ═══════════════ -->
<section class="news-filter-section">
  <div class="container">
    <form method="GET" action="{{ route('news.index') }}" class="news-filter-bar fade-in-up">
      <div class="filter-tabs" role="tablist">
        <button type="submit" name="category" value=""
          class="filter-tab {{ !request('category') ? 'active' : '' }}">Semua</button>
        @foreach(['organisasi','prestasi','edukasi','lingkungan'] as $cat)
        <button type="submit" name="category" value="{{ $cat }}"
          class="filter-tab {{ request('category') === $cat ? 'active' : '' }}">
          {{ ucfirst($cat) }}
        </button>
        @endforeach
      </div>
      <div class="filter-search">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
          <circle cx="6.5" cy="6.5" r="5" stroke="currentColor" stroke-width="1.5"/>
          <path d="M10 10l3.5 3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
        <input type="text" name="search" value="{{ request('search') }}"
          placeholder="Cari berita..." class="filter-search-input">
      </div>
    </form>
  </div>
</section>

<!-- ═══════════════ NEWS CONTENT ═══════════════ -->
<section class="section news-section" style="padding-top:2rem;">
  <div class="container">

    @if($featured)
    <!-- Featured / Hero News -->
    <div class="news-featured fade-in-up">
      <div class="news-featured-img">
        <div class="news-featured-img-placeholder">{{ $featured->icon ?? '🌊' }}</div>
        <div class="news-featured-badge">Unggulan</div>
      </div>
      <div class="news-featured-body">
        <div class="news-card-meta">
          <span class="news-tag news-tag-{{ $featured->category }}">{{ ucfirst($featured->category) }}</span>
          <span class="news-card-meta-dot">·</span>
          <span>{{ $featured->created_at->translatedFormat('d F Y') }}</span>
          <span class="news-card-meta-dot">·</span>
          <span>{{ $featured->read_time }} menit baca</span>
        </div>
        <h2 class="news-featured-title">{{ $featured->title }}</h2>
        <p class="news-featured-excerpt">
          {{ $featured->excerpt ?? Str::limit(strip_tags($featured->content), 200) }}
        </p>
        <a href="{{ route('news.show', $featured) }}" class="btn-primary news-featured-btn">
          <span>Baca Selengkapnya</span>
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
            <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>
      </div>
    </div>
    @endif

    <!-- News Grid -->
    @php
      $catColors = [
        'organisasi' => 'tag-organisasi',
        'prestasi'   => 'tag-prestasi',
        'edukasi'    => 'tag-edukasi',
        'lingkungan' => 'tag-lingkungan',
      ];
    @endphp

    @if($news->count() > 0)
    <div class="news-grid news-grid-main">
      @foreach($news as $i => $item)
      {{-- Skip featured kalau tampil di atas --}}
      @if($featured && $item->id === $featured->id && $i === 0) @continue @endif
      <div class="news-card fade-in-up delay-{{ ($i % 3) + 1 }}">
        <div class="news-card-img">
          @if($item->image)
            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}">
          @else
            <div class="news-card-img-placeholder">{{ $item->icon ?? '📰' }}</div>
          @endif
          <div class="news-card-category">{{ ucfirst($item->category) }}</div>
        </div>
        <div class="news-card-body">
          <div class="news-card-meta">
            <span class="news-tag {{ $catColors[$item->category] ?? '' }}">{{ ucfirst($item->category) }}</span>
            <span class="news-card-meta-dot">·</span>
            <span>{{ $item->created_at->translatedFormat('d M Y') }}</span>
            <span class="news-card-meta-dot">·</span>
            <span>{{ $item->read_time }} mnt</span>
          </div>
          <h3 class="news-card-title">{{ $item->title }}</h3>
          <p class="news-card-excerpt">
            {{ $item->excerpt ?? Str::limit(strip_tags($item->content), 120) }}
          </p>
          <a href="{{ route('news.show', $item) }}" class="news-card-link">
            Baca Selengkapnya
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
              <path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </a>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Pagination -->
    @if($news->hasPages())
    <div class="pagination-wrap fade-in-up">
      {{ $news->withQueryString()->links('pagination::default') }}
    </div>
    @endif

    @else
    <div class="empty-state">
      <div class="empty-state-icon">📭</div>
      <div class="empty-state-title">Belum ada berita</div>
      <div class="empty-state-desc">
        @if(request()->hasAny(['search','category']))
          Tidak ada hasil untuk pencarian ini. <a href="{{ route('news.index') }}" style="color:var(--ocean-bright)">Reset filter</a>
        @else
          Berita akan segera hadir.
        @endif
      </div>
    </div>
    @endif

  </div>
</section>

@endsection

@push('styles')
<style>
.page-header { overflow: hidden; }
.page-header-orb { position:absolute; border-radius:50%; filter:blur(70px); pointer-events:none; }
.page-header-orb-1 { width:400px;height:400px;background:radial-gradient(circle,rgba(26,179,216,.18),transparent 70%);top:-80px;right:-60px; }
.page-header-orb-2 { width:260px;height:260px;background:radial-gradient(circle,rgba(14,107,138,.22),transparent 70%);bottom:-40px;left:10%; }

.news-filter-section {
  background:rgba(13,38,69,.6); border-bottom:1px solid var(--glass-border);
  backdrop-filter:blur(12px); position:sticky; top:72px; z-index:100; padding:0 2rem;
}
.news-filter-bar {
  max-width:1200px; margin:0 auto; display:flex; align-items:center;
  justify-content:space-between; gap:1rem; padding:14px 0; flex-wrap:wrap;
}
.filter-tabs { display:flex; gap:4px; flex-wrap:wrap; }
.filter-tab {
  padding:7px 18px; border-radius:99px; border:1.5px solid transparent;
  background:transparent; color:rgba(247,251,252,.55); font-family:var(--font-body);
  font-size:.82rem; font-weight:500; cursor:pointer; transition:all var(--transition);
}
.filter-tab:hover { color:var(--ocean-white); border-color:var(--glass-border); }
.filter-tab.active { background:linear-gradient(135deg,var(--ocean-teal),var(--ocean-bright)); color:#fff; }
.filter-search {
  display:flex; align-items:center; gap:8px; background:rgba(255,255,255,.05);
  border:1.5px solid var(--glass-border); border-radius:99px; padding:7px 16px;
  color:var(--text-muted); transition:border-color var(--transition);
}
.filter-search:focus-within { border-color:var(--ocean-bright); color:var(--ocean-white); }
.filter-search-input {
  background:none; border:none; outline:none; color:var(--ocean-white);
  font-family:var(--font-body); font-size:.85rem; width:180px;
}
.filter-search-input::placeholder { color:var(--text-muted); }

.news-featured {
  display:grid; grid-template-columns:1fr 1fr; gap:0;
  background:var(--glass-bg); border:1px solid var(--glass-border);
  border-radius:var(--radius-lg); overflow:hidden; margin-bottom:2.5rem;
  backdrop-filter:blur(12px); transition:box-shadow var(--transition);
}
.news-featured:hover { box-shadow:var(--shadow-card),var(--shadow-glow); }
.news-featured-img {
  position:relative; min-height:340px;
  background:linear-gradient(135deg,var(--ocean-mid),var(--ocean-teal));
  display:flex; align-items:center; justify-content:center; overflow:hidden;
}
.news-featured-img img { width:100%; height:100%; object-fit:cover; position:absolute; inset:0; }
.news-featured-img-placeholder { font-size:5rem; opacity:.6; }
.news-featured-badge {
  position:absolute; top:16px; left:16px; padding:5px 14px;
  background:linear-gradient(135deg,var(--ocean-teal),var(--ocean-bright));
  border-radius:99px; font-size:.7rem; font-weight:700;
  letter-spacing:.1em; text-transform:uppercase; color:#fff; z-index:1;
}
.news-featured-body { padding:2.5rem; display:flex; flex-direction:column; justify-content:center; gap:1rem; }
.news-featured-title { font-family:var(--font-display); font-size:1.5rem; font-weight:700; line-height:1.25; color:var(--ocean-white); }
.news-featured-excerpt { font-size:.92rem; color:rgba(247,251,252,.65); line-height:1.75; }
.news-featured-btn { align-self:flex-start; }

.news-tag { display:inline-block; padding:2px 8px; border-radius:4px; font-size:.68rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase; }
.news-tag.news-tag-organisasi { background:rgba(26,179,216,.15); color:var(--ocean-bright); }
.news-tag.news-tag-prestasi   { background:rgba(212,168,83,.15); color:var(--ocean-gold); }
.news-tag.news-tag-edukasi    { background:rgba(94,231,247,.12); color:var(--ocean-foam); }
.news-tag.news-tag-lingkungan { background:rgba(46,160,97,.15); color:#6ee09a; }

.news-grid-main { grid-template-columns:repeat(3,1fr); }

@media(max-width:1024px) {
  .news-featured { grid-template-columns:1fr; }
  .news-featured-img { min-height:220px; }
  .news-grid-main { grid-template-columns:repeat(2,1fr); }
}
@media(max-width:640px) {
  .news-filter-bar { flex-direction:column; align-items:stretch; }
  .filter-search-input { width:100%; }
  .news-grid-main { grid-template-columns:1fr; }
}
</style>
@endpush