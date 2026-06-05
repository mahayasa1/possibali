/**
 * POSSI BALI — possi.js
 * Animasi & interaksi JS vanilla
 */

document.addEventListener('DOMContentLoaded', () => {

  /* ── PAGE LOADER ── */
  const loader = document.getElementById('page-loader');
  if (loader) {
    setTimeout(() => {
      loader.classList.add('hidden');
    }, 1400);
  }

  /* ── NAVBAR SCROLL ── */
  const navbar = document.querySelector('.navbar');
  if (navbar) {
    const onScroll = () => {
      navbar.classList.toggle('scrolled', window.scrollY > 30);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* ── NAVBAR MOBILE TOGGLE ── */
  const toggler = document.querySelector('.navbar-toggler');
  const navMenu = document.querySelector('.navbar-nav');
  if (toggler && navMenu) {
    toggler.addEventListener('click', () => {
      navMenu.classList.toggle('open');
      const spans = toggler.querySelectorAll('span');
      const isOpen = navMenu.classList.contains('open');
      spans[0].style.transform = isOpen ? 'rotate(45deg) translate(5px, 5px)' : '';
      spans[1].style.opacity  = isOpen ? '0' : '';
      spans[2].style.transform = isOpen ? 'rotate(-45deg) translate(5px, -5px)' : '';
    });
  }

  /* ── ACTIVE NAV LINK ── */
  const currentPath = window.location.pathname;
  document.querySelectorAll('.nav-link').forEach(link => {
    if (link.getAttribute('href') === currentPath) {
      link.classList.add('active');
    }
  });

  /* ── SCROLL REVEAL (IntersectionObserver) ── */
  const revealEls = document.querySelectorAll('.fade-in-up, .fade-in-left');
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    revealEls.forEach(el => observer.observe(el));
  } else {
    // Fallback: show all elements
    revealEls.forEach(el => el.classList.add('visible'));
  }

  /* ── ANIMATED COUNTER ── */
  function animateCounter(el) {
    const target = parseInt(el.getAttribute('data-target'), 10);
    const duration = 1800;
    const startTime = performance.now();
    const startValue = 0;

    function update(currentTime) {
      const elapsed = currentTime - startTime;
      const progress = Math.min(elapsed / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3); // ease-out cubic
      const current = Math.floor(startValue + (target - startValue) * eased);
      el.textContent = current.toLocaleString('id-ID');
      if (progress < 1) requestAnimationFrame(update);
    }

    requestAnimationFrame(update);
  }

  // Observe counters
  const counterEls = document.querySelectorAll('[data-counter]');
  if ('IntersectionObserver' in window && counterEls.length) {
    const counterObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          counterObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });
    counterEls.forEach(el => counterObserver.observe(el));
  }

  /* ── SMOOTH SCROLL FOR ANCHOR LINKS ── */
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', (e) => {
      const target = document.querySelector(anchor.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        // Close mobile menu if open
        if (navMenu) navMenu.classList.remove('open');
      }
    });
  });

  /* ── HERO PARALLAX EFFECT ── */
  const heroOrbs = document.querySelectorAll('.hero-orb');
  if (heroOrbs.length) {
    window.addEventListener('mousemove', (e) => {
      const cx = window.innerWidth / 2;
      const cy = window.innerHeight / 2;
      const dx = (e.clientX - cx) / cx;
      const dy = (e.clientY - cy) / cy;

      heroOrbs.forEach((orb, i) => {
        const factor = (i + 1) * 12;
        orb.style.transform = `translate(${dx * factor}px, ${dy * factor}px)`;
      });
    }, { passive: true });
  }

  /* ── GALLERY LIGHTBOX (simple) ── */
  const galleryItems = document.querySelectorAll('.gallery-item');
  galleryItems.forEach(item => {
    item.addEventListener('click', () => {
      const img   = item.querySelector('img');
      const label = item.querySelector('.gallery-overlay-text');
      if (!img && !label) return;

      const overlay = document.createElement('div');
      overlay.style.cssText = `
        position:fixed;inset:0;z-index:9000;
        background:rgba(6,15,28,0.92);
        display:flex;align-items:center;justify-content:center;
        cursor:pointer;backdrop-filter:blur(8px);
        animation:fadeIn 0.25s ease;
      `;

      if (img) {
        const bigImg = document.createElement('img');
        bigImg.src = img.src;
        bigImg.style.cssText = 'max-width:90vw;max-height:85vh;border-radius:12px;box-shadow:0 20px 80px rgba(0,0,0,0.7)';
        overlay.appendChild(bigImg);
      }

      overlay.addEventListener('click', () => overlay.remove());
      document.body.appendChild(overlay);
    });
  });

  /* ── CONTACT FORM ── */
  const contactForm = document.getElementById('contact-form');
  if (contactForm) {
    contactForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const btn = contactForm.querySelector('[type="submit"]');
      const originalText = btn.innerHTML;

      btn.disabled = true;
      btn.innerHTML = '<span>Mengirim…</span>';

      // Simulate async send (replace with actual fetch)
      await new Promise(resolve => setTimeout(resolve, 1500));

      btn.innerHTML = '<span>✓ Pesan Terkirim!</span>';
      btn.style.background = 'linear-gradient(135deg, #2a9d5c, #34c46e)';

      setTimeout(() => {
        btn.disabled = false;
        btn.innerHTML = originalText;
        btn.style.background = '';
        contactForm.reset();
      }, 3000);
    });
  }

  /* ── NAVBAR ACTIVE SECTION HIGHLIGHT (scrollspy) ── */
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('.nav-link[href^="#"]');

  if (sections.length && navLinks.length) {
    const spy = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          navLinks.forEach(link => link.classList.remove('active'));
          const activeLink = document.querySelector(`.nav-link[href="#${entry.target.id}"]`);
          if (activeLink) activeLink.classList.add('active');
        }
      });
    }, { rootMargin: '-40% 0px -55% 0px' });

    sections.forEach(section => spy.observe(section));
  }

  /* ── TOAST NOTIFICATION HELPER ── */
  window.showToast = function(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `alert alert-${type}`;
    toast.style.cssText = `
      position:fixed;bottom:24px;right:24px;z-index:9999;
      min-width:260px;max-width:380px;
      animation:slideInUp 0.35s ease;
      box-shadow:0 8px 32px rgba(0,0,0,0.4);
    `;
    toast.textContent = message;
    document.body.appendChild(toast);

    setTimeout(() => {
      toast.style.animation = 'fadeOut 0.35s ease forwards';
      setTimeout(() => toast.remove(), 350);
    }, 3500);
  };

  /* ── INJECT KEYFRAMES FOR TOAST ── */
  const style = document.createElement('style');
  style.textContent = `
    @keyframes fadeIn { from { opacity:0 } to { opacity:1 } }
    @keyframes slideInUp { from { opacity:0; transform:translateY(16px) } to { opacity:1; transform:translateY(0) } }
    @keyframes fadeOut { to { opacity:0; transform:translateY(8px) } }
  `;
  document.head.appendChild(style);

  /* ── RIPPLE EFFECT ON BUTTONS ── */
  document.querySelectorAll('.btn-primary, .btn-outline').forEach(btn => {
    btn.addEventListener('click', function(e) {
      const rect  = this.getBoundingClientRect();
      const x     = e.clientX - rect.left;
      const y     = e.clientY - rect.top;
      const ripple = document.createElement('span');
      ripple.style.cssText = `
        position:absolute;
        left:${x}px;top:${y}px;
        width:0;height:0;
        background:rgba(255,255,255,0.25);
        border-radius:50%;
        transform:translate(-50%,-50%);
        animation:ripple 0.55s ease-out forwards;
        pointer-events:none;
      `;
      this.style.position = 'relative';
      this.style.overflow = 'hidden';
      this.appendChild(ripple);
      setTimeout(() => ripple.remove(), 600);
    });
  });

  const rippleStyle = document.createElement('style');
  rippleStyle.textContent = `
    @keyframes ripple {
      to { width:200px; height:200px; opacity:0; }
    }
  `;
  document.head.appendChild(rippleStyle);

});