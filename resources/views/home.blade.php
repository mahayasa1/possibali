@extends('layouts.app')

@section('title', 'POSSI Bali — Organisasi Selam Bali')

@section('content')

<!-- ═══════════════ HERO ═══════════════ -->
<section class="hero" id="home">
  <div class="hero-bg"></div>
  <div class="hero-orb hero-orb-1"></div>
  <div class="hero-orb hero-orb-2"></div>

  <div class="hero-container">
    <!-- LEFT -->
    <div>
      <div class="hero-eyebrow">POSSI BALI</div>
      <h1 class="hero-title">
        INDONESIA SUBAQUATIC SPORTS ASSOCIATION
      </h1>
      <p class="hero-subtitle">Menyelam Lebih Dalam, Berprestasi Lebih Tinggi</p>
      <p class="hero-desc">
        Organisasi selam resmi di Bali untuk pengembangan atlet berprestasi,
        edukasi kelautan, dan pelestarian ekosistem laut Indonesia.
      </p>

      <div class="hero-actions">
        <a href="{{ url('/events') }}" class="btn-primary">
          <span>Lihat Event</span>
        </a>
        <a href="{{ url('/#about') }}" class="btn-outline">Tentang Kami</a>
      </div>

      <div class="hero-stats">
        <div class="stat-item">
          <div class="stat-value" data-counter data-target="{{ $stats['members'] }}">0</div>
          <div class="stat-label">Total Anggota</div>
        </div>
        <div class="stat-item">
          <div class="stat-value" data-counter data-target="{{ $stats['events'] }}">0</div>
          <div class="stat-label">Event Digelar</div>
        </div>
        <div class="stat-item">
          <div class="stat-value" data-counter data-target="{{ $stats['coaches'] }}">0</div>
          <div class="stat-label">Pelatih & Satgas</div>
        </div>
      </div>
    </div>

    <!-- RIGHT — Latest Activity Card -->
    <div class="hero-visual fade-in-up delay-2">
      <div class="hero-card">
        <div class="hero-card-header">
          <div class="hero-card-title">Aktivitas Terkini</div>
          <div class="badge-live">Live</div>
        </div>

        <div class="news-preview-list">
          @forelse($news->take(2) as $item)
          <a href="{{ route('news.show', $item) }}" style="text-decoration:none;">
            <div class="news-preview-item">
              <div class="news-preview-icon icon-news">{{ $item->icon ?? '🌊' }}</div>
              <div class="news-preview-text">
                <p>{{ Str::limit($item->title, 50) }}</p>
                <span>{{ $item->created_at->diffForHumans() }}</span>
              </div>
            </div>
          </a>
          @empty
          <div class="news-preview-item">
            <div class="news-preview-icon icon-news">🌊</div>
            <div class="news-preview-text">
              <p>Berita akan segera hadir</p>
              <span>Pantau terus</span>
            </div>
          </div>
          @endforelse

          @if($events->count() > 0)
          @php $nextEvent = $events->first(); @endphp
          <a href="{{ route('events.show', $nextEvent) }}" style="text-decoration:none;">
            <div class="news-preview-item">
              <div class="news-preview-icon icon-event">📅</div>
              <div class="news-preview-text">
                <p>{{ Str::limit($nextEvent->title, 50) }}</p>
                <span>{{ $nextEvent->event_date->translatedFormat('d F Y') }}</span>
              </div>
            </div>
          </a>
          @endif
        </div>
      </div>
    </div>
  </div>

  <!-- Wave -->
  <div class="hero-waves">
    <svg viewBox="0 0 1440 80" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
      <path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" fill="var(--ocean-mid)" opacity="0.5"/>
      <path d="M0,60 C480,20 960,80 1440,50 L1440,80 L0,80 Z" fill="var(--ocean-deep)"/>
    </svg>
  </div>
</section>

