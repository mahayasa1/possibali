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
    <div class="news-filter-bar fade-in-up">
      <div class="filter-tabs" role="tablist">
        <button class="filter-tab active" data-filter="semua" role="tab" aria-selected="true">Semua</button>
        <button class="filter-tab" data-filter="organisasi" role="tab">Organisasi</button>
        <button class="filter-tab" data-filter="prestasi" role="tab">Prestasi</button>
        <button class="filter-tab" data-filter="edukasi" role="tab">Edukasi</button>
        <button class="filter-tab" data-filter="lingkungan" role="tab">Lingkungan</button>
      </div>
      <div class="filter-search">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
          <circle cx="6.5" cy="6.5" r="5" stroke="currentColor" stroke-width="1.5"/>
          <path d="M10 10l3.5 3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
        <input type="text" id="newsSearch" placeholder="Cari berita..." class="filter-search-input">
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════ NEWS GRID ═══════════════ -->
<section class="section news-section" style="padding-top:2rem;">
  <div class="container">

    <!-- Featured / Hero News -->
    <div class="news-featured fade-in-up" data-category="prestasi">
      <div class="news-featured-img">
        <div class="news-featured-img-placeholder">🏆</div>
        <div class="news-featured-badge">Unggulan</div>
      </div>
      <div class="news-featured-body">
        <div class="news-card-meta">
          <span class="news-tag news-tag-prestasi">Prestasi</span>
          <span class="news-card-meta-dot">·</span>
          <span>12 Mei 2026</span>
          <span class="news-card-meta-dot">·</span>
          <span>5 menit baca</span>
        </div>
        <h2 class="news-featured-title">
          Atlet Selam POSSI Bali Raih 3 Medali Emas di Kejuaraan Nasional Selam 2026
        </h2>
        <p class="news-featured-excerpt">
          Tim selam POSSI Bali tampil gemilang di Kejuaraan Nasional Selam yang digelar di Manado.
          Tiga atlet andalan berhasil menorehkan prestasi terbaik sepanjang sejarah organisasi,
          membawa pulang tiga medali emas sekaligus mengukuhkan Bali sebagai kekuatan selam nasional.
        </p>
        <a href="{{ url('/news/1') }}" class="btn-primary news-featured-btn">
          <span>Baca Selengkapnya</span>
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
            <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>
      </div>
    </div>

    <!-- News Grid -->
    <div class="news-grid news-grid-main" id="newsGrid">

      @php
        $newsItems = [
          ['icon'=>'🌊','cat'=>'organisasi','tag'=>'tag-organisasi','date'=>'8 Mei 2026','read'=>'3 menit','title'=>'Rapat Koordinasi POSSI Bali Kuartal II 2026','excerpt'=>'Pembahasan program kerja semester dua dan evaluasi pencapaian target organisasi bersama seluruh pengurus cabang.'],
          ['icon'=>'🤿','cat'=>'edukasi','tag'=>'tag-edukasi','date'=>'3 Mei 2026','read'=>'4 menit','title'=>'Program Sertifikasi Selam Gratis untuk Pelajar Bali','excerpt'=>'POSSI Bali meluncurkan program beasiswa sertifikasi selam internasional bagi 50 pelajar SMA se-Bali tahun ini.'],
          ['icon'=>'🐠','cat'=>'lingkungan','tag'=>'tag-lingkungan','date'=>'28 Apr 2026','read'=>'3 menit','title'=>'Aksi Bersih Laut Bersama 200 Penyelam di Nusa Penida','excerpt'=>'Ratusan penyelam sukarela dari berbagai club bergabung dalam misi pembersihan sampah plastik di perairan Nusa Penida.'],
          ['icon'=>'🎖️','cat'=>'prestasi','tag'=>'tag-prestasi','date'=>'20 Apr 2026','read'=>'2 menit','title'=>'POSSI Bali Terima Penghargaan Organisasi Selam Terbaik','excerpt'=>'Penghargaan diberikan oleh POSSI Pusat atas konsistensi dalam pembinaan atlet dan kegiatan pelestarian laut.'],
          ['icon'=>'📋','cat'=>'organisasi','tag'=>'tag-organisasi','date'=>'15 Apr 2026','read'=>'4 menit','title'=>'Musyawarah Daerah POSSI Bali: Pemilihan Pengurus Baru','excerpt'=>'Musda POSSI Bali 2026 berlangsung sukses dengan terpilihnya kepengurusan baru periode 2026–2030.'],
          ['icon'=>'🌿','cat'=>'lingkungan','tag'=>'tag-lingkungan','date'=>'10 Apr 2026','read'=>'5 menit','title'=>'Transplantasi Terumbu Karang di Perairan Amed Bali','excerpt'=>'Kolaborasi POSSI Bali dengan Dinas Kelautan menanam 500 fragmen terumbu karang di lokasi yang mengalami kerusakan.'],
        ];
      @endphp

      @foreach($newsItems as $i => $news)
      <div class="news-card fade-in-up delay-{{ ($i % 3) + 1 }}" data-category="{{ $news['cat'] }}">
        <div class="news-card-img">
          <div class="news-card-img-placeholder">{{ $news['icon'] }}</div>
          <div class="news-card-category">{{ ucfirst($news['cat']) }}</div>
        </div>
        <div class="news-card-body">
          <div class="news-card-meta">
            <span class="news-tag {{ $news['tag'] }}">{{ ucfirst($news['cat']) }}</span>
            <span class="news-card-meta-dot">·</span>
            <span>{{ $news['date'] }}</span>
            <span class="news-card-meta-dot">·</span>
            <span>{{ $news['read'] }}</span>
          </div>
          <h3 class="news-card-title">{{ $news['title'] }}</h3>
          <p class="news-card-excerpt">{{ $news['excerpt'] }}</p>
          <a href="{{ url('/news/'.($i+2)) }}" class="news-card-link">
            Baca Selengkapnya
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
              <path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </a>
        </div>
      </div>
      @endforeach

    </div><!-- /#newsGrid -->

    <!-- Empty state (hidden by default) -->
    <div class="empty-state" id="newsEmpty" style="display:none;">
      <div class="empty-state-icon">🔍</div>
      <div class="empty-state-title">Berita tidak ditemukan</div>
      <div class="empty-state-desc">Coba kata kunci atau kategori yang berbeda.</div>
    </div>

    <!-- Pagination -->
    <div class="pagination-wrap fade-in-up">
      <nav class="pagination" aria-label="Navigasi halaman">
        <div class="page-item disabled">
          <span class="page-link" aria-label="Sebelumnya">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M10 12L6 8l4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </span>
        </div>
        <div class="page-item active"><a href="#" class="page-link">1</a></div>
        <div class="page-item"><a href="#" class="page-link">2</a></div>
        <div class="page-item"><a href="#" class="page-link">3</a></div>
        <div class="page-item">
          <a href="#" class="page-link" aria-label="Berikutnya">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M6 12l4-4-4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
        </div>
      </nav>
    </div>

  </div>
