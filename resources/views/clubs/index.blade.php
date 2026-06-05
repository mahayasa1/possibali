@extends('layouts.app')

@section('title', 'Club Selam')

@section('content')

<!-- ═══════════════ PAGE HEADER ═══════════════ -->
<section class="page-header">
  <div class="page-header-orb page-header-orb-1"></div>
  <div class="page-header-orb page-header-orb-2"></div>
  <div class="container" style="position:relative;z-index:2;">
    <div class="page-header-eyebrow fade-in-up">Komunitas Selam Bali</div>
    <h1 class="page-header-title fade-in-up delay-1">Club <em>Selam</em> Bali</h1>
    <p class="page-header-desc fade-in-up delay-2">
      Daftar club selam resmi terdaftar di POSSI Bali. Bergabunglah dengan
      komunitas penyelam terbaik dan jadilah bagian dari keluarga besar selam Indonesia.
    </p>
  </div>
</section>

<!-- ═══════════════ STATS STRIP ═══════════════ -->
<section class="club-stats-strip">
  <div class="container">
    <div class="club-stats-grid fade-in-up">
      <div class="club-stat-item">
        <div class="club-stat-value" data-counter data-target="48">0</div>
        <div class="club-stat-label">Club Terdaftar</div>
      </div>
      <div class="club-stat-item">
        <div class="club-stat-value" data-counter data-target="1240">0</div>
        <div class="club-stat-label">Total Anggota</div>
      </div>
      <div class="club-stat-item">
        <div class="club-stat-value" data-counter data-target="9">0</div>
        <div class="club-stat-label">Kabupaten / Kota</div>
      </div>
      <div class="club-stat-item">
        <div class="club-stat-value" data-counter data-target="320">0</div>
        <div class="club-stat-label">Atlet Aktif</div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════ FILTER + SEARCH ═══════════════ -->
