@extends('layouts.app')

@section('title', 'Satgas POSSI Bali')

@section('content')

<!-- ═══════════════ PAGE HEADER ═══════════════ -->
<section class="page-header satgas-header">
  <div class="satgas-header-bg"></div>
  <div class="page-header-orb page-header-orb-1"></div>
  <div class="page-header-orb page-header-orb-2"></div>
  <div class="container" style="position:relative;z-index:2;">
    <div class="page-header-eyebrow fade-in-up">Tim Khusus</div>
    <h1 class="page-header-title fade-in-up delay-1">Satgas <em>POSSI Bali</em></h1>
    <p class="page-header-desc fade-in-up delay-2">
      Satuan tugas khusus POSSI Bali yang berperan dalam pengawasan, pencarian &
      pertolongan, pelestarian laut, dan pembinaan selam berprestasi di seluruh Bali.
    </p>
  </div>
</section>

<!-- ═══════════════ SATGAS OVERVIEW ═══════════════ -->
<section class="section satgas-overview-section">
  <div class="container">
    <div class="satgas-overview-grid">

      <div class="satgas-overview-card fade-in-up delay-1">
        <div class="satgas-overview-icon">🆘</div>
        <h3 class="satgas-overview-title">SAR & Penyelamatan</h3>
        <p class="satgas-overview-desc">Tim pencarian dan pertolongan bawah laut. Siap 24 jam untuk operasi darurat penyelamatan di perairan Bali.</p>
        <div class="satgas-overview-stat">
          <span class="satgas-ov-num" data-counter data-target="{{ $stats['sar'] }}">0</span>
          <span class="satgas-ov-label">Personel Aktif</span>
        </div>
      </div>

      <div class="satgas-overview-card fade-in-up delay-2">
        <div class="satgas-overview-icon">🌿</div>
        <h3 class="satgas-overview-title">Konservasi Laut</h3>
        <p class="satgas-overview-desc">Satgas pelestarian ekosistem laut, transplantasi terumbu karang, dan pengendalian sampah di kawasan perairan Bali.</p>
        <div class="satgas-overview-stat">
          <span class="satgas-ov-num" data-counter data-target="{{ $stats['konservasi'] }}">0</span>
          <span class="satgas-ov-label">Personel Aktif</span>
        </div>
      </div>

      <div class="satgas-overview-card fade-in-up delay-3">
        <div class="satgas-overview-icon">🎓</div>
        <h3 class="satgas-overview-title">Pembinaan Prestasi</h3>
        <p class="satgas-overview-desc">Tim pelatih dan juri bersertifikat nasional untuk pembinaan atlet selam kompetitif menuju PON dan kejuaraan internasional.</p>
        <div class="satgas-overview-stat">
          <span class="satgas-ov-num" data-counter data-target="{{ $stats['prestasi'] }}">0</span>
          <span class="satgas-ov-label">Pelatih & Juri</span>
        </div>
      </div>

      <div class="satgas-overview-card fade-in-up delay-4">
        <div class="satgas-overview-icon">🔍</div>
        <h3 class="satgas-overview-title">Pengawasan & Regulasi</h3>
        <p class="satgas-overview-desc">Satgas pengawas standar keselamatan, sertifikasi, dan kepatuhan regulasi olahraga selam di seluruh wilayah Bali.</p>
        <div class="satgas-overview-stat">
          <span class="satgas-ov-num" data-counter data-target="{{ $stats['regulasi'] }}">0</span>
          <span class="satgas-ov-label">Pengawas Aktif</span>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ═══════════════ SATGAS FILTER ═══════════════ -->
<section class="satgas-filter-section">
  <div class="container">
    <div class="satgas-filter-bar fade-in-up">
      <div class="filter-tabs" role="tablist">
        <button class="filter-tab active" data-filter="semua" role="tab">Semua Satgas</button>
        <button class="filter-tab" data-filter="sar" role="tab">🆘 SAR</button>
        <button class="filter-tab" data-filter="konservasi" role="tab">🌿 Konservasi</button>
        <button class="filter-tab" data-filter="prestasi" role="tab">🎓 Prestasi</button>
        <button class="filter-tab" data-filter="regulasi" role="tab">🔍 Regulasi</button>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════ PERSONEL GRID ═══════════════ -->
