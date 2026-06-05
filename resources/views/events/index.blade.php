@extends('layouts.app')

@section('title', 'Event & Kegiatan')

@section('content')

<!-- ═══════════════ PAGE HEADER ═══════════════ -->
<section class="page-header">
  <div class="page-header-orb page-header-orb-1"></div>
  <div class="page-header-orb page-header-orb-2"></div>
  <div class="container" style="position:relative;z-index:2;">
    <div class="page-header-eyebrow fade-in-up">Agenda & Kegiatan</div>
    <h1 class="page-header-title fade-in-up delay-1">Event <em>POSSI Bali</em></h1>
    <p class="page-header-desc fade-in-up delay-2">
      Jadwal kompetisi, pelatihan, seminar, dan kegiatan pelestarian laut
      yang diselenggarakan oleh POSSI Bali.
    </p>
  </div>
</section>

<!-- ═══════════════ EVENT FILTER TABS ═══════════════ -->
<section class="event-filter-section">
  <div class="container">
    <div class="event-filter-bar fade-in-up">
      <div class="filter-tabs" role="tablist">
        <button class="filter-tab active" data-filter="semua" role="tab">Semua</button>
        <button class="filter-tab" data-filter="kompetisi" role="tab">Kompetisi</button>
        <button class="filter-tab" data-filter="pelatihan" role="tab">Pelatihan</button>
        <button class="filter-tab" data-filter="sosial" role="tab">Sosial & Lingkungan</button>
        <button class="filter-tab" data-filter="seminar" role="tab">Seminar</button>
      </div>
      <div class="event-view-toggle">
        <button class="view-btn active" id="viewGrid" title="Grid view">
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><rect x="1" y="1" width="6" height="6" rx="1" stroke="currentColor" stroke-width="1.5"/><rect x="9" y="1" width="6" height="6" rx="1" stroke="currentColor" stroke-width="1.5"/><rect x="1" y="9" width="6" height="6" rx="1" stroke="currentColor" stroke-width="1.5"/><rect x="9" y="9" width="6" height="6" rx="1" stroke="currentColor" stroke-width="1.5"/></svg>
        </button>
        <button class="view-btn" id="viewList" title="List view">
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M2 4h12M2 8h12M2 12h12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
        </button>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════ COUNTDOWN BANNER ═══════════════ -->
@if($upcoming)
<section style="padding:2rem 2rem 0;">
  <div class="container">
    <div class="event-countdown-banner fade-in-up">
      <div class="countdown-badge">🔥 Segera</div>
      <div class="countdown-info">
        <div class="countdown-title">{{ $upcoming->title }}</div>
        <div class="countdown-date">
          📅 {{ $upcoming->event_date->translatedFormat('l, d F Y') }} · {{ $upcoming->location }}
        </div>
      </div>
      <div class="countdown-timer" id="countdownTimer">
        <div class="countdown-unit"><span class="countdown-num" id="cdDays">--</span><span class="countdown-label">Hari</span></div>
        <div class="countdown-sep">:</div>
        <div class="countdown-unit"><span class="countdown-num" id="cdHours">--</span><span class="countdown-label">Jam</span></div>
        <div class="countdown-sep">:</div>
        <div class="countdown-unit"><span class="countdown-num" id="cdMins">--</span><span class="countdown-label">Menit</span></div>
        <div class="countdown-sep">:</div>
        <div class="countdown-unit"><span class="countdown-num" id="cdSecs">--</span><span class="countdown-label">Detik</span></div>
      </div>
      <a href="{{ route('events.show', $upcoming) }}" class="btn-primary btn-sm"><span>Daftar Sekarang</span></a>
    </div>
  </div>
</section>
@php
  $countdownTarget = $upcoming->event_date->format('Y-m-d') . 'T' . $upcoming->start_time . '+08:00';
@endphp
@endif