<section class="club-filter-section">
  <div class="container">
    <div class="club-filter-bar fade-in-up">
      <div class="filter-tabs" role="tablist">
        <button class="filter-tab active" data-filter="semua" role="tab">Semua</button>
        <button class="filter-tab" data-filter="denpasar" role="tab">Denpasar</button>
        <button class="filter-tab" data-filter="badung" role="tab">Badung</button>
        <button class="filter-tab" data-filter="karangasem" role="tab">Karangasem</button>
        <button class="filter-tab" data-filter="buleleng" role="tab">Buleleng</button>
        <button class="filter-tab" data-filter="klungkung" role="tab">Klungkung</button>
      </div>
      <div class="filter-search">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
          <circle cx="6.5" cy="6.5" r="5" stroke="currentColor" stroke-width="1.5"/>
          <path d="M10 10l3.5 3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
        <input type="text" id="clubSearch" placeholder="Cari nama club..." class="filter-search-input">
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════ CLUB GRID ═══════════════ -->
<section class="section" style="padding-top:2rem; background:var(--ocean-deep);">
  <div class="container">

    <div class="club-grid" id="clubGrid">

      @php
        $clubs = [
          ['name'=>'Barracuda Dive Club','city'=>'Denpasar','area'=>'denpasar','icon'=>'🐟','since'=>'2003','members'=>87,'specialty'=>'Freediving & Kompetisi','verified'=>true,'champ'=>true],
          ['name'=>'Blue Coral Divers','city'=>'Badung','area'=>'badung','icon'=>'🪸','since'=>'2008','members'=>64,'specialty'=>'Reef Conservation','verified'=>true,'champ'=>false],
          ['name'=>'Manta Ray Club','city'=>'Karangasem','area'=>'karangasem','icon'=>'🦈','since'=>'2011','members'=>52,'specialty'=>'Deep Diving & Photography','verified'=>true,'champ'=>true],
          ['name'=>'Tulamben Divers','city'=>'Karangasem','area'=>'karangasem','icon'=>'⚓','since'=>'2006','members'=>78,'specialty'=>'Wreck Diving','verified'=>true,'champ'=>false],
          ['name'=>'Pemuteran Sea Club','city'=>'Buleleng','area'=>'buleleng','icon'=>'🐬','since'=>'2014','members'=>41,'specialty'=>'Marine Education','verified'=>true,'champ'=>false],
          ['name'=>'Lovina Ocean Club','city'=>'Buleleng','area'=>'buleleng','icon'=>'🌊','since'=>'2010','members'=>55,'specialty'=>'Snorkeling & Freediving','verified'=>true,'champ'=>false],
          ['name'=>'Nusa Penida Divers','city'=>'Klungkung','area'=>'klungkung','icon'=>'🐙','since'=>'2015','members'=>49,'specialty'=>'Pelagic Diving','verified'=>true,'champ'=>true],
          ['name'=>'Kuta Sea Warriors','city'=>'Badung','area'=>'badung','icon'=>'🏄','since'=>'2009','members'=>93,'specialty'=>'Rescue Diving','verified'=>true,'champ'=>false],
          ['name'=>'Sanur Dive Society','city'=>'Denpasar','area'=>'denpasar','icon'=>'🐠','since'=>'2005','members'=>72,'specialty'=>'Scuba & Night Diving','verified'=>true,'champ'=>false],
        ];
      @endphp

      @foreach($clubs as $i => $club)
      <div class="club-card fade-in-up delay-{{ ($i % 3) + 1 }}" data-area="{{ $club['area'] }}" data-name="{{ strtolower($club['name']) }}">

        @if($club['champ'])
        <div class="club-champion-ribbon">
          <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M7 1l1.5 3.2L12 4.7l-2.5 2.4.6 3.4L7 9l-3.1 1.5.6-3.4L2 4.7l3.5-.5L7 1z" fill="currentColor"/></svg>
          Juara
        </div>
        @endif

        <div class="club-card-header">
          <div class="club-icon">{{ $club['icon'] }}</div>
          @if($club['verified'])
          <div class="club-verified" title="Club Terverifikasi POSSI Bali">
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M6 1l1.1 2.3 2.5.4-1.8 1.7.4 2.5L6 6.8 3.8 7.9l.4-2.5L2.4 3.7l2.5-.4L6 1z" fill="var(--ocean-bright)"/></svg>
            Terverifikasi
          </div>
          @endif
        </div>

        <div class="club-card-body">
          <h3 class="club-name">{{ $club['name'] }}</h3>
          <div class="club-city">
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M6 1C4.34 1 3 2.34 3 4c0 2.84 3 6 3 6s3-3.16 3-6c0-1.66-1.34-3-3-3zm0 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" fill="currentColor" opacity=".6"/></svg>
            {{ $club['city'] }}, Bali
          </div>
          <div class="club-specialty">{{ $club['specialty'] }}</div>

          <div class="club-stats-row">
            <div class="club-mini-stat">
              <div class="club-mini-val">{{ $club['members'] }}</div>
              <div class="club-mini-label">Anggota</div>
            </div>
            <div class="club-mini-stat-div"></div>
            <div class="club-mini-stat">
              <div class="club-mini-val">{{ $club['since'] }}</div>
              <div class="club-mini-label">Berdiri</div>
            </div>
            <div class="club-mini-stat-div"></div>
            <div class="club-mini-stat">
              <div class="club-mini-val">{{ date('Y') - $club['since'] }}</div>
              <div class="club-mini-label">Tahun</div>
            </div>
          </div>
        </div>

        <div class="club-card-footer">
          <a href="{{ url('/club/'.Str::slug($club['name'])) }}" class="btn-outline btn-sm">Lihat Detail</a>
          <a href="{{ url('/club/'.Str::slug($club['name']).'/join') }}" class="btn-primary btn-sm"><span>Bergabung</span></a>
        </div>

      </div>
      @endforeach

    </div><!-- /#clubGrid -->

    <div class="empty-state" id="clubEmpty" style="display:none;">
      <div class="empty-state-icon">🤿</div>
      <div class="empty-state-title">Club tidak ditemukan</div>
      <div class="empty-state-desc">Coba kata kunci atau wilayah yang berbeda.</div>
    </div>

  </div>
</section>

<!-- ═══════════════ CTA DAFTARKAN CLUB ═══════════════ -->
<section class="section" style="background:linear-gradient(135deg, var(--ocean-mid) 0%, var(--ocean-deep) 100%); padding:5rem 2rem;">
  <div class="container">
    <div class="club-cta-card fade-in-up">
      <div class="club-cta-icon">🏊</div>
      <div class="club-cta-content">
        <h2 class="club-cta-title">Daftarkan Club Selam Anda</h2>
        <p class="club-cta-desc">
          Bergabunglah dengan jaringan club selam resmi POSSI Bali. Dapatkan akses pelatihan,
          sertifikasi, kompetisi, dan program pelestarian laut bersama.
        </p>
        <div class="club-cta-perks">
          <div class="cta-perk">✓ Sertifikat Resmi POSSI</div>
          <div class="cta-perk">✓ Akses Kompetisi Nasional</div>
          <div class="cta-perk">✓ Jaringan Instruktur Berpengalaman</div>
          <div class="cta-perk">✓ Program Beasiswa Atlet</div>
        </div>
      </div>
      <div class="club-cta-actions">
        <a href="{{ url('/club/register') }}" class="btn-primary">
          <span>Daftarkan Club</span>
        </a>
        <a href="{{ url('/contact') }}" class="btn-outline">Hubungi Kami</a>
      </div>
    </div>
  </div>
