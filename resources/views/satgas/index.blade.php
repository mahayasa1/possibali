@extends('layouts.app')

@section('title', 'Satgas — Jaladwipa Rakcaka Task Force')

@section('content')

{{-- ═══════════════ PAGE HEADER ═══════════════ --}}
<section class="page-header" style="position:relative;overflow:hidden;">
  <div style="position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at 70% 30%,rgba(14,107,138,.2) 0%,transparent 60%),radial-gradient(ellipse 50% 60% at 15% 75%,rgba(26,179,216,.1) 0%,transparent 60%);pointer-events:none;"></div>
  <div class="container" style="position:relative;z-index:2;">
    <div class="page-header-eyebrow fade-in-up">Pengprov POSSI Bali · 2026–2030</div>
    <div class="page-header-logo fade-in-up">
      <img src="{{ asset('img/jaladiwpa_logo.png') }}" alt="Logo Jaladwipa">
    </div>
    
    <h1 class="page-header-title fade-in-up delay-1">
      Jaladhipa <em>Dewata</em>
    </h1>
    <p class="page-header-desc fade-in-up delay-2">
      Bali Marine Sport Tourism Ecosystem — satuan tugas strategis pengembangan
      olahraga bawah air Bali menuju pusat sport tourism Indonesia dan Asia Pasifik.
    </p>
  </div>
</section>

{{-- ═══════════════ VISI ═══════════════ --}}
<section class="section" style="padding:4rem 2rem;background:linear-gradient(170deg,var(--ocean-mid),var(--ocean-deep));">
  <div class="container">
    <div style="max-width:760px;margin:0 auto;text-align:center;" class="fade-in-up">
      <div class="section-eyebrow">Visi 2030</div>
      <p style="font-family:var(--font-accent);font-size:clamp(1.15rem,2.2vw,1.5rem);font-weight:300;font-style:italic;color:var(--ocean-sand);line-height:1.75;margin-top:.75rem;">
        "Terwujudnya Bali sebagai pusat sport tourism olahraga bawah air Indonesia
        dan Asia Pasifik yang berbasis prestasi, konservasi laut, dan ekonomi biru."
      </p>
      <div style="width:48px;height:2px;background:var(--ocean-teal);margin:1.75rem auto 0;border-radius:2px;"></div>
    </div>
  </div>
</section>

{{-- ═══════════════ 3 PILAR UTAMA ═══════════════ --}}
<section class="section" style="background:var(--ocean-deep);padding:5rem 2rem;">
  <div class="container">
    <div class="section-header">
      <div class="section-eyebrow">Tiga Pilar Strategis</div>
      <h2 class="section-title">Fondasi <em>Ekosistem</em></h2>
    </div>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;">

      <div class="about-card fade-in-up delay-1" style="background:var(--glass-bg);border:1px solid var(--glass-border);border-radius:var(--radius-md);padding:2rem;text-align:center;backdrop-filter:blur(12px);transition:transform var(--transition),box-shadow var(--transition);">
        <div style="font-size:2.5rem;margin-bottom:1rem;">🏆</div>
        <h3 style="font-family:var(--font-display);font-size:1rem;font-weight:600;margin-bottom:.6rem;">Prestasi</h3>
        <p style="font-size:.82rem;color:rgba(247,251,252,.55);line-height:1.65;">Pembinaan atlet olahraga bawah air berdaya saing nasional dan internasional — menuju PON, SEA Games, dan kejuaraan dunia.</p>
      </div>

      <div class="about-card fade-in-up delay-2" style="background:var(--glass-bg);border:1px solid var(--glass-border);border-radius:var(--radius-md);padding:2rem;text-align:center;backdrop-filter:blur(12px);transition:transform var(--transition),box-shadow var(--transition);">
        <div style="font-size:2.5rem;margin-bottom:1rem;">🌿</div>
        <h3 style="font-family:var(--font-display);font-size:1rem;font-weight:600;margin-bottom:.6rem;">Konservasi Laut</h3>
        <p style="font-size:.82rem;color:rgba(247,251,252,.55);line-height:1.65;">Coral restoration, citizen science diver, ocean clean-up, dan kampanye keberlanjutan ekosistem laut Bali.</p>
      </div>

      <div class="about-card fade-in-up delay-3" style="background:var(--glass-bg);border:1px solid var(--glass-border);border-radius:var(--radius-md);padding:2rem;text-align:center;backdrop-filter:blur(12px);transition:transform var(--transition),box-shadow var(--transition);">
        <div style="font-size:2.5rem;margin-bottom:1rem;">🌊</div>
        <h3 style="font-family:var(--font-display);font-size:1rem;font-weight:600;margin-bottom:.6rem;">Ekonomi Biru</h3>
        <p style="font-size:.82rem;color:rgba(247,251,252,.55);line-height:1.65;">Integrasi sport tourism dengan industri pariwisata, pemberdayaan masyarakat pesisir, dan branding internasional Bali.</p>
      </div>

    </div>
  </div>
