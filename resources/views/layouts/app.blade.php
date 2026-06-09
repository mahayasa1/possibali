<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'POSSI Bali') — Organisasi Selam Bali</title>
  <meta name="description" content="@yield('meta_description', 'POSSI Bali — Organisasi resmi olahraga selam di Bali untuk pengembangan atlet, edukasi, dan pelestarian laut Indonesia.')">

  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/possi.css') }}">
  <link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

  <!-- Stack for page-specific CSS -->
  @stack('styles')
</head>
<body>

<!-- ═══════════════════════════════════════
     PAGE LOADER
     ═══════════════════════════════════════ -->
<div id="page-loader">
  <div class="loader-logo"> <img src="{{ asset('img/possi_logo.png') }}" alt="POSSI Bali Logo"> POSSI BALI</div>
  <div class="loader-bar">
    <div class="loader-bar-fill"></div>
  </div>
</div>



<!-- ═══════════════════════════════════════
     NAVBAR
     ═══════════════════════════════════════ -->
<header class="navbar" id="navbar">
  <div class="navbar-brand">
    <a href="{{ url('/') }}" class="navbar-brand-link">
      <div class="navbar-logo" >
        <img src="{{ asset('img/possi_logo.png') }}" alt="POSSI Bali Logo">
      </div>
      <div class="navbar-title">
        POSSI BALI
        <span>PERSATUAN OLAHRAGA SELAM SELURUH INDONESIA</span>
      </div>
    </a>
  </div>

  <nav class="navbar-nav" id="navbarMenu" role="navigation" aria-label="Menu utama">
    <a href="{{ url('/') }}"
       class="nav-link {{ request()->is('/') ? 'active' : '' }}">
      Home
    </a>
    <a href="{{ url('/#about') }}"
       class="nav-link">
      About
    </a>
    <a href="{{ url('/news') }}"
       class="nav-link {{ request()->is('news*') ? 'active' : '' }}">
      News
    </a>
    <a href="{{ url('/events') }}"
       class="nav-link {{ request()->is('events*') ? 'active' : '' }}">
      Events
    </a>
    <a href="{{ url('/satgas') }}"
       class="nav-link {{ request()->is('Satgas*') ? 'active' : '' }}">
      SATGAS POSSI
    </a>
    <a href="{{ url('/clubs') }}"
       class="nav-link {{ request()->is('clubs*') ? 'active' : '' }}">
      Clubs
    </a>
    <a href="{{ url('/pengaduan') }}"
       class="nav-link {{ request()->is('pengaduan*') ? 'active' : '' }}">
      Pengaduan
    </a>
  </nav>

  <div class="navbar-actions">
    @auth
      <!-- Logged-in user menu -->
      <div class="navbar-user-menu">
        <button class="btn-nav-user" id="userMenuToggle" aria-expanded="false">
          <span class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
          <span class="user-name-short">{{ Str::limit(Auth::user()->name, 12) }}</span>
          <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
            <path d="M2 4L6 8L10 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
          </svg>
        </button>

        <div class="user-dropdown" id="userDropdown" aria-hidden="true">
          <div class="user-dropdown-header">
            <div class="user-dropdown-name">{{ Auth::user()->name }}</div>
            <div class="user-dropdown-email">{{ Auth::user()->email }}</div>
          </div>
          <div class="user-dropdown-divider"></div>
          @if(Auth::user()->is_admin ?? false)
            <a href="{{ url('/admin/dashboard') }}" class="user-dropdown-item">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><rect x="1" y="1" width="6" height="6" rx="1" stroke="currentColor" stroke-width="1.5"/><rect x="9" y="1" width="6" height="6" rx="1" stroke="currentColor" stroke-width="1.5"/><rect x="1" y="9" width="6" height="6" rx="1" stroke="currentColor" stroke-width="1.5"/><rect x="9" y="9" width="6" height="6" rx="1" stroke="currentColor" stroke-width="1.5"/></svg>
              Dashboard Admin
            </a>
          @endif
          <a href="{{ url('/profile') }}" class="user-dropdown-item">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><circle cx="8" cy="5" r="3" stroke="currentColor" stroke-width="1.5"/><path d="M2 14c0-3.314 2.686-6 6-6s6 2.686 6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
            Profil Saya
          </a>
          <div class="user-dropdown-divider"></div>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="user-dropdown-item user-dropdown-logout">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M6 2H3a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h3M10 11l3-3-3-3M13 8H6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
              Keluar
            </button>
          </form>
        </div>
      </div>
    @else
      <a href="{{ route('login') }}" class="btn-nav-login">Masuk</a>
      @if(Route::has('register'))
        <a href="{{ route('register') }}" class="btn-primary btn-nav-register">
          <span>Daftar</span>
        </a>
      @endif
    @endauth
  </div>

  <!-- Hamburger Toggle -->
  <button class="navbar-toggler" id="navbarToggler" aria-label="Toggle menu" aria-expanded="false" aria-controls="navbarMenu">
    <span></span>
    <span></span>
    <span></span>
  </button>
</header>

<!-- ═══════════════════════════════════════
     FLASH MESSAGES / ALERTS
     ═══════════════════════════════════════ -->