</section>

@endsection

@push('styles')
<style>
.page-header { overflow:hidden; }
.page-header-orb { position:absolute; border-radius:50%; filter:blur(70px); pointer-events:none; }
.page-header-orb-1 { width:380px;height:380px;background:radial-gradient(circle,rgba(94,231,247,.15),transparent 70%);top:-80px;right:-40px; }
.page-header-orb-2 { width:260px;height:260px;background:radial-gradient(circle,rgba(26,179,216,.12),transparent 70%);bottom:-40px;left:10%; }

/* ── STATS STRIP ── */
.club-stats-strip {
  background: linear-gradient(135deg, var(--ocean-mid), rgba(14,107,138,.3));
  border-bottom: 1px solid var(--glass-border);
  padding: 2.5rem 2rem;
}
.club-stats-grid {
  display: grid;
  grid-template-columns: repeat(4,1fr);
  gap: 1rem;
  max-width: 1200px; margin: 0 auto;
  text-align: center;
}
.club-stat-item {}
.club-stat-value {
  font-family: var(--font-display);
  font-size: 2.5rem; font-weight:700;
  color: var(--ocean-foam); line-height:1;
}
.club-stat-label {
  font-size: .78rem; color: rgba(247,251,252,.5);
  letter-spacing:.05em; margin-top:6px;
}