</section>

{{-- ═══════════════ PROGRAM PRIORITAS ═══════════════ --}}
<section class="section" style="background:linear-gradient(170deg,var(--ocean-mid),var(--ocean-deep));padding:5rem 2rem;">
  <div class="container">
    <div class="section-header">
      <div class="section-eyebrow">Program Unggulan</div>
      <h2 class="section-title">Lima <em>Program Prioritas</em></h2>
      <p class="section-desc">Inisiatif strategis yang mengintegrasikan olahraga, pariwisata, dan pelestarian laut.</p>
    </div>

    <div style="display:flex;flex-direction:column;gap:16px;">

      {{-- P1 --}}
      <div class="event-card fade-in-up delay-1" style="display:flex;gap:20px;background:var(--glass-bg);border:1px solid var(--glass-border);border-radius:var(--radius-md);padding:1.5rem;backdrop-filter:blur(12px);">
        <div style="flex-shrink:0;width:56px;height:56px;border-radius:var(--radius-sm);background:linear-gradient(135deg,var(--ocean-teal),var(--ocean-bright));display:flex;align-items:center;justify-content:center;font-size:1.5rem;">🎪</div>
        <div>
          <div class="event-type">Program 01</div>
          <h3 class="event-title">Bali International Underwater Festival</h3>
          <p style="font-size:.82rem;color:rgba(247,251,252,.55);line-height:1.6;margin-top:.25rem;">Flagship event tahunan — kejuaraan olahraga bawah air, underwater photography, freediving challenge, marine expo, dan coral planting.</p>
        </div>
      </div>

      {{-- P2 --}}
      <div class="event-card fade-in-up delay-2" style="display:flex;gap:20px;background:var(--glass-bg);border:1px solid var(--glass-border);border-radius:var(--radius-md);padding:1.5rem;backdrop-filter:blur(12px);">
        <div style="flex-shrink:0;width:56px;height:56px;border-radius:var(--radius-sm);background:linear-gradient(135deg,var(--ocean-teal),var(--ocean-bright));display:flex;align-items:center;justify-content:center;font-size:1.5rem;">🏅</div>
        <div>
          <div class="event-type">Program 02</div>
          <h3 class="event-title">Bali Open Water Championship Series</h3>
          <p style="font-size:.82rem;color:rgba(247,251,252,.55);line-height:1.6;margin-top:.25rem;">Seri kejuaraan multi-lokasi di Tulamben, Amed, Nusa Penida, Pemuteran, dan Sanur — mendistribusikan manfaat sport tourism ke seluruh Bali.</p>
        </div>
      </div>

      {{-- P3 --}}
      <div class="event-card fade-in-up delay-3" style="display:flex;gap:20px;background:var(--glass-bg);border:1px solid var(--glass-border);border-radius:var(--radius-md);padding:1.5rem;backdrop-filter:blur(12px);">
        <div style="flex-shrink:0;width:56px;height:56px;border-radius:var(--radius-sm);background:linear-gradient(135deg,var(--ocean-teal),var(--ocean-bright));display:flex;align-items:center;justify-content:center;font-size:1.5rem;">🎓</div>
        <div>
          <div class="event-type">Program 03</div>
          <h3 class="event-title">Bali Training Camp Hub</h3>
          <p style="font-size:.82rem;color:rgba(247,251,252,.55);line-height:1.6;margin-top:.25rem;">Menjadikan Bali pusat pelatihan olahraga bawah air kawasan Asia — menyasar atlet nasional, ASEAN, Australia, Jepang, dan Korea.</p>
        </div>
      </div>

      {{-- P4 --}}
      <div class="event-card fade-in-up delay-4" style="display:flex;gap:20px;background:var(--glass-bg);border:1px solid var(--glass-border);border-radius:var(--radius-md);padding:1.5rem;backdrop-filter:blur(12px);">
        <div style="flex-shrink:0;width:56px;height:56px;border-radius:var(--radius-sm);background:linear-gradient(135deg,var(--ocean-teal),var(--ocean-bright));display:flex;align-items:center;justify-content:center;font-size:1.5rem;">🪸</div>
        <div>
          <div class="event-type">Program 04</div>
          <h3 class="event-title">Ocean Conservation Movement</h3>
          <p style="font-size:.82rem;color:rgba(247,251,252,.55);line-height:1.6;margin-top:.25rem;">Coral restoration, citizen science diver, mangrove collaboration, ocean clean-up, dan eco campaign berbasis komunitas penyelam.</p>
        </div>
      </div>

      {{-- P5 --}}
      <div class="event-card fade-in-up delay-1" style="display:flex;gap:20px;background:var(--glass-bg);border:1px solid var(--glass-border);border-radius:var(--radius-md);padding:1.5rem;backdrop-filter:blur(12px);">
        <div style="flex-shrink:0;width:56px;height:56px;border-radius:var(--radius-sm);background:linear-gradient(135deg,var(--ocean-teal),var(--ocean-bright));display:flex;align-items:center;justify-content:center;font-size:1.5rem;">🎬</div>
        <div>
          <div class="event-type">Program 05</div>
          <h3 class="event-title">Digital Media & International Branding</h3>
          <p style="font-size:.82rem;color:rgba(247,251,252,.55);line-height:1.6;margin-top:.25rem;">Produksi dokumenter bawah air, athlete storytelling, social media campaign, dan media partnership untuk eksposur global.</p>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ═══════════════ DIVISI SATGAS ═══════════════ --}}