<!-- ═══════════════ ABOUT ═══════════════ -->
<section class="about-strip section" id="about">
  <div class="container about-grid">

    <div class="about-content fade-in-left">
      <div class="section-header" style="text-align:left; margin-bottom:1.5rem;">
        <span class="section-eyebrow">Tentang Kami</span>
        <h2 class="section-title">Organisasi Selam <em>Resmi Bali</em></h2>
      </div>
      <p class="about-desc">
        POSSI Bali adalah organisasi resmi cabang olahraga selam di Bali yang berfokus pada
        pembinaan atlet berprestasi, penyelenggaraan event berkualitas, edukasi kelautan,
        dan pelestarian ekosistem laut Indonesia.
      </p>
      <p class="about-desc">
        Berdiri dengan dukungan penuh dari POSSI Pusat, kami berkomitmen untuk mencetak
        generasi penyelam handal yang siap berlaga di tingkat nasional dan internasional.
      </p>
      <div class="about-features">
        <div class="about-feature">
          <div class="feature-icon">🏆</div>
          <div class="feature-text">
            <strong>Pembinaan Atlet</strong>
            <p>Program latihan intensif berstandar nasional & internasional.</p>
          </div>
        </div>
        <div class="about-feature">
          <div class="feature-icon">🌿</div>
          <div class="feature-text">
            <strong>Konservasi Laut</strong>
            <p>Aktif menjaga dan melestarikan ekosistem laut Bali.</p>
          </div>
        </div>
        <div class="about-feature">
          <div class="feature-icon">🎓</div>
          <div class="feature-text">
            <strong>Edukasi & Sertifikasi</strong>
            <p>Program sertifikasi selam berstandar CMAS & SSI.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="about-visual fade-in-up delay-2">
      <div class="about-card">
        <div class="about-card-icon">🤿</div>
        <div class="about-card-value" data-counter data-target="{{ $stats['athletes'] }}">0</div>
        <div class="about-card-label">Total Atlet Terdaftar</div>
      </div>
      <div class="about-card">
        <div class="about-card-icon">🏅</div>
        <div class="about-card-value" data-counter data-target="{{ $clubs->where('is_champion', true)->count() }}">0</div>
        <div class="about-card-label">Club Berprestasi</div>
      </div>
      <div class="about-card">
        <div class="about-card-icon">📅</div>
        <div class="about-card-value" data-counter data-target="{{ $stats['events'] }}">0</div>
        <div class="about-card-label">Event Diselenggarakan</div>
      </div>
      <div class="about-card">
        <div class="about-card-icon">⭐</div>
        <div class="about-card-value" data-counter data-target="{{ $stats['coaches'] }}">0</div>
        <div class="about-card-label">Pelatih & Satgas Aktif</div>
      </div>
    </div>

  </div>
</section>

<!-- ═══════════════ NEWS ═══════════════ -->
<section class="section news-section" id="news">
  <div class="container">
    <div class="section-header fade-in-up">
      <span class="section-eyebrow">Informasi Terkini</span>
      <h2 class="section-title">Berita <em>Terbaru</em></h2>
      <p class="section-desc">
        Update terbaru seputar dunia selam, kegiatan organisasi, dan prestasi atlet POSSI Bali.
      </p>
    </div>

    @if($news->count() > 0)
    <div class="news-grid">
      @foreach($news as $i => $item)
      <div class="news-card fade-in-up delay-{{ $i + 1 }}">
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
            <span>{{ $item->created_at->translatedFormat('d M Y') }}</span>
            <span class="news-card-meta-dot">·</span>
            <span>{{ $item->read_time }} mnt baca</span>
          </div>
          <h3 class="news-card-title">{{ Str::limit($item->title, 65) }}</h3>
          <p class="news-card-excerpt">
            {{ $item->excerpt ?? Str::limit(strip_tags($item->content), 100) }}
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
    @else
    <div class="empty-state">
      <div class="empty-state-icon">📭</div>
      <div class="empty-state-title">Belum ada berita</div>
      <div class="empty-state-desc">Berita akan segera hadir.</div>
    </div>
    @endif

    <div class="section-footer fade-in-up">
      <a href="{{ url('/news') }}" class="btn-outline">Lihat Semua Berita →</a>
    </div>
  </div>
</section>