<!-- ═══════════════ EVENTS GRID ═══════════════ -->
<section class="section events-section" style="padding-top:2.5rem;">
  <div class="container">

    @if($events->count() > 0)
    <div class="events-card-grid" id="eventsGrid">
      @foreach($events as $i => $event)
      @php
        $pct = $event->max_participants > 0
          ? round(($event->registered_participants / $event->max_participants) * 100)
          : 0;
        $slotClass = match($event->status) {
          'penuh'       => 'event-slots-full',
          'hampir penuh'=> 'event-slots-almost',
          default       => 'event-slots-open',
        };
        $statusColor = match($event->status) {
          'penuh'       => 'status-penuh',
          'hampir penuh'=> 'status-hampir',
          default       => 'status-open',
        };
        $typeClass = 'event-type-' . $event->type;
      @endphp
      <div class="event-card-v2 fade-in-up delay-{{ ($i % 3) + 1 }}" data-category="{{ $event->type }}">
        <div class="event-card-v2-header">
          <div class="event-date-badge">
            <div class="event-date-day">{{ $event->event_date->format('d') }}</div>
            <div class="event-date-month">{{ strtoupper($event->event_date->locale('id')->isoFormat('MMM')) }}</div>
          </div>
          <div class="event-type-badge {{ $typeClass }}">{{ ucfirst($event->type) }}</div>
          <div class="event-icon-wrap">{{ $event->icon ?? '📅' }}</div>
        </div>

        <div class="event-card-v2-body">
          <h3 class="event-card-v2-title">{{ $event->title }}</h3>
          <p class="event-card-v2-desc">{{ Str::limit(strip_tags($event->description), 120) }}</p>

          <div class="event-card-v2-meta">
            <div class="event-meta-row">
              <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><path d="M6.5 1C4.015 1 2 3.015 2 5.5 2 8.938 6.5 12 6.5 12S11 8.938 11 5.5C11 3.015 8.985 1 6.5 1zm0 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" fill="currentColor" opacity=".6"/></svg>
              {{ $event->location }}
            </div>
            <div class="event-meta-row">
              <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><circle cx="6.5" cy="6.5" r="5" stroke="currentColor" stroke-width="1.2" opacity=".6"/><path d="M6.5 3.5v3l2 1.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" opacity=".6"/></svg>
              {{ \Carbon\Carbon::parse($event->start_time)->format('H.i') }}
              @if($event->end_time) – {{ \Carbon\Carbon::parse($event->end_time)->format('H.i') }} @endif
              WITA
            </div>
          </div>

          <div class="event-slots">
            <div class="event-slots-label">
              <span>Pendaftar</span>
              <span class="event-slots-num">{{ $event->registered_participants }} / {{ $event->max_participants }}</span>
            </div>
            <div class="event-slots-bar">
              <div class="event-slots-fill {{ $slotClass }}" style="width:{{ $pct }}%"></div>
            </div>
          </div>
        </div>

        <div class="event-card-v2-footer">
          @if($event->status === 'penuh')
            <span class="event-status-badge status-penuh">Penuh</span>
            <button class="btn-outline btn-sm" disabled style="opacity:.5;cursor:not-allowed;">Daftar Tunggu</button>
          @elseif($event->status === 'hampir penuh')
            <span class="event-status-badge status-hampir">Hampir Penuh</span>
            <a href="{{ route('events.show', $event) }}" class="btn-primary btn-sm"><span>Daftar Sekarang</span></a>
          @elseif($event->status === 'selesai')
            <span class="event-status-badge" style="color:var(--text-muted);">Selesai</span>
            <a href="{{ route('events.show', $event) }}" class="btn-outline btn-sm">Lihat Detail</a>
          @else
            <span class="event-status-badge status-open">Pendaftaran Buka</span>
            <a href="{{ route('events.show', $event) }}" class="btn-primary btn-sm"><span>Daftar Sekarang</span></a>
          @endif
        </div>
      </div>
      @endforeach
    </div>

    @else
    <div class="empty-state">
      <div class="empty-state-icon">📅</div>
      <div class="empty-state-title">Belum ada event</div>
      <div class="empty-state-desc">Event akan segera diumumkan. Pantau terus!</div>
    </div>
    @endif

  </div>
</section>

@endsection

@push('styles')
<style>
.page-header { overflow:hidden; }
.page-header-orb { position:absolute; border-radius:50%; filter:blur(70px); pointer-events:none; }
.page-header-orb-1 { width:380px;height:380px;background:radial-gradient(circle,rgba(212,168,83,.18),transparent 70%);top:-80px;right:-40px; }
.page-header-orb-2 { width:250px;height:250px;background:radial-gradient(circle,rgba(26,179,216,.15),transparent 70%);bottom:-40px;left:15%; }