<section class="section" style="padding-top:2rem; background:var(--ocean-deep);">
  <div class="container">

    <div class="satgas-section-label fade-in-up">
      <div class="satgas-section-line"></div>
      <span>Struktur & Personel Satgas</span>
      <div class="satgas-section-line"></div>
    </div>

    @php
      $unitColors = [
        'sar'        => ['bg'=>'rgba(224,92,58,.15)','border'=>'rgba(224,92,58,.3)','color'=>'#f5856e','label'=>'SAR'],
        'konservasi' => ['bg'=>'rgba(46,160,97,.15)','border'=>'rgba(46,160,97,.3)','color'=>'#6ee09a','label'=>'Konservasi'],
        'prestasi'   => ['bg'=>'rgba(212,168,83,.15)','border'=>'rgba(212,168,83,.3)','color'=>'var(--ocean-gold)','label'=>'Prestasi'],
        'regulasi'   => ['bg'=>'rgba(26,179,216,.15)','border'=>'rgba(26,179,216,.3)','color'=>'var(--ocean-bright)','label'=>'Regulasi'],
      ];
    @endphp

    @if($satgas->count() > 0)
    <div class="satgas-grid" id="satgasGrid">
      @foreach($satgas as $i => $person)
      @php $uc = $unitColors[$person->unit] ?? $unitColors['regulasi']; @endphp
      <div class="satgas-card fade-in-up delay-{{ ($i % 3) + 1 }}" data-unit="{{ $person->unit }}">

        <div class="satgas-card-unit-bar" style="background:{{ $uc['bg'] }}; border-bottom:1px solid {{ $uc['border'] }};">
          <span style="color:{{ $uc['color'] }}; font-size:.68rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase;">
            Satgas {{ $uc['label'] }}
          </span>
          @if($person->badge)
          <span class="satgas-badge" style="background:{{ $uc['bg'] }}; border-color:{{ $uc['border'] }}; color:{{ $uc['color'] }};">
            {{ $person->badge }}
          </span>
          @endif
        </div>

        <div class="satgas-card-body">
          <div class="satgas-avatar" style="background:linear-gradient(135deg, {{ $uc['color'] }}33, {{ $uc['color'] }}11); border-color:{{ $uc['border'] }};">
            {{ $person->avatar_initials }}
          </div>

          <h3 class="satgas-name">{{ $person->name }}</h3>
          <div class="satgas-role">{{ $person->role }}</div>

          <div class="satgas-meta">
            <div class="satgas-meta-item">
              <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><circle cx="6" cy="6" r="5" stroke="currentColor" stroke-width="1.2"/><path d="M6 3v3l2 1" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
              Bergabung {{ $person->joined_year }}
            </div>
          </div>

          @if($person->certifications && count($person->certifications) > 0)
          <div class="satgas-certs">
            @foreach($person->certifications as $cert)
            <span class="satgas-cert-badge">{{ $cert }}</span>
            @endforeach
          </div>
          @endif
        </div>

        <div class="satgas-card-footer">
          <a href="{{ route('satgas.show', $person) }}" class="satgas-detail-link">
            Lihat Profil
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 6h8M7 3l3 3-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
        </div>

      </div>
      @endforeach
    </div>

    <div class="empty-state" id="satgasEmpty" style="display:none;">
      <div class="empty-state-icon">🔍</div>
      <div class="empty-state-title">Personel tidak ditemukan</div>
      <div class="empty-state-desc">Coba pilih kategori satgas yang lain.</div>
    </div>

    @else
    <div class="empty-state">
      <div class="empty-state-icon">⭐</div>
      <div class="empty-state-title">Belum ada personel</div>
      <div class="empty-state-desc">Data personel satgas akan segera diperbarui.</div>
    </div>
    @endif

  </div>
</section>