<!-- ═══════════════ EVENTS ═══════════════ -->
<section class="section events-section" id="events">
  <div class="container">
    <div class="section-header fade-in-up">
      <span class="section-eyebrow">Agenda Kegiatan</span>
      <h2 class="section-title">Event <em>Mendatang</em></h2>
      <p class="section-desc">
        Jadwal kompetisi, pelatihan, dan kegiatan POSSI Bali yang bisa kamu ikuti.
      </p>
    </div>

    @if($events->count() > 0)
    <div class="events-grid">
      @foreach($events as $i => $event)
      @php
        $statusColors = [
          'open'         => ['bg'=>'rgba(46,160,97,.15)','color'=>'#6ee09a'],
          'hampir penuh' => ['bg'=>'rgba(212,168,83,.15)','color'=>'var(--ocean-gold)'],
          'penuh'        => ['bg'=>'rgba(224,92,58,.15)','color'=>'var(--ocean-coral)'],
          'selesai'      => ['bg'=>'rgba(255,255,255,.06)','color'=>'rgba(247,251,252,.4)'],
        ];
        $sc = $statusColors[$event->status] ?? $statusColors['open'];
      @endphp
      <div class="event-card fade-in-up delay-{{ ($i % 2) + 1 }}">
        <div class="event-date">
          <div class="event-date-day">{{ $event->event_date->format('d') }}</div>
          <div class="event-date-month">{{ strtoupper($event->event_date->locale('id')->isoFormat('MMM')) }}</div>
        </div>
        <div class="event-info">
          <div class="event-type">{{ ucfirst($event->type) }}</div>
          <div class="event-title">{{ Str::limit($event->title, 55) }}</div>
          <div class="event-meta">
            <div class="event-meta-item">
              <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M6 1C4.34 1 3 2.34 3 4c0 2.84 3 6 3 6s3-3.16 3-6c0-1.66-1.34-3-3-3zm0 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" fill="currentColor" opacity=".6"/></svg>
              {{ $event->location }}
            </div>
            <div class="event-meta-item">
              <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><circle cx="6" cy="6" r="5" stroke="currentColor" stroke-width="1.2" opacity=".6"/><path d="M6 3.5v3l2 1" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" opacity=".6"/></svg>
              {{ \Carbon\Carbon::parse($event->start_time)->format('H.i') }} WITA
            </div>
            <div class="event-meta-item">
              <span style="display:inline-block; padding:2px 8px; border-radius:4px; font-size:.68rem; font-weight:700; background:{{ $sc['bg'] }}; color:{{ $sc['color'] }};">
                {{ ucfirst($event->status) }}
              </span>
            </div>
          </div>
        </div>
        <a href="{{ route('events.show', $event) }}" class="event-card-btn btn-outline" style="padding:7px 16px; font-size:.8rem; flex-shrink:0;">
          Detail
        </a>
      </div>
      @endforeach
    </div>
    @else
    <div class="empty-state">
      <div class="empty-state-icon">📅</div>
      <div class="empty-state-title">Belum ada event mendatang</div>
      <div class="empty-state-desc">Event akan segera diumumkan.</div>
    </div>
    @endif

    <div class="section-footer fade-in-up">
      <a href="{{ url('/events') }}" class="btn-outline">Lihat Semua Event →</a>
    </div>
  </div>
</section>

<!-- ═══════════════ CLUBS ═══════════════ -->
<section class="section" id="clubs" style="background:linear-gradient(180deg, var(--ocean-deep) 0%, var(--ocean-mid) 100%);">
  <div class="container">
    <div class="section-header fade-in-up">
      <span class="section-eyebrow">Komunitas Selam</span>
      <h2 class="section-title">Club Selam <em>Unggulan</em></h2>
      <p class="section-desc">
        Club-club selam terbaik yang terdaftar resmi di POSSI Bali.
      </p>
    </div>

    @if($clubs->count() > 0)
    <div class="home-clubs-grid">
      @foreach($clubs->take(6) as $i => $club)
      <a href="{{ route('clubs.show', $club) }}" class="home-club-card fade-in-up delay-{{ ($i % 3) + 1 }}">
        <div class="home-club-icon">{{ $club->icon ?? '🤿' }}</div>
        <div class="home-club-info">
          <div class="home-club-name">{{ $club->name }}</div>
          <div class="home-club-city">
            <svg width="11" height="11" viewBox="0 0 12 12" fill="none"><path d="M6 1C4.34 1 3 2.34 3 4c0 2.84 3 6 3 6s3-3.16 3-6c0-1.66-1.34-3-3-3zm0 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" fill="currentColor" opacity=".5"/></svg>
            {{ $club->city }}
          </div>
          @if($club->specialty)
          <div class="home-club-specialty">{{ $club->specialty }}</div>
          @endif
        </div>
        <div class="home-club-stat">
          <div class="home-club-stat-val">{{ number_format($club->member_count) }}</div>
          <div class="home-club-stat-label">Anggota</div>
        </div>
        @if($club->is_champion)
        <div class="home-club-champion">⭐</div>
        @endif
        @if($club->is_verified)
        <div class="home-club-verified" title="Terverifikasi">
          <svg width="10" height="10" viewBox="0 0 12 12" fill="none"><path d="M6 1l1.1 2.3 2.5.4-1.8 1.7.4 2.5L6 6.8 3.8 7.9l.4-2.5L2.4 3.7l2.5-.4L6 1z" fill="var(--ocean-bright)"/></svg>
        </div>
        @endif
      </a>
      @endforeach
    </div>
    @else
    <div class="empty-state">
      <div class="empty-state-icon">🤿</div>
      <div class="empty-state-title">Belum ada club terdaftar</div>
    </div>
    @endif

    <div class="section-footer fade-in-up">
      <a href="{{ url('/clubs') }}" class="btn-outline">Lihat Semua Club →</a>
    </div>
  </div>