@if(session()->hasAny(['success', 'error', 'info', 'warning']))
  <div class="flash-container" id="flashContainer">
    @if(session('success'))
      <div class="alert alert-success flash-alert" role="alert">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><circle cx="9" cy="9" r="8" stroke="currentColor" stroke-width="1.5"/><path d="M5.5 9l2.5 2.5 4.5-4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        {{ session('success') }}
        <button class="flash-close" aria-label="Tutup">×</button>
      </div>
    @endif
    @if(session('error'))
      <div class="alert alert-error flash-alert" role="alert">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><circle cx="9" cy="9" r="8" stroke="currentColor" stroke-width="1.5"/><path d="M9 5v4M9 12v.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
        {{ session('error') }}
        <button class="flash-close" aria-label="Tutup">×</button>
      </div>
    @endif
    @if(session('info'))
      <div class="alert alert-info flash-alert" role="alert">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><circle cx="9" cy="9" r="8" stroke="currentColor" stroke-width="1.5"/><path d="M9 8v5M9 5.5v.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
        {{ session('info') }}
        <button class="flash-close" aria-label="Tutup">×</button>
      </div>
    @endif
    @if(session('warning'))
      <div class="alert alert-warning flash-alert" role="alert">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M9 2L16.5 15H1.5L9 2z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M9 7v3M9 12v.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
        {{ session('warning') }}
        <button class="flash-close" aria-label="Tutup">×</button>
      </div>
    @endif
  </div>
@endif

<!-- ═══════════════════════════════════════
     MAIN CONTENT
     ═══════════════════════════════════════ -->
<main id="main-content" role="main">
  <x-aksesibilitas />
  @yield('content')
</main>

<!-- ═══════════════════════════════════════
     FOOTER
     ═══════════════════════════════════════ -->
<footer class="footer" role="contentinfo">
  <div class="container">
    <div class="footer-grid">

      <!-- Brand Column -->
      <div class="footer-brand">
        <div class="footer-brand-title">POSSI Bali</div>
        <div class="footer-brand-sub">Persatuan Olahraga Selam Seluruh Indonesia</div>
        <p class="footer-brand-desc">
          Organisasi resmi olahraga selam di Bali untuk pengembangan atlet berprestasi,
          edukasi selam, dan pelestarian ekosistem laut Indonesia.
        </p>
        <div class="footer-social">
          <a href="#" class="social-btn" aria-label="Facebook" title="Facebook">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
          </a>
          <a href="#" class="social-btn" aria-label="Instagram" title="Instagram">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
          </a>
          <a href="#" class="social-btn" aria-label="YouTube" title="YouTube">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="white"/></svg>
          </a>
          <a href="#" class="social-btn" aria-label="WhatsApp" title="WhatsApp">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
          </a>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="footer-col">
        <div class="footer-col-title">Navigasi</div>
        <div class="footer-links">
          <a href="{{ url('/') }}" class="footer-link">Home</a>
          <a href="{{ url('/#about') }}" class="footer-link">Tentang Kami</a>
          <a href="{{ url('/news') }}" class="footer-link">Berita</a>
          <a href="{{ url('/events') }}" class="footer-link">Event & Kegiatan</a>
          <a href="{{ url('/satgas') }}" class="footer-link">SATGAS POSSI</a>
          <a href="{{ url('/contact') }}" class="footer-link">Kontak</a>
        </div>
      </div>

      <!-- Program Column -->
      <div class="footer-col">
        <div class="footer-col-title">Program</div>
        <div class="footer-links">
          <a href="#" class="footer-link">Pelatihan Selam</a>
          <a href="#" class="footer-link">Sertifikasi Selam</a>
          <a href="#" class="footer-link">Pembinaan Atlet</a>
          <a href="#" class="footer-link">Kompetisi Nasional</a>
          <a href="#" class="footer-link">Edukasi Laut</a>
          <a href="{{ url('/members') }}" class="footer-link">Keanggotaan</a>
        </div>
      </div>

      <!-- Contact Info -->
      <div class="footer-col">
        <div class="footer-col-title">Kontak</div>
        <div class="footer-links">
          <div class="footer-contact-item">
            <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M8 1C5.24 1 3 3.24 3 6c0 4.25 5 9 5 9s5-4.75 5-9c0-2.76-2.24-5-5-5zm0 6.5A1.5 1.5 0 1 1 8 4a1.5 1.5 0 0 1 0 3.5z" fill="currentColor"/></svg>
            <span>Denpasar, Bali — Indonesia</span>
          </div>
          <div class="footer-contact-item">
            <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M14 10.67c-.42-.07-.85-.13-1.28-.16a1 1 0 0 0-.9.5l-.68 1.17a10.2 10.2 0 0 1-4.28-4.28l1.17-.68a1 1 0 0 0 .5-.9 11.3 11.3 0 0 0-.16-1.28A1 1 0 0 0 7.4 4H5a1 1 0 0 0-1 1.1 11 11 0 0 0 9.9 9.9A1 1 0 0 0 15 14v-2.4a1 1 0 0 0-.88-.93z" fill="currentColor"/></svg>
            <span>+62 361 000 0000</span>
          </div>
          <div class="footer-contact-item">
            <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M2 4h12v8H2z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/><path d="M2 4l6 5 6-5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
            <span>info@possibali.org</span>
          </div>
          <div class="footer-contact-item">
            <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="1.2"/><path d="M8 4v4l3 2" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
            <span>Sen – Jum, 08.00 – 17.00 WITA</span>
          </div>
        </div>
      </div>

    </div><!-- /.footer-grid -->

    <div class="footer-bottom">
        <div class="footer-copy">
          <div class="footer-main">
            © {{ date('Y') }} POSSI Bali — Hak cipta dilindungi.
          </div>
      
          <div class="footer-powered">
            <img src="{{ asset('img/logo.png') }}" alt="SKYNUSA TECH Logo">
            Developed by SKYNUSA TECH
          </div>
        </div>
    </div>
  </div>
