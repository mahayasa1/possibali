@extends('layouts.app')

@section('title', 'POSSI Bali')

@section('content')
<!-- HERO -->
<section class="hero" id="home">
  <div class="hero-bg"></div>

  <div class="hero-orb hero-orb-1"></div>
  <div class="hero-orb hero-orb-2"></div>

  <div class="hero-container">
    <div>
      <div class="hero-eyebrow">POSSI BALI</div>
      <h1 class="hero-title">
        INDONESIA SUBAQUATIC SPORTS ASSOCIATION
      </h1>
      <p class="hero-desc">
        Organisasi selam resmi di Bali untuk pengembangan atlet, edukasi,
        dan pelestarian laut Indonesia.
      </p>

      <div class="hero-actions">
        <a href="#contact" class="btn-primary"><span>Join Sekarang</span></a>
        <a href="#about" class="btn-outline">Pelajari</a>
      </div>

      <div class="hero-stats">
        <div>
          <div class="stat-value" data-counter data-target="1200">0</div>
          <div class="stat-label">Member</div>
        </div>
        <div>
          <div class="stat-value" data-counter data-target="85">0</div>
          <div class="stat-label">Event</div>
        </div>
      </div>
    </div>

    <!-- CARD -->
    <div class="hero-visual">
      <div class="hero-card">
        <div class="hero-card-header">
          <div class="hero-card-title">Latest Activity</div>
          <div class="badge-live">Live</div>
        </div>

        <div class="news-preview-list">
          <div class="news-preview-item">
            <div class="news-preview-icon icon-news">🌊</div>
            <div class="news-preview-text">
              <p>Pelatihan Selam Nasional</p>
              <span>2 hari lalu</span>
            </div>
          </div>

          <div class="news-preview-item">
            <div class="news-preview-icon icon-event">📅</div>
            <div class="news-preview-text">
              <p>Event Laut Bersih Bali</p>
              <span>1 minggu lalu</span>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ABOUT -->
<section class="about-strip section" id="about">
  <div class="container about-grid">

    <div class="about-content">
      <h2 class="section-title">Tentang POSSI Bali</h2>
      <p class="about-desc">
        POSSI Bali adalah organisasi resmi yang berfokus pada olahraga selam,
        pembinaan atlet, serta pelestarian ekosistem laut.
      </p>
    </div>

    <div class="about-visual">
      <div class="about-card">
        <div class="about-card-value" data-counter data-target="50">0</div>
        <div class="about-card-label">Pelatih</div>
      </div>

      <div class="about-card">
        <div class="about-card-value" data-counter data-target="300">0</div>
        <div class="about-card-label">Atlet</div>
      </div>
    </div>

  </div>
</section>

<!-- NEWS -->
<section class="section news-section" id="news">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">Berita Terbaru</h2>
    </div>

    <div class="news-grid">
      <div class="news-card">
        <div class="news-card-img"></div>
        <div class="news-card-body">
          <div class="news-card-title">Kompetisi Selam Bali 2026</div>
          <p class="news-card-excerpt">
            Kompetisi tahunan dengan peserta nasional.
          </p>
        </div>
      </div>

      <div class="news-card">
        <div class="news-card-img"></div>
        <div class="news-card-body">
          <div class="news-card-title">Program Edukasi Laut</div>
          <p class="news-card-excerpt">
            Edukasi untuk menjaga ekosistem laut Bali.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- EVENTS -->
<section class="section events-section" id="events">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">Event Mendatang</h2>
    </div>

    <div class="events-grid">
      <div class="event-card">
        <div class="event-date">
          <div class="event-date-day">12</div>
          <div class="event-date-month">JUL</div>
        </div>
        <div>
          <div class="event-title">Pelatihan Selam</div>
          <div class="event-meta">Denpasar</div>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- GALLERY -->
<section class="section gallery-section" id="gallery">
  <div class="container">
    <div class="gallery-grid">
      <div class="gallery-item">
        <div class="gallery-img">🌊</div>
        <div class="gallery-overlay">
          <div class="gallery-overlay-text">Diving Activity</div>
        </div>
      </div>

      <div class="gallery-item">
        <div class="gallery-img">🐠</div>
      </div>

      <div class="gallery-item">
        <div class="gallery-img">🤿</div>
      </div>
    </div>
  </div>
</section>

<!-- CONTACT -->
<section class="section contact-section" id="contact">
  <div class="container contact-grid">

    <div class="contact-info">
      <h2 class="section-title">Kontak</h2>
      <p>Hubungi kami untuk bergabung</p>
    </div>

    <div class="contact-form-wrap">
      <form id="contact-form">
        <input class="form-control" placeholder="Nama">
        <input class="form-control" placeholder="Email">
        <textarea class="form-control" placeholder="Pesan"></textarea>
        <button type="submit" class="btn-primary">
          <span>Kirim</span>
        </button>
      </form>
    </div>

  </div>
</section>
@endsection