</section>

<!-- ═══════════════ SATGAS ═══════════════ -->
<section class="section" id="satgas" style="background:var(--ocean-deep);">
  <div class="container">
    <div class="section-header fade-in-up">
      <span class="section-eyebrow">Tim Khusus</span>
      <h2 class="section-title">Satgas <em>POSSI Bali</em></h2>
      <p class="section-desc">
        Satuan tugas khusus yang berperan dalam SAR, konservasi, pembinaan prestasi, dan regulasi.
      </p>
    </div>

    @if($satgas->count() > 0)
    <div class="home-satgas-grid">
      @foreach($satgas->take(6) as $i => $person)
      @php
        $unitColors = [
          'sar'        => ['color'=>'#f5856e','bg'=>'rgba(224,92,58,.15)','label'=>'SAR'],
          'konservasi' => ['color'=>'#6ee09a','bg'=>'rgba(46,160,97,.15)','label'=>'Konservasi'],
          'prestasi'   => ['color'=>'var(--ocean-gold)','bg'=>'rgba(212,168,83,.15)','label'=>'Prestasi'],
          'regulasi'   => ['color'=>'var(--ocean-bright)','bg'=>'rgba(26,179,216,.15)','label'=>'Regulasi'],
        ];
        $uc = $unitColors[$person->unit] ?? $unitColors['regulasi'];
      @endphp
      <a href="{{ route('satgas.show', $person) }}" class="home-satgas-card fade-in-up delay-{{ ($i % 3) + 1 }}">
        <div class="home-satgas-avatar" style="background:linear-gradient(135deg,{{ $uc['color'] }}33,{{ $uc['color'] }}11); border-color:{{ $uc['color'] }}44;">
          {{ $person->avatar_initials }}
        </div>
        <div class="home-satgas-info">
          <div class="home-satgas-name">{{ $person->name }}</div>
          <div class="home-satgas-role">{{ $person->role }}</div>
          <span class="home-satgas-unit" style="background:{{ $uc['bg'] }}; color:{{ $uc['color'] }};">
            {{ $uc['label'] }}
          </span>
        </div>
      </a>
      @endforeach
    </div>
    @else
    <div class="empty-state">
      <div class="empty-state-icon">⭐</div>
      <div class="empty-state-title">Belum ada personel</div>
    </div>
    @endif

    <div class="section-footer fade-in-up">
      <a href="{{ url('/satgas') }}" class="btn-outline">Lihat Semua Satgas →</a>
    </div>
  </div>
</section>