</section>

@endsection

@push('styles')
<style>
/* ── PAGE HEADER ORBS ── */
.page-header { overflow: hidden; }
.page-header-orb {
  position: absolute;
  border-radius: 50%;
  filter: blur(70px);
  pointer-events: none;
}
.page-header-orb-1 {
  width: 400px; height: 400px;
  background: radial-gradient(circle, rgba(26,179,216,.18), transparent 70%);
  top: -80px; right: -60px;
}
.page-header-orb-2 {
  width: 260px; height: 260px;
  background: radial-gradient(circle, rgba(14,107,138,.22), transparent 70%);
  bottom: -40px; left: 10%;
}

/* ── FILTER BAR ── */
.news-filter-section {
  background: rgba(13,38,69,.6);
  border-bottom: 1px solid var(--glass-border);
  backdrop-filter: blur(12px);
  position: sticky;
  top: 72px;
  z-index: 100;
  padding: 0 2rem;
}
.news-filter-bar {
  max-width: 1200px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1rem;
  padding: 14px 0;
  flex-wrap: wrap;
}
.filter-tabs {
  display: flex;
  gap: 4px;
  flex-wrap: wrap;
}
.filter-tab {
  padding: 7px 18px;
  border-radius: 99px;
  border: 1.5px solid transparent;
  background: transparent;
  color: rgba(247,251,252,.55);
  font-family: var(--font-body);
  font-size: .82rem;
  font-weight: 500;
  cursor: pointer;
  transition: all var(--transition);
}
.filter-tab:hover {
  color: var(--ocean-white);
  border-color: var(--glass-border);
}
.filter-tab.active {
  background: linear-gradient(135deg, var(--ocean-teal), var(--ocean-bright));
  color: #fff;
  border-color: transparent;
}
.filter-search {
  display: flex;
  align-items: center;
  gap: 8px;
  background: rgba(255,255,255,.05);
  border: 1.5px solid var(--glass-border);
  border-radius: 99px;
  padding: 7px 16px;
  color: var(--text-muted);
  transition: border-color var(--transition);
}
.filter-search:focus-within {
  border-color: var(--ocean-bright);
  color: var(--ocean-white);
}
.filter-search-input {
  background: none;
  border: none;
  outline: none;
  color: var(--ocean-white);
  font-family: var(--font-body);
  font-size: .85rem;
  width: 180px;
}
.filter-search-input::placeholder { color: var(--text-muted); }

