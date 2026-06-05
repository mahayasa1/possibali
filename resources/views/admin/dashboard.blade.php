@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan aktivitas POSSI Bali')

@section('content')

<!-- ── STAT CARDS ── -->
<div class="stat-grid">

  <div class="stat-card">
    <div class="stat-card-top">
      <div class="stat-card-icon" style="background:rgba(26,179,216,.12); color:var(--ocean-bright);">📰</div>
      <span class="stat-card-change" style="background:rgba(46,160,97,.1); color:#6ee09a;">
        {{ $stats['published_news'] }} live
      </span>
    </div>
    <div class="stat-card-num">{{ $stats['news'] }}</div>
    <div class="stat-card-label">Total Berita</div>
  </div>

  <div class="stat-card">
    <div class="stat-card-top">
      <div class="stat-card-icon" style="background:rgba(212,168,83,.12); color:var(--ocean-gold);">📅</div>
      <span class="stat-card-change" style="background:rgba(212,168,83,.1); color:var(--ocean-gold);">
        {{ $stats['upcoming_events'] }} aktif
      </span>
    </div>
    <div class="stat-card-num">{{ $stats['events'] }}</div>
    <div class="stat-card-label">Total Events</div>
  </div>

  <div class="stat-card">
    <div class="stat-card-top">
      <div class="stat-card-icon" style="background:rgba(94,231,247,.1); color:var(--ocean-foam);">🤿</div>
      <span class="stat-card-change" style="background:rgba(46,160,97,.1); color:#6ee09a;">
        {{ $stats['active_clubs'] }} aktif
      </span>
    </div>
    <div class="stat-card-num">{{ $stats['clubs'] }}</div>
    <div class="stat-card-label">Club Selam</div>
  </div>

  <div class="stat-card">
    <div class="stat-card-top">
      <div class="stat-card-icon" style="background:rgba(224,92,58,.1); color:var(--ocean-coral);">⭐</div>
      <span class="stat-card-change" style="background:rgba(26,179,216,.1); color:var(--ocean-bright);">
        {{ $stats['members'] }} user
      </span>
    </div>
    <div class="stat-card-num">{{ $stats['satgas'] }}</div>
    <div class="stat-card-label">Personel Satgas</div>
  </div>

</div>

<!-- ── TWO COLUMN ── -->
<div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem;">

  <!-- Latest News -->
  <div class="admin-card">
    <div class="admin-card-header">
      <div class="admin-card-title">Berita Terbaru</div>
      <a href="{{ route('admin.news.create') }}" class="topbar-btn topbar-btn-primary" style="font-size:.78rem; padding:6px 12px;">
        + Tambah
      </a>
    </div>
    <div class="admin-table-wrap">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($latestNews as $n)
          <tr>
            <td>
              <a href="{{ route('admin.news.edit', $n) }}" style="color:var(--ocean-white); font-weight:500; font-size:.84rem;">
                {{ Str::limit($n->title, 40) }}
              </a>
            </td>
            <td><span class="badge badge-info">{{ $n->category }}</span></td>
            <td>
              @if($n->is_published)
                <span class="badge badge-success">Publik</span>
              @else
                <span class="badge badge-muted">Draft</span>
              @endif
            </td>
          </tr>
          @empty
          <tr><td colspan="3" style="text-align:center; color:var(--text-muted); padding:2rem;">Belum ada berita</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div style="padding:.75rem 1.5rem; border-top:1px solid var(--glass-border);">
      <a href="{{ route('admin.news.index') }}" style="font-size:.8rem; color:var(--ocean-bright); font-weight:600;">
        Lihat semua berita →
      </a>
    </div>
  </div>

  <!-- Latest Events -->
  <div class="admin-card">
    <div class="admin-card-header">
      <div class="admin-card-title">Events Terbaru</div>
      <a href="{{ route('admin.events.create') }}" class="topbar-btn topbar-btn-primary" style="font-size:.78rem; padding:6px 12px;">
        + Tambah
      </a>
    </div>
    <div class="admin-table-wrap">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Event</th>
            <th>Tanggal</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($latestEvents as $e)
          <tr>
            <td>
              <a href="{{ route('admin.events.edit', $e) }}" style="color:var(--ocean-white); font-weight:500; font-size:.84rem;">
                {{ Str::limit($e->title, 35) }}
              </a>
            </td>
            <td style="color:var(--text-muted); font-size:.8rem;">
              {{ \Carbon\Carbon::parse($e->event_date)->format('d M Y') }}
            </td>
            <td>
              @php
                $sc = ['open'=>'badge-success','hampir penuh'=>'badge-warning','penuh'=>'badge-danger','selesai'=>'badge-muted'];
              @endphp
              <span class="badge {{ $sc[$e->status] ?? 'badge-info' }}">{{ $e->status }}</span>
            </td>
          </tr>
          @empty
          <tr><td colspan="3" style="text-align:center; color:var(--text-muted); padding:2rem;">Belum ada event</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div style="padding:.75rem 1.5rem; border-top:1px solid var(--glass-border);">
      <a href="{{ route('admin.events.index') }}" style="font-size:.8rem; color:var(--ocean-bright); font-weight:600;">
        Lihat semua event →
      </a>
    </div>
  </div>

</div>

<!-- ── QUICK LINKS ── -->
<div style="display:grid; grid-template-columns:repeat(4,1fr); gap:1rem; margin-top:1.5rem;">
  @php
    $quickLinks = [
      ['icon'=>'📰','title'=>'Berita','sub'=>'Kelola artikel berita','route'=>'admin.news.index','color'=>'var(--ocean-bright)'],
      ['icon'=>'📅','title'=>'Events','sub'=>'Kelola event & kompetisi','route'=>'admin.events.index','color'=>'var(--ocean-gold)'],
      ['icon'=>'🤿','title'=>'Club','sub'=>'Kelola club selam','route'=>'admin.clubs.index','color'=>'var(--ocean-foam)'],
      ['icon'=>'⭐','title'=>'Satgas','sub'=>'Kelola personel satgas','route'=>'admin.satgas.index','color'=>'#f5856e'],
    ];
  @endphp
  @foreach($quickLinks as $ql)
  <a href="{{ route($ql['route']) }}" style="text-decoration:none;">
    <div class="admin-card" style="padding:1.25rem; transition:transform .2s, box-shadow .2s; cursor:pointer;"
         onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='var(--shadow-glow)'"
         onmouseout="this.style.transform='';this.style.boxShadow=''">
      <div style="font-size:1.8rem; margin-bottom:.6rem;">{{ $ql['icon'] }}</div>
      <div style="font-family:var(--font-display); font-size:.95rem; font-weight:600; color:{{ $ql['color'] }}; margin-bottom:.25rem;">{{ $ql['title'] }}</div>
      <div style="font-size:.78rem; color:rgba(247,251,252,.5);">{{ $ql['sub'] }}</div>
    </div>
  </a>
  @endforeach
</div>

@endsection