<section class="section" style="background:var(--ocean-deep);padding:5rem 2rem;">
  <div class="container">
    <div class="section-header">
      <div class="section-eyebrow">Struktur Organisasi</div>
      <h2 class="section-title">Divisi <em>Satgas</em></h2>
      <p class="section-desc">Tujuh divisi yang bekerja sinergis membangun ekosistem sport tourism olahraga bawah air Bali.</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;">

      @php
      $divisi = [
        ['icon'=>'🏆','name'=>'Event',             'desc'=>'Penyelenggaraan kejuaraan nasional & internasional','delay'=>1],
        ['icon'=>'🗺️','name'=>'Tourism',            'desc'=>'Paket wisata, hotel & dive tourism partnership',    'delay'=>2],
        ['icon'=>'📱','name'=>'Media & Branding',   'desc'=>'Konten digital, dokumenter & eksposur internasional','delay'=>3],
        ['icon'=>'🌿','name'=>'Conservation',        'desc'=>'Coral restoration, citizen science & ocean clean-up','delay'=>4],
        ['icon'=>'💰','name'=>'Funding',             'desc'=>'Sponsorship, CSR, hibah & kemitraan strategis',    'delay'=>1],
        ['icon'=>'🌐','name'=>'International Relations','desc'=>'Jejaring federasi, NGO & mitra Asia Pasifik',   'delay'=>2],
        ['icon'=>'⚖️','name'=>'Legal & Safety',     'desc'=>'SOP keselamatan, legalitas & manajemen risiko',    'delay'=>3],
      ];
      @endphp

      @foreach($divisi as $d)
      <div class="about-card fade-in-up delay-{{ $d['delay'] }}" style="background:var(--glass-bg);border:1px solid var(--glass-border);border-radius:var(--radius-md);padding:1.5rem;backdrop-filter:blur(12px);transition:transform var(--transition),box-shadow var(--transition);">
        <div style="font-size:1.75rem;margin-bottom:.75rem;">{{ $d['icon'] }}</div>
        <h3 style="font-family:var(--font-display);font-size:.9rem;font-weight:600;margin-bottom:.4rem;">{{ $d['name'] }}</h3>
        <p style="font-size:.78rem;color:rgba(247,251,252,.5);line-height:1.6;">{{ $d['desc'] }}</p>
      </div>
      @endforeach

    </div>
  </div>