<!-- ═══════════════ GALLERY ═══════════════ -->
<section class="section gallery-section" id="gallery" style="background:linear-gradient(180deg, var(--ocean-deep) 0%, var(--ocean-mid) 100%);">
  <div class="container">
    <div class="section-header fade-in-up">
      <span class="section-eyebrow">Galeri</span>
      <h2 class="section-title">Momen <em>Terbaik</em></h2>
    </div>
    <div class="gallery-grid fade-in-up">
      <div class="gallery-item">
        <div class="gallery-img">🌊</div>
        <div class="gallery-overlay"><div class="gallery-overlay-text">Underwater World</div></div>
      </div>
      <div class="gallery-item">
        <div class="gallery-img">🐠</div>
        <div class="gallery-overlay"><div class="gallery-overlay-text">Marine Life Bali</div></div>
      </div>
      <div class="gallery-item">
        <div class="gallery-img">🤿</div>
        <div class="gallery-overlay"><div class="gallery-overlay-text">Dive Training</div></div>
      </div>
      <div class="gallery-item">
        <div class="gallery-img">🌿</div>
        <div class="gallery-overlay"><div class="gallery-overlay-text">Conservation</div></div>
      </div>
      <div class="gallery-item">
        <div class="gallery-img">🏆</div>
        <div class="gallery-overlay"><div class="gallery-overlay-text">Competition</div></div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════ CTA JOIN ═══════════════ -->
<section class="section members-section" id="join">
  <div class="container">
    <div class="members-cta-card fade-in-up">
      <div class="members-icon">🤿</div>
      <h2 class="members-cta-title">Bergabung dengan POSSI Bali</h2>
      <p class="members-cta-desc">
        Jadilah bagian dari komunitas selam terbesar di Bali. Dapatkan akses pelatihan,
        sertifikasi internasional, kompetisi, dan program pelestarian laut bersama kami.
      </p>
      <div class="members-benefits">
        <div class="benefit-item">
          <span class="benefit-icon">✓</span> Sertifikat Resmi POSSI
        </div>
        <div class="benefit-item">
          <span class="benefit-icon">✓</span> Akses Kompetisi Nasional
        </div>
        <div class="benefit-item">
          <span class="benefit-icon">✓</span> Jaringan Instruktur Berpengalaman
        </div>
        <div class="benefit-item">
          <span class="benefit-icon">✓</span> Program Beasiswa Atlet
        </div>
      </div>
      <div class="hero-actions">
        <a href="{{ url('/contact') }}" class="btn-primary"><span>Hubungi Kami</span></a>
        <a href="{{ url('/clubs') }}" class="btn-outline">Lihat Club</a>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════ CONTACT ═══════════════ -->
<section class="section contact-section" id="contact">
  <div class="container contact-grid">

    <div class="contact-info fade-in-left">
      <div class="section-header" style="text-align:left; margin-bottom:2rem;">
        <span class="section-eyebrow">Hubungi Kami</span>
        <h2 class="section-title">Ada <em>Pertanyaan?</em></h2>
      </div>
      <div class="contact-items">
        <div class="contact-item">
          <div class="contact-item-icon">📍</div>
          <div>
            <div class="contact-item-label">Alamat</div>
            <div class="contact-item-value">Denpasar, Bali — Indonesia</div>
          </div>
        </div>
        <div class="contact-item">
          <div class="contact-item-icon">📞</div>
          <div>
            <div class="contact-item-label">Telepon</div>
            <div class="contact-item-value">+62 361 000 0000</div>
          </div>
        </div>
        <div class="contact-item">
          <div class="contact-item-icon">✉️</div>
          <div>
            <div class="contact-item-label">Email</div>
            <div class="contact-item-value">info@possibali.org</div>
          </div>
        </div>
        <div class="contact-item">
          <div class="contact-item-icon">🕐</div>
          <div>
            <div class="contact-item-label">Jam Operasional</div>
            <div class="contact-item-value">Senin – Jumat, 08.00–17.00 WITA</div>
          </div>
        </div>
      </div>
    </div>

    <div class="contact-form-wrap fade-in-up delay-2">
      <div class="form-title">Kirim Pesan</div>
      <form id="contact-form">
        @csrf
        <div class="form-row">
          <div class="form-group">
            <label class="form-group">Nama</label>
            <input type="text" class="form-control" placeholder="Nama lengkap Anda" required>
          </div>
          <div class="form-group">
            <label class="form-group">Email</label>
            <input type="email" class="form-control" placeholder="email@contoh.com" required>
          </div>
        </div>
        <div class="form-group">
          <label>Subjek</label>
          <input type="text" class="form-control" placeholder="Subjek pesan">
        </div>
        <div class="form-group">
          <label>Pesan</label>
          <textarea class="form-control" rows="4" placeholder="Tulis pesan Anda di sini..." required></textarea>
        </div>
        <button type="submit" class="btn-primary" style="width:100%;">
          <span>Kirim Pesan</span>
        </button>
      </form>
    </div>

  </div>