/* ── FILTER ── */
.club-filter-section {
  background: rgba(13,38,69,.6);
  border-bottom: 1px solid var(--glass-border);
  backdrop-filter: blur(12px);
  position: sticky; top:72px; z-index:100;
  padding: 0 2rem;
}
.club-filter-bar {
  max-width:1200px; margin:0 auto;
  display:flex; align-items:center; justify-content:space-between;
  gap:1rem; padding:14px 0; flex-wrap:wrap;
}
.filter-tabs { display:flex; gap:4px; flex-wrap:wrap; }
.filter-tab {
  padding:7px 18px; border-radius:99px;
  border:1.5px solid transparent; background:transparent;
  color:rgba(247,251,252,.55); font-family:var(--font-body);
  font-size:.82rem; font-weight:500; cursor:pointer;
  transition:all var(--transition);
}
.filter-tab:hover { color:var(--ocean-white); border-color:var(--glass-border); }
.filter-tab.active { background:linear-gradient(135deg,var(--ocean-teal),var(--ocean-bright)); color:#fff; }
.filter-search {
  display:flex; align-items:center; gap:8px;
  background:rgba(255,255,255,.05); border:1.5px solid var(--glass-border);
  border-radius:99px; padding:7px 16px; color:var(--text-muted);
  transition:border-color var(--transition);
}
.filter-search:focus-within { border-color:var(--ocean-bright); color:var(--ocean-white); }
.filter-search-input {
  background:none; border:none; outline:none;
  color:var(--ocean-white); font-family:var(--font-body);
  font-size:.85rem; width:180px;
}
.filter-search-input::placeholder { color:var(--text-muted); }

/* ── CLUB GRID ── */
.club-grid {
  display: grid;
  grid-template-columns: repeat(3,1fr);
  gap: 20px;
  margin-bottom: 2rem;
}
.club-card {
  background: var(--glass-bg);
  border: 1px solid var(--glass-border);
  border-radius: var(--radius-md);
  overflow: hidden;
  display: flex; flex-direction: column;
  position: relative;
  transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition);
  backdrop-filter: blur(12px);
}
.club-card:hover {
  transform: translateY(-6px);
  box-shadow: var(--shadow-card), var(--shadow-glow);
  border-color: rgba(94,231,247,.25);
}
.club-champion-ribbon {
  position:absolute; top:0; right:0;
  background: linear-gradient(135deg, var(--ocean-gold), #f0c060);
  color: #0a1628;
  font-size:.65rem; font-weight:800;
  letter-spacing:.1em; text-transform:uppercase;
  padding: 5px 10px 5px 14px;
  border-radius: 0 0 0 12px;
  display:flex; align-items:center; gap:4px;
}
.club-card-header {
  padding: 1.5rem 1.5rem 0;
  display:flex; align-items:flex-start; justify-content:space-between;
}
.club-icon { font-size:2.5rem; line-height:1; }
.club-verified {
  display:flex; align-items:center; gap:4px;
  padding:3px 8px; border-radius:99px;
  background:rgba(26,179,216,.12); border:1px solid rgba(26,179,216,.25);
  font-size:.65rem; font-weight:700; color:var(--ocean-bright);
  letter-spacing:.06em;
}
.club-card-body { padding:1rem 1.5rem; flex:1; }
.club-name { font-family:var(--font-display); font-size:1rem; font-weight:600; margin-bottom:.35rem; color:var(--ocean-white); line-height:1.3; }
.club-city { display:flex; align-items:center; gap:5px; font-size:.75rem; color:var(--text-muted); margin-bottom:.5rem; }
.club-specialty {
  display:inline-block; padding:3px 10px;
  background:rgba(255,255,255,.06); border:1px solid var(--glass-border);
  border-radius:4px; font-size:.72rem; color:rgba(247,251,252,.6);
  margin-bottom:1rem;
}
.club-stats-row {
  display:flex; align-items:center; gap:.5rem;
  padding:.75rem; background:rgba(0,0,0,.2); border-radius:8px;
}
.club-mini-stat { flex:1; text-align:center; }
.club-mini-val { font-family:var(--font-display); font-size:1.1rem; font-weight:700; color:var(--ocean-foam); }
.club-mini-label { font-size:.65rem; color:rgba(247,251,252,.4); letter-spacing:.04em; margin-top:2px; }
.club-mini-stat-div { width:1px; height:28px; background:var(--glass-border); }

.club-card-footer {
  padding:.75rem 1.5rem 1.25rem;
  display:flex; gap:.5rem;
}
.club-card-footer .btn-outline, .club-card-footer .btn-primary {
  flex:1; justify-content:center;
  padding:8px 12px !important; font-size:.8rem !important;
}

/* ── CTA ── */
.club-cta-card {
  display:flex; align-items:center; gap:2rem;
  background:var(--glass-bg); border:1px solid var(--glass-border);
  border-radius:var(--radius-lg); padding:2.5rem;
  backdrop-filter:blur(16px);
  flex-wrap:wrap;
}
.club-cta-icon { font-size:3.5rem; flex-shrink:0; }
.club-cta-content { flex:1; min-width:260px; }
.club-cta-title { font-family:var(--font-display); font-size:1.5rem; font-weight:700; margin-bottom:.6rem; }
.club-cta-desc { font-size:.88rem; color:rgba(247,251,252,.65); line-height:1.75; margin-bottom:1rem; }
.club-cta-perks { display:flex; flex-wrap:wrap; gap:.5rem 1.5rem; }
.cta-perk { font-size:.82rem; color:var(--ocean-foam); font-weight:500; }
.club-cta-actions { display:flex; flex-direction:column; gap:.75rem; flex-shrink:0; }

.btn-sm { padding:9px 20px !important; font-size:.82rem !important; }

@media(max-width:1024px) { .club-grid { grid-template-columns:repeat(2,1fr); } .club-stats-grid { grid-template-columns:repeat(2,1fr); } }
@media(max-width:640px)  { .club-grid { grid-template-columns:1fr; } .club-stats-grid { grid-template-columns:repeat(2,1fr); } .club-filter-bar { flex-direction:column; } .filter-search-input { width:100%; } .club-cta-card { flex-direction:column; text-align:center; } .club-cta-actions { flex-direction:row; } }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  /* ── FILTER TABS ── */
  const tabs  = document.querySelectorAll('.filter-tab');
  const cards = document.querySelectorAll('#clubGrid .club-card');
  const empty = document.getElementById('clubEmpty');

  function filterClubs(area) {
    let visible = 0;
    cards.forEach(card => {
      const match = area === 'semua' || card.dataset.area === area;
      card.style.display = match ? '' : 'none';
      if (match) visible++;
    });
    empty.style.display = visible === 0 ? 'block' : 'none';
  }

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
      filterClubs(tab.dataset.filter);
      // Reset search
      document.getElementById('clubSearch').value = '';
    });
  });

  /* ── SEARCH ── */
  document.getElementById('clubSearch')?.addEventListener('input', function() {
    const q = this.value.toLowerCase().trim();
    // Reset tab ke "semua"
    tabs.forEach(t => t.classList.remove('active'));
    tabs[0].classList.add('active');

    let visible = 0;
    cards.forEach(card => {
      const name = card.dataset.name || '';
      const match = name.includes(q);
      card.style.display = match ? '' : 'none';
      if (match) visible++;
    });
    empty.style.display = visible === 0 ? 'block' : 'none';
  });
});
</script>
@endpush