</section>

{{-- ═══════════════ ROADMAP ═══════════════ --}}
<section class="section" style="background:linear-gradient(170deg,var(--ocean-mid),var(--ocean-deep));padding:5rem 2rem;">
  <div class="container">
    <div class="section-header">
      <div class="section-eyebrow">Roadmap Implementasi</div>
      <h2 class="section-title">Lima Tahun <em>Menuju Hub Asia Pasifik</em></h2>
    </div>

    <div style="display:grid;grid-template-columns:repeat(5,1fr);gap:0;position:relative;">
      {{-- connector line --}}
      <div style="position:absolute;top:28px;left:10%;right:10%;height:1px;background:linear-gradient(90deg,transparent,var(--ocean-teal),var(--ocean-bright),var(--ocean-teal),transparent);pointer-events:none;"></div>

      @php
      $roadmap = [
        ['year'=>'2026','label'=>'Fondasi',         'color'=>'var(--ocean-teal)',  'desc'=>'Konsolidasi organisasi, branding awal & pilot event perdana','delay'=>1],
        ['year'=>'2027','label'=>'Ekspansi',         'color'=>'var(--ocean-bright)','desc'=>'3 event besar, sponsor nasional & championship series',      'delay'=>2],
        ['year'=>'2028','label'=>'Internasionalisasi','color'=>'var(--ocean-foam)', 'desc'=>'Training camp Asia, peserta internasional & media global',     'delay'=>3],
        ['year'=>'2029','label'=>'Marine Sport Week', 'color'=>'var(--ocean-bright)','desc'=>'Event lintas cabang & ekspansi ekonomi sport tourism',       'delay'=>4],
        ['year'=>'2030','label'=>'Hub Asia Pasifik',  'color'=>'var(--ocean-teal)', 'desc'=>'Ekosistem berkelanjutan & positioning global',                 'delay'=>1],
      ];
      @endphp

      @foreach($roadmap as $r)
      <div class="fade-in-up delay-{{ $r['delay'] }}" style="text-align:center;padding:0 .5rem;position:relative;">
        <div style="width:56px;height:56px;border-radius:50%;background:var(--glass-bg);border:2px solid {{ $r['color'] }};display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;backdrop-filter:blur(12px);">
          <span style="font-family:var(--font-display);font-size:.85rem;font-weight:700;color:{{ $r['color'] }};">{{ $r['year'] }}</span>
        </div>
        <div style="font-size:.78rem;font-weight:600;color:{{ $r['color'] }};margin-bottom:.4rem;letter-spacing:.04em;">{{ $r['label'] }}</div>
        <p style="font-size:.75rem;color:rgba(247,251,252,.5);line-height:1.5;">{{ $r['desc'] }}</p>
      </div>
      @endforeach

    </div>
  </div>
</section>