<!-- ═══════════════ CTA BERGABUNG ═══════════════ -->
<section class="section" style="background:linear-gradient(170deg,var(--ocean-mid),var(--ocean-deep));padding:5rem 2rem;">
  <div class="container">
    <div class="satgas-cta-wrap fade-in-up">
      <div class="satgas-cta-text">
        <div class="section-eyebrow">Rekrutmen Terbuka</div>
        <h2 class="section-title">Bergabung <em>Satgas POSSI Bali</em></h2>
        <p class="section-desc" style="margin:0;">
          Kami membuka pendaftaran personel satgas baru. Diperlukan pengalaman selam minimal
          2 tahun dan komitmen tinggi untuk pelestarian laut dan keselamatan penyelam Bali.
        </p>
      </div>
      <div class="satgas-cta-requirements">
        <div class="satgas-req-title">Persyaratan Umum</div>
        <ul class="satgas-req-list">
          <li>✓ WNI, domisili Bali</li>
          <li>✓ Sertifikat selam minimal CMAS ★ atau setara</li>
          <li>✓ Pengalaman menyelam min. 50 dive</li>
          <li>✓ Sehat jasmani & rohani</li>
          <li>✓ Tidak sedang terikat organisasi sejenis</li>
        </ul>
        <a href="{{ url('/contact') }}" class="btn-primary" style="margin-top:1.5rem; display:inline-flex;">
          <span>Daftar Sekarang</span>
        </a>
      </div>
    </div>
  </div>
</section>

@endsection

@push('styles')
<style>
.satgas-header { position:relative; }
.satgas-header-bg {
  position:absolute; inset:0;
  background:radial-gradient(ellipse 60% 80% at 70% 30%,rgba(224,92,58,.12) 0%,transparent 60%),
             radial-gradient(ellipse 50% 60% at 20% 70%,rgba(26,179,216,.1) 0%,transparent 60%);
  pointer-events:none;
}
.page-header { overflow:hidden; }
.page-header-orb { position:absolute; border-radius:50%; filter:blur(70px); pointer-events:none; }
.page-header-orb-1 { width:380px;height:380px;background:radial-gradient(circle,rgba(224,92,58,.12),transparent 70%);top:-80px;right:-40px; }
.page-header-orb-2 { width:260px;height:260px;background:radial-gradient(circle,rgba(26,179,216,.1),transparent 70%);bottom:-40px;left:10%; }

.satgas-overview-section { background:var(--ocean-deep); }
.satgas-overview-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:20px; }
.satgas-overview-card {
  background:var(--glass-bg); border:1px solid var(--glass-border);
  border-radius:var(--radius-md); padding:1.75rem; backdrop-filter:blur(12px); text-align:center;
  transition:transform var(--transition),box-shadow var(--transition);
}
.satgas-overview-card:hover { transform:translateY(-4px); box-shadow:var(--shadow-glow); }
.satgas-overview-icon { font-size:2.5rem; margin-bottom:1rem; }
.satgas-overview-title { font-family:var(--font-display); font-size:.95rem; font-weight:600; margin-bottom:.6rem; }
.satgas-overview-desc { font-size:.8rem; color:rgba(247,251,252,.55); line-height:1.65; margin-bottom:1rem; }
.satgas-overview-stat { padding-top:1rem; border-top:1px solid var(--glass-border); }
.satgas-ov-num { font-family:var(--font-display); font-size:1.8rem; font-weight:700; color:var(--ocean-foam); display:block; }
.satgas-ov-label { font-size:.72rem; color:rgba(247,251,252,.45); letter-spacing:.05em; }