</footer>

<!-- ═══════════════════════════════════════
     SCROLL TO TOP BUTTON
     ═══════════════════════════════════════ -->
<button class="scroll-top-btn" id="scrollTopBtn" aria-label="Kembali ke atas" title="Kembali ke atas">
  <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
    <path d="M9 14V4M4 9l5-5 5 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>
</button>

<!-- ═══════════════════════════════════════
     SCRIPTS
     ═══════════════════════════════════════ -->
<script src="{{ asset('js/possi.js') }}"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {

  const loader = document.getElementById('page-loader');


  function triggerPageTransition(url) {
    if (!loader) { window.location.href = url; return; }

    loader.classList.remove('hidden');
    loader.classList.add('transitioning');

    const barFill = loader.querySelector('.loader-bar-fill');
    if (barFill) {
      barFill.style.animation = 'none';
      void barFill.offsetWidth;
      barFill.style.animation = '';
    }

    setTimeout(() => {
      window.location.href = url;
    }, 1300);
  }

  /* Intercept klik pada .navbar-brand dan .navbar-brand-link */
  document.querySelectorAll('.navbar-brand, .navbar-brand-link').forEach(el => {
    el.addEventListener('click', (e) => {
      const href = el.tagName === 'A'
        ? el.getAttribute('href')
        : el.querySelector('a')?.getAttribute('href');

      if (!href || href === '#') return; 
      const isSamePage =
        window.location.pathname === new URL(href, window.location.origin).pathname;

      if (isSamePage) {
        e.preventDefault();
        if (loader) {
          loader.classList.remove('hidden');
          loader.classList.add('transitioning');
          const barFill = loader.querySelector('.loader-bar-fill');
          if (barFill) {
            barFill.style.animation = 'none';
            void barFill.offsetWidth;
            barFill.style.animation = '';
          }
          setTimeout(() => {
            loader.classList.add('hidden');
            loader.classList.remove('transitioning');
            window.scrollTo({ top: 0, behavior: 'smooth' });
          }, 1300);
        } else {
          window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        return;
      }

      e.preventDefault();
      triggerPageTransition(href);
    });
  });

  window.addEventListener('load', () => {
    if (loader) {
      setTimeout(() => {
        loader.classList.add('hidden');
        loader.classList.remove('transitioning');
      }, 1400); // sedikit lebih lama dari animasi bar (1.2s)
    }
  });

  /* ── USER DROPDOWN ── */
  const userToggle   = document.getElementById('userMenuToggle');
  const userDropdown = document.getElementById('userDropdown');
  if (userToggle && userDropdown) {
    userToggle.addEventListener('click', (e) => {
      e.stopPropagation();
      const isOpen = userDropdown.classList.toggle('open');
      userToggle.setAttribute('aria-expanded', isOpen);
      userDropdown.setAttribute('aria-hidden', !isOpen);
    });
    document.addEventListener('click', () => {
      userDropdown.classList.remove('open');
      userToggle.setAttribute('aria-expanded', 'false');
      userDropdown.setAttribute('aria-hidden', 'true');
    });
    userDropdown.addEventListener('click', (e) => e.stopPropagation());
  }

  /* ── FLASH DISMISS ── */
  document.querySelectorAll('.flash-close').forEach(btn => {
    btn.addEventListener('click', () => {
      const alert = btn.closest('.flash-alert');
      if (alert) {
        alert.style.opacity = '0';
        alert.style.transform = 'translateX(100%)';
        setTimeout(() => alert.remove(), 350);
      }
    });
  });

  // Auto-dismiss flash after 5s
  setTimeout(() => {
    document.querySelectorAll('.flash-alert').forEach(alert => {
      alert.style.opacity = '0';
      alert.style.transform = 'translateX(100%)';
      setTimeout(() => alert.remove(), 350);
    });
  }, 5000);

  /* ── SCROLL TO TOP ── */
  const scrollBtn = document.getElementById('scrollTopBtn');
  if (scrollBtn) {
    window.addEventListener('scroll', () => {
      scrollBtn.classList.toggle('visible', window.scrollY > 400);
    }, { passive: true });
    scrollBtn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

});
</script>

<!-- Stack for page-specific JS -->
@stack('scripts')

</body>
</html>