{{-- ═══════════════ KOLABORASI ═══════════════ --}}
<section class="section" style="background:var(--ocean-deep);padding:5rem 2rem;">
  <div class="container">
    <div class="section-header">
      <div class="section-eyebrow">Ekosistem Kolaborasi</div>
      <h2 class="section-title">Bersama <em>Lintas Sektor</em></h2>
      <p class="section-desc">Membangun sinergi dengan pemerintah, industri, akademik, dan mitra internasional.</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px;">

      @php
      $kolaborasi = [
        ['label'=>'Pemerintah', 'icon'=>'🏛️', 'items'=>['Dispar Bali','Dispora','DKP','KONI Bali'],              'delay'=>1],
        ['label'=>'Industri',   'icon'=>'🏨', 'items'=>['Hotel & Resort','Maskapai','Dive Operator','UMKM Pesisir'],'delay'=>2],
        ['label'=>'Akademik',   'icon'=>'🎓', 'items'=>['Universitas','Sekolah Pariwisata','Lembaga Riset Laut','Instruktur Bersertifikat'],'delay'=>3],
        ['label'=>'Internasional','icon'=>'🌐','items'=>['NGO Konservasi','Federasi Selam','Donor Internasional','Media Global'],    'delay'=>4],
      ];
      @endphp

      @foreach($kolaborasi as $k)
      <div class="about-card fade-in-up delay-{{ $k['delay'] }}" style="background:var(--glass-bg);border:1px solid var(--glass-border);border-radius:var(--radius-md);padding:1.5rem;backdrop-filter:blur(12px);transition:transform var(--transition),box-shadow var(--transition);">
        <div style="font-size:1.75rem;margin-bottom:.75rem;">{{ $k['icon'] }}</div>
        <div style="font-family:var(--font-display);font-size:.9rem;font-weight:600;margin-bottom:.75rem;color:var(--ocean-foam);">{{ $k['label'] }}</div>
        @foreach($k['items'] as $item)
        <div style="display:flex;align-items:center;gap:8px;font-size:.8rem;color:rgba(247,251,252,.6);padding:5px 0;border-bottom:1px solid rgba(90,200,230,.06);">
          <span style="width:5px;height:5px;border-radius:50%;background:var(--ocean-teal);flex-shrink:0;"></span>
          {{ $item }}
        </div>
        @endforeach
      </div>
      @endforeach

    </div>
  </div>
</section>

{{-- ═══════════════ CTA ═══════════════ --}}
<section class="section members-section" style="padding:5rem 2rem;">
  <div class="container">
    <div class="members-cta-card fade-in-up">
      <div class="members-icon">🤿</div>
      <h2 class="members-cta-title">Bergabung Bersama Satgas</h2>
      <p class="members-cta-desc">
        Kami membuka kolaborasi dengan individu, komunitas, dan institusi yang memiliki
        komitmen terhadap pengembangan olahraga bawah air dan pelestarian laut Bali.
      </p>
      <div class="members-benefits">
        <div class="benefit-item"><span class="benefit-icon">✦</span> Penyelam aktif</div>
        <div class="benefit-item"><span class="benefit-icon">✦</span> Praktisi pariwisata</div>
        <div class="benefit-item"><span class="benefit-icon">✦</span> Pegiat konservasi</div>
        <div class="benefit-item"><span class="benefit-icon">✦</span> Kreator konten laut</div>
      </div>
      <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
        <a href="{{ url('/contact') }}" class="btn-primary">
          <span>Hubungi Kami</span>
        </a>
        <a href="{{ url('/tentang') }}" class="btn-outline">
          <span>Pelajari Lebih Lanjut</span>
        </a>
      </div>
    </div>
  </div>
</section>

@endsection

@push('styles')
<style>
/* Responsive overrides */
@media (max-width: 1024px) {
  .roadmap-grid  { grid-template-columns: repeat(3, 1fr) !important; }
}
@media (max-width: 768px) {
  .pilar-grid,
  .divisi-grid,
  .kolaborasi-grid { grid-template-columns: 1fr 1fr !important; }
  .roadmap-grid    { grid-template-columns: 1fr 1fr !important; }
}
@media (max-width: 480px) {
  .pilar-grid,
  .divisi-grid,
  .kolaborasi-grid,
  .roadmap-grid    { grid-template-columns: 1fr !important; }
}
</style>
@endpush