</section>

@endsection

@push('styles')
<style>
/* ── HERO SUBTITLE ── */
.hero-subtitle {
  font-family: var(--font-accent);
  font-size: 1.1rem;
  font-style: italic;
  color: var(--ocean-sand);
  margin-bottom: 1rem;
  opacity: .8;
}

/* ── EVENT CARD EXTENDED ── */
.event-card {
  align-items: center;
  justify-content: space-between;
}
.event-card-btn { margin-left: auto; }

/* ── HOME CLUBS GRID ── */
.home-clubs-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
  margin-bottom: 2.5rem;
}

.home-club-card {
  display: flex;
  align-items: center;
  gap: 14px;
  background: var(--glass-bg);
  border: 1px solid var(--glass-border);
  border-radius: var(--radius-md);
  padding: 1.1rem 1.25rem;
  text-decoration: none;
  position: relative;
  transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition);
  backdrop-filter: blur(12px);
  overflow: hidden;
}

.home-club-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-glow);
  border-color: rgba(94, 231, 247, .25);
}

.home-club-icon { font-size: 2rem; flex-shrink: 0; }

.home-club-info { flex: 1; min-width: 0; }

.home-club-name {
  font-family: var(--font-display);
  font-size: .9rem;
  font-weight: 600;
  color: var(--ocean-white);
  margin-bottom: 3px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.home-club-city {
  display: flex;
  align-items: center;
  gap: 4px;
  font-size: .72rem;
  color: var(--text-muted);
  margin-bottom: 4px;
}

.home-club-specialty {
  font-size: .68rem;
  color: rgba(247,251,252,.45);
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.home-club-stat { text-align: right; flex-shrink: 0; }
.home-club-stat-val { font-family: var(--font-display); font-size: 1.1rem; font-weight: 700; color: var(--ocean-foam); line-height: 1; }
.home-club-stat-label { font-size: .62rem; color: rgba(247,251,252,.4); letter-spacing: .04em; }

.home-club-champion {
  position: absolute;
  top: 6px; right: 6px;
  font-size: .75rem;
}

.home-club-verified {
  position: absolute;
  bottom: 8px; right: 10px;
  opacity: .7;
}

/* ── HOME SATGAS GRID ── */
.home-satgas-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
  margin-bottom: 2.5rem;
}

.home-satgas-card {
  display: flex;
  align-items: center;
  gap: 14px;
  background: var(--glass-bg);
  border: 1px solid var(--glass-border);
  border-radius: var(--radius-md);
  padding: 1.1rem 1.25rem;
  text-decoration: none;
  transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition);
  backdrop-filter: blur(12px);
}

.home-satgas-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-glow);
  border-color: rgba(94, 231, 247, .25);
}

.home-satgas-avatar {
  width: 46px; height: 46px;
  border-radius: 50%;
  border: 1.5px solid;
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: var(--font-display);
  font-size: .95rem;
  font-weight: 700;
  color: var(--ocean-white);
  flex-shrink: 0;
}

.home-satgas-info { flex: 1; min-width: 0; }

.home-satgas-name {
  font-size: .88rem;
  font-weight: 600;
  color: var(--ocean-white);
  margin-bottom: 2px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.home-satgas-role {
  font-size: .72rem;
  color: rgba(247,251,252,.5);
  margin-bottom: 5px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.home-satgas-unit {
  display: inline-block;
  padding: 2px 8px;
  border-radius: 4px;
  font-size: .62rem;
  font-weight: 700;
  letter-spacing: .08em;
  text-transform: uppercase;
}

/* ── RESPONSIVE ── */
@media (max-width: 1024px) {
  .home-clubs-grid  { grid-template-columns: repeat(2, 1fr); }
  .home-satgas-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 640px) {
  .home-clubs-grid  { grid-template-columns: 1fr; }
  .home-satgas-grid { grid-template-columns: 1fr; }
  .event-card { flex-wrap: wrap; }
  .event-card-btn { width: 100%; justify-content: center; }
}
</style>
@endpush