.event-filter-section {
  background:rgba(13,38,69,.6); border-bottom:1px solid var(--glass-border);
  backdrop-filter:blur(12px); position:sticky; top:72px; z-index:100; padding:0 2rem;
}
.event-filter-bar {
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
.event-view-toggle { display:flex; gap:4px; }
.view-btn {
  width:34px; height:34px; border-radius:8px; background:transparent;
  border:1.5px solid var(--glass-border); color:rgba(247,251,252,.5);
  cursor:pointer; display:flex; align-items:center; justify-content:center;
  transition:all var(--transition);
}
.view-btn.active, .view-btn:hover { background:rgba(26,179,216,.12); border-color:var(--ocean-bright); color:var(--ocean-white); }

.event-countdown-banner {
  display:flex; align-items:center; gap:1.5rem;
  background:linear-gradient(135deg,rgba(14,107,138,.4),rgba(26,179,216,.15));
  border:1px solid rgba(26,179,216,.3); border-radius:var(--radius-md);
  padding:1.25rem 1.75rem; flex-wrap:wrap;
}
.countdown-badge {
  padding:4px 12px; border-radius:99px; background:rgba(224,92,58,.2);
  border:1px solid rgba(224,92,58,.4); font-size:.72rem; font-weight:700;
  color:var(--ocean-coral); letter-spacing:.08em; white-space:nowrap;
}
.countdown-info { flex:1; min-width:200px; }
.countdown-title { font-family:var(--font-display); font-size:1rem; font-weight:600; margin-bottom:4px; }
.countdown-date { font-size:.8rem; color:rgba(247,251,252,.6); }
.countdown-timer { display:flex; align-items:center; gap:8px; }
.countdown-unit { text-align:center; }
.countdown-num {
  display:block; font-family:var(--font-display); font-size:1.4rem;
  font-weight:700; color:var(--ocean-foam); min-width:40px; text-align:center;
  background:rgba(0,0,0,.25); border-radius:8px; padding:4px 8px;
}
.countdown-label { font-size:.6rem; letter-spacing:.1em; text-transform:uppercase; color:var(--text-muted); display:block; margin-top:3px; }
.countdown-sep { font-family:var(--font-display); font-size:1.4rem; font-weight:700; color:var(--ocean-foam); opacity:.4; margin-bottom:14px; }
.btn-sm { padding:9px 20px !important; font-size:.82rem !important; }

.events-card-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:20px; }
.event-card-v2 {
  background:var(--glass-bg); border:1px solid var(--glass-border);
  border-radius:var(--radius-md); overflow:hidden; display:flex;
  flex-direction:column; transition:transform var(--transition),box-shadow var(--transition),border-color var(--transition);
  backdrop-filter:blur(12px);
}
.event-card-v2:hover { transform:translateY(-5px); box-shadow:var(--shadow-card),var(--shadow-glow); border-color:rgba(94,231,247,.25); }
.event-card-v2-header {
  position:relative; height:120px;
  background:linear-gradient(135deg,var(--ocean-mid),rgba(14,107,138,.5));
  display:flex; align-items:center; justify-content:center; overflow:hidden;
}
.event-date-badge {
  position:absolute; top:14px; left:14px; background:rgba(10,22,40,.75);
  backdrop-filter:blur(8px); border:1px solid var(--glass-border);
  border-radius:10px; padding:8px 12px; text-align:center; min-width:52px;
}
.event-date-day { font-family:var(--font-display); font-size:1.4rem; font-weight:700; color:var(--ocean-foam); line-height:1; }
.event-date-month { font-size:.6rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:rgba(247,251,252,.6); margin-top:2px; }
.event-icon-wrap { font-size:3rem; opacity:.35; }
.event-type-badge {
  position:absolute; top:14px; right:14px; padding:3px 10px; border-radius:4px;
  font-size:.65rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase;
}
.event-type-kompetisi { background:rgba(212,168,83,.2); color:var(--ocean-gold); border:1px solid rgba(212,168,83,.3); }
.event-type-pelatihan { background:rgba(26,179,216,.15); color:var(--ocean-bright); border:1px solid rgba(26,179,216,.25); }
.event-type-sosial    { background:rgba(46,160,97,.15); color:#6ee09a; border:1px solid rgba(46,160,97,.25); }
.event-type-seminar   { background:rgba(94,231,247,.12); color:var(--ocean-foam); border:1px solid rgba(94,231,247,.2); }

.event-card-v2-body { padding:1.25rem; flex:1; display:flex; flex-direction:column; gap:.75rem; }
.event-card-v2-title { font-family:var(--font-display); font-size:.95rem; font-weight:600; line-height:1.35; color:var(--ocean-white); }
.event-card-v2-desc { font-size:.8rem; color:rgba(247,251,252,.5); line-height:1.65; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
.event-card-v2-meta { display:flex; flex-direction:column; gap:5px; margin-top:auto; }
.event-meta-row { display:flex; align-items:center; gap:6px; font-size:.77rem; color:var(--text-muted); }

.event-slots { margin-top:.5rem; }
.event-slots-label { display:flex; justify-content:space-between; font-size:.72rem; color:var(--text-muted); margin-bottom:5px; }
.event-slots-num { font-weight:600; color:var(--ocean-white); }
.event-slots-bar { height:4px; background:rgba(255,255,255,.08); border-radius:99px; overflow:hidden; }
.event-slots-fill { height:100%; border-radius:99px; transition:width .6s ease; }
.event-slots-open   { background:linear-gradient(90deg,var(--ocean-teal),var(--ocean-bright)); }
.event-slots-almost { background:linear-gradient(90deg,var(--ocean-gold),#f0c060); }
.event-slots-full   { background:linear-gradient(90deg,var(--ocean-coral),#f5856e); }

.event-card-v2-footer {
  padding:1rem 1.25rem; border-top:1px solid var(--glass-border);
  display:flex; align-items:center; justify-content:space-between; gap:.5rem;
}
.event-status-badge { font-size:.7rem; font-weight:700; letter-spacing:.06em; }
.status-open   { color:#6ee09a; }
.status-hampir { color:var(--ocean-gold); }
.status-penuh  { color:var(--ocean-coral); }

.events-card-grid.list-view { grid-template-columns:1fr; }
.events-card-grid.list-view .event-card-v2 { flex-direction:row; }
.events-card-grid.list-view .event-card-v2-header { width:160px; flex-shrink:0; height:auto; }
.events-card-grid.list-view .event-card-v2-footer { border-top:none; border-left:1px solid var(--glass-border); flex-direction:column; width:160px; flex-shrink:0; }

@media(max-width:1024px) { .events-card-grid { grid-template-columns:repeat(2,1fr); } }
@media(max-width:640px) {
  .events-card-grid { grid-template-columns:1fr; }
  .event-countdown-banner { flex-direction:column; align-items:flex-start; }
  .events-card-grid.list-view .event-card-v2 { flex-direction:column; }
  .events-card-grid.list-view .event-card-v2-header { width:100%; height:100px; }
  .events-card-grid.list-view .event-card-v2-footer { border-left:none; border-top:1px solid var(--glass-border); width:100%; flex-direction:row; }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  /* ── COUNTDOWN ── */
  @if($upcoming)
  const target = new Date('{{ $countdownTarget }}');
  function updateCountdown() {
    const diff = target - new Date();
    if (diff <= 0) {
      document.getElementById('countdownTimer').innerHTML = '<span style="color:var(--ocean-foam);font-weight:600;">Event sedang berlangsung!</span>';
      return;
    }
    const d  = Math.floor(diff / 86400000);
    const h  = Math.floor((diff % 86400000) / 3600000);
    const m  = Math.floor((diff % 3600000) / 60000);
    const s  = Math.floor((diff % 60000) / 1000);
    const pad = n => String(n).padStart(2,'0');
    document.getElementById('cdDays').textContent  = pad(d);
    document.getElementById('cdHours').textContent = pad(h);
    document.getElementById('cdMins').textContent  = pad(m);
    document.getElementById('cdSecs').textContent  = pad(s);
  }
  updateCountdown();
  setInterval(updateCountdown, 1000);
  @endif

  /* ── FILTER TABS ── */
  const tabs  = document.querySelectorAll('.filter-tab');
  const cards = document.querySelectorAll('#eventsGrid .event-card-v2');
  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
      const cat = tab.dataset.filter;
      let visible = 0;
      cards.forEach(card => {
        const match = cat === 'semua' || card.dataset.category === cat;
        card.style.display = match ? '' : 'none';
        if (match) visible++;
      });
    });
  });

  /* ── VIEW TOGGLE ── */
  const grid = document.getElementById('eventsGrid');
  document.getElementById('viewGrid')?.addEventListener('click', function() {
    grid?.classList.remove('list-view');
    this.classList.add('active');
    document.getElementById('viewList').classList.remove('active');
  });
  document.getElementById('viewList')?.addEventListener('click', function() {
    grid?.classList.add('list-view');
    this.classList.add('active');
    document.getElementById('viewGrid').classList.remove('active');
  });
});
</script>
@endpush