.satgas-filter-section {
  background:rgba(13,38,69,.6); border-bottom:1px solid var(--glass-border);
  backdrop-filter:blur(12px); position:sticky; top:72px; z-index:100; padding:0 2rem;
}
.satgas-filter-bar {
  max-width:1200px; margin:0 auto; display:flex; align-items:center;
  gap:1rem; padding:14px 0; flex-wrap:wrap;
}
.filter-tabs { display:flex; gap:4px; flex-wrap:wrap; }
.filter-tab {
  padding:7px 18px; border-radius:99px; border:1.5px solid transparent;
  background:transparent; color:rgba(247,251,252,.55); font-family:var(--font-body);
  font-size:.82rem; font-weight:500; cursor:pointer; transition:all var(--transition);
}
.filter-tab:hover { color:var(--ocean-white); border-color:var(--glass-border); }
.filter-tab.active { background:linear-gradient(135deg,var(--ocean-teal),var(--ocean-bright)); color:#fff; }

.satgas-section-label {
  display:flex; align-items:center; gap:1rem; margin-bottom:2rem;
  font-size:.75rem; font-weight:700; letter-spacing:.15em;
  text-transform:uppercase; color:var(--ocean-bright);
}
.satgas-section-line { flex:1; height:1px; background:var(--glass-border); }

.satgas-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:20px; }
.satgas-card {
  background:var(--glass-bg); border:1px solid var(--glass-border);
  border-radius:var(--radius-md); overflow:hidden; display:flex; flex-direction:column;
  transition:transform var(--transition),box-shadow var(--transition);
  backdrop-filter:blur(12px);
}
.satgas-card:hover { transform:translateY(-5px); box-shadow:var(--shadow-card),var(--shadow-glow); }
.satgas-card-unit-bar { display:flex; align-items:center; justify-content:space-between; padding:8px 14px; }
.satgas-badge { padding:2px 8px; border-radius:4px; border:1px solid; font-size:.62rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase; }
.satgas-card-body { padding:1.5rem; flex:1; display:flex; flex-direction:column; align-items:center; text-align:center; gap:.6rem; }
.satgas-avatar {
  width:64px; height:64px; border-radius:50%; border:2px solid;
  display:flex; align-items:center; justify-content:center;
  font-family:var(--font-display); font-size:1.2rem; font-weight:700;
  color:var(--ocean-white); margin-bottom:.25rem;
}
.satgas-name { font-family:var(--font-display); font-size:.92rem; font-weight:600; color:var(--ocean-white); line-height:1.3; }
.satgas-role { font-size:.75rem; color:rgba(247,251,252,.55); }
.satgas-meta { display:flex; gap:1rem; margin-top:.25rem; }
.satgas-meta-item { display:flex; align-items:center; gap:4px; font-size:.72rem; color:var(--text-muted); }
.satgas-certs { display:flex; flex-wrap:wrap; gap:4px; justify-content:center; margin-top:.5rem; }
.satgas-cert-badge { padding:2px 8px; border-radius:4px; background:rgba(255,255,255,.06); border:1px solid var(--glass-border); font-size:.65rem; color:rgba(247,251,252,.55); }
.satgas-card-footer { padding:.75rem 1.5rem; border-top:1px solid var(--glass-border); display:flex; justify-content:center; }
.satgas-detail-link { display:inline-flex; align-items:center; gap:6px; font-size:.8rem; font-weight:600; color:var(--ocean-bright); transition:gap var(--transition),color var(--transition); }
.satgas-detail-link:hover { gap:10px; color:var(--ocean-foam); }

.satgas-cta-wrap { display:grid; grid-template-columns:1fr 1fr; gap:4rem; align-items:center; }
.satgas-req-title { font-family:var(--font-display); font-size:1rem; font-weight:600; margin-bottom:1rem; }
.satgas-req-list { list-style:none; display:flex; flex-direction:column; gap:.5rem; }
.satgas-req-list li { font-size:.88rem; color:rgba(247,251,252,.7); display:flex; align-items:center; gap:.5rem; }

@media(max-width:1024px) { .satgas-overview-grid { grid-template-columns:repeat(2,1fr); } .satgas-grid { grid-template-columns:repeat(2,1fr); } .satgas-cta-wrap { grid-template-columns:1fr; gap:2rem; } }
@media(max-width:640px) { .satgas-overview-grid { grid-template-columns:1fr 1fr; } .satgas-grid { grid-template-columns:1fr; } }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const tabs  = document.querySelectorAll('.filter-tab');
  const cards = document.querySelectorAll('#satgasGrid .satgas-card');
  const empty = document.getElementById('satgasEmpty');

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
      const f = tab.dataset.filter;
      let visible = 0;
      cards.forEach(card => {
        const match = f === 'semua' || card.dataset.unit === f;
        card.style.display = match ? '' : 'none';
        if (match) visible++;
      });
      if (empty) empty.style.display = visible === 0 ? 'block' : 'none';
    });
  });
});
</script>
@endpush