/* ── FEATURED NEWS ── */
.news-featured {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 0;
  background: var(--glass-bg);
  border: 1px solid var(--glass-border);
  border-radius: var(--radius-lg);
  overflow: hidden;
  margin-bottom: 2.5rem;
  backdrop-filter: blur(12px);
  transition: box-shadow var(--transition);
}
.news-featured:hover { box-shadow: var(--shadow-card), var(--shadow-glow); }
.news-featured-img {
  position: relative;
  min-height: 340px;
  background: linear-gradient(135deg, var(--ocean-mid), var(--ocean-teal));
  display: flex;
  align-items: center;
  justify-content: center;
}
.news-featured-img-placeholder { font-size: 5rem; opacity: .6; }
.news-featured-badge {
  position: absolute;
  top: 16px; left: 16px;
  padding: 5px 14px;
  background: linear-gradient(135deg, var(--ocean-teal), var(--ocean-bright));
  border-radius: 99px;
  font-size: .7rem;
  font-weight: 700;
  letter-spacing: .1em;
  text-transform: uppercase;
  color: #fff;
}
.news-featured-body {
  padding: 2.5rem;
  display: flex;
  flex-direction: column;
  justify-content: center;
  gap: 1rem;
}
.news-featured-title {
  font-family: var(--font-display);
  font-size: 1.5rem;
  font-weight: 700;
  line-height: 1.25;
  color: var(--ocean-white);
}
.news-featured-excerpt {
  font-size: .92rem;
  color: rgba(247,251,252,.65);
  line-height: 1.75;
}
.news-featured-btn { align-self: flex-start; }

/* ── NEWS TAGS ── */
.news-tag {
  display: inline-block;
  padding: 2px 8px;
  border-radius: 4px;
  font-size: .68rem;
  font-weight: 700;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.news-tag.tag-organisasi { background: rgba(26,179,216,.15); color: var(--ocean-bright); }
.news-tag.tag-prestasi   { background: rgba(212,168,83,.15); color: var(--ocean-gold); }
.news-tag.tag-edukasi    { background: rgba(94,231,247,.12); color: var(--ocean-foam); }
.news-tag.tag-lingkungan { background: rgba(46,160,97,.15);  color: #6ee09a; }

/* ── MAIN GRID ── */
.news-grid-main { grid-template-columns: repeat(3, 1fr); }

/* ── RESPONSIVE ── */
@media (max-width: 1024px) {
  .news-featured { grid-template-columns: 1fr; }
  .news-featured-img { min-height: 220px; }
  .news-grid-main { grid-template-columns: repeat(2,1fr); }
}
@media (max-width: 640px) {
  .news-filter-bar { flex-direction: column; align-items: stretch; }
  .filter-search-input { width: 100%; }
  .news-grid-main { grid-template-columns: 1fr; }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  /* ── FILTER TABS ── */
  const tabs   = document.querySelectorAll('.filter-tab');
  const cards  = document.querySelectorAll('#newsGrid .news-card');
  const featured = document.querySelector('.news-featured');
  const empty  = document.getElementById('newsEmpty');

  function filterNews(cat) {
    let visible = 0;
    cards.forEach(card => {
      const match = cat === 'semua' || card.dataset.category === cat;
      card.style.display = match ? '' : 'none';
      if (match) visible++;
    });
    if (featured) {
      featured.style.display = (cat === 'semua' || cat === 'prestasi') ? '' : 'none';
      if (cat === 'semua' || cat === 'prestasi') visible++;
    }
    empty.style.display = visible === 0 ? 'block' : 'none';
  }

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => { t.classList.remove('active'); t.setAttribute('aria-selected','false'); });
      tab.classList.add('active');
      tab.setAttribute('aria-selected','true');
      filterNews(tab.dataset.filter);
    });
  });

  /* ── SEARCH ── */
  document.getElementById('newsSearch')?.addEventListener('input', function() {
    const q = this.value.toLowerCase().trim();
    let visible = 0;
    cards.forEach(card => {
      const title = card.querySelector('.news-card-title')?.textContent.toLowerCase() || '';
      const match = title.includes(q);
      card.style.display = match ? '' : 'none';
      if (match) visible++;
    });
    empty.style.display = visible === 0 ? 'block' : 'none';
  });
});
</script>
@endpush