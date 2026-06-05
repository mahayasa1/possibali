<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Dashboard') — POSSI Bali Admin</title>
  <link rel="stylesheet" href="{{ asset('css/possi.css') }}">
  <style>
    /* ── ADMIN LAYOUT ── */
    :root {
      --sidebar-w: 260px;
      --topbar-h: 64px;
      --admin-bg: #060d18;
    }

    body { background: var(--admin-bg); overflow-x: hidden; }

    /* ── SIDEBAR ── */
    .admin-sidebar {
      position: fixed;
      top: 0; left: 0; bottom: 0;
      width: var(--sidebar-w);
      background: rgba(10, 22, 40, 0.97);
      border-right: 1px solid var(--glass-border);
      backdrop-filter: blur(24px);
      z-index: 200;
      display: flex;
      flex-direction: column;
      transition: transform .3s ease;
    }

    .sidebar-brand {
      padding: 1.25rem 1.5rem;
      border-bottom: 1px solid var(--glass-border);
      display: flex;
      align-items: center;
      gap: 12px;
      flex-shrink: 0;
    }

    .sidebar-brand-icon {
      width: 38px; height: 38px;
      border-radius: 10px;
      background: linear-gradient(135deg, var(--ocean-teal), var(--ocean-bright));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      flex-shrink: 0;
    }

    .sidebar-brand-text {
      font-family: var(--font-display);
      font-size: 1rem;
      font-weight: 700;
      line-height: 1.1;
    }

    .sidebar-brand-text span {
      display: block;
      font-size: .62rem;
      font-family: var(--font-body);
      font-weight: 400;
      letter-spacing: .12em;
      text-transform: uppercase;
      color: var(--ocean-foam);
      opacity: .7;
    }

    .sidebar-nav {
      flex: 1;
      overflow-y: auto;
      padding: 1rem .75rem;
    }

    .sidebar-nav::-webkit-scrollbar { width: 4px; }
    .sidebar-nav::-webkit-scrollbar-thumb { background: var(--glass-border); border-radius: 99px; }

    .nav-section-label {
      font-size: .62rem;
      font-weight: 700;
      letter-spacing: .15em;
      text-transform: uppercase;
      color: rgba(247,251,252,.3);
      padding: .5rem .75rem .25rem;
      margin-top: .5rem;
    }

    .sidebar-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 9px 12px;
      border-radius: 8px;
      font-size: .855rem;
      font-weight: 500;
      color: rgba(247,251,252,.6);
      text-decoration: none;
      transition: all .2s ease;
      margin-bottom: 2px;
      position: relative;
    }

    .sidebar-item:hover {
      background: rgba(26,179,216,.08);
      color: var(--ocean-white);
    }

    .sidebar-item.active {
      background: linear-gradient(135deg, rgba(14,107,138,.35), rgba(26,179,216,.2));
      color: var(--ocean-foam);
      border: 1px solid rgba(94,231,247,.15);
    }

    .sidebar-item.active::before {
      content: '';
      position: absolute;
      left: 0; top: 20%; bottom: 20%;
      width: 3px;
      background: var(--ocean-bright);
      border-radius: 99px;
    }

    .sidebar-item svg { flex-shrink: 0; opacity: .7; }
    .sidebar-item.active svg { opacity: 1; }

    .sidebar-item-badge {
      margin-left: auto;
      padding: 2px 7px;
      border-radius: 99px;
      font-size: .65rem;
      font-weight: 700;
      background: rgba(26,179,216,.15);
      color: var(--ocean-bright);
      border: 1px solid rgba(26,179,216,.2);
    }

    .sidebar-footer {
      padding: .75rem;
      border-top: 1px solid var(--glass-border);
      flex-shrink: 0;
    }

    .sidebar-user {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 12px;
      border-radius: 10px;
      background: rgba(255,255,255,.04);
      border: 1px solid var(--glass-border);
    }

    .sidebar-avatar {
      width: 34px; height: 34px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--ocean-teal), var(--ocean-bright));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: .8rem;
      font-weight: 700;
      flex-shrink: 0;
    }

    .sidebar-user-info { flex: 1; min-width: 0; }

    .sidebar-user-name {
      font-size: .84rem;
      font-weight: 600;
      color: var(--ocean-white);
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .sidebar-user-role {
      font-size: .68rem;
      color: var(--ocean-bright);
      letter-spacing: .05em;
    }

    .sidebar-logout {
      width: 32px; height: 32px;
      border-radius: 8px;
      background: none;
      border: 1px solid var(--glass-border);
      color: rgba(247,251,252,.5);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all .2s;
      flex-shrink: 0;
    }

    .sidebar-logout:hover {
      background: rgba(224,92,58,.12);
      border-color: rgba(224,92,58,.3);
      color: var(--ocean-coral);
    }

    /* ── MAIN CONTENT ── */
    .admin-main {
      margin-left: var(--sidebar-w);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* ── TOPBAR ── */
    .admin-topbar {
      position: sticky;
      top: 0;
      z-index: 100;
      height: var(--topbar-h);
      background: rgba(6, 13, 24, 0.9);
      border-bottom: 1px solid var(--glass-border);
      backdrop-filter: blur(16px);
      display: flex;
      align-items: center;
      padding: 0 2rem;
      gap: 1rem;
    }

    .topbar-toggle {
      display: none;
      background: none;
      border: none;
      color: var(--ocean-white);
      cursor: pointer;
      padding: 8px;
      border-radius: 8px;
    }

    .topbar-title {
      font-family: var(--font-display);
      font-size: 1.05rem;
      font-weight: 600;
      flex: 1;
    }

    .topbar-title span {
      font-size: .75rem;
      font-family: var(--font-body);
      font-weight: 400;
      color: var(--text-muted);
      display: block;
    }

    .topbar-actions {
      display: flex;
      align-items: center;
      gap: .75rem;
    }

    .topbar-btn {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      padding: 7px 16px;
      border-radius: 8px;
      font-size: .82rem;
      font-weight: 600;
      text-decoration: none;
      transition: all .2s;
    }

    .topbar-btn-primary {
      background: linear-gradient(135deg, var(--ocean-teal), var(--ocean-bright));
      color: #fff;
      border: none;
    }
    .topbar-btn-primary:hover { filter: brightness(1.1); transform: translateY(-1px); }

    /* ── PAGE CONTENT ── */
    .admin-content {
      flex: 1;
      padding: 2rem;
    }

    /* ── CARDS ── */
    .admin-card {
      background: rgba(13, 38, 69, 0.5);
      border: 1px solid var(--glass-border);
      border-radius: 16px;
      backdrop-filter: blur(12px);
    }

    .admin-card-header {
      padding: 1.25rem 1.5rem;
      border-bottom: 1px solid var(--glass-border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .admin-card-title {
      font-family: var(--font-display);
      font-size: 1rem;
      font-weight: 600;
    }

    .admin-card-body {
      padding: 1.5rem;
    }

    /* ── STAT CARDS ── */
    .stat-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 16px;
      margin-bottom: 2rem;
    }

    .stat-card {
      background: rgba(13, 38, 69, 0.5);
      border: 1px solid var(--glass-border);
      border-radius: 14px;
      padding: 1.25rem;
      backdrop-filter: blur(12px);
      transition: transform .2s, box-shadow .2s;
    }

    .stat-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-glow); }

    .stat-card-top {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: .75rem;
    }

    .stat-card-icon {
      width: 40px; height: 40px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
    }

    .stat-card-change {
      font-size: .72rem;
      font-weight: 600;
      padding: 3px 8px;
      border-radius: 99px;
    }

    .stat-card-num {
      font-family: var(--font-display);
      font-size: 1.8rem;
      font-weight: 700;
      color: var(--ocean-foam);
      line-height: 1;
      margin-bottom: .3rem;
    }

    .stat-card-label {
      font-size: .78rem;
      color: rgba(247,251,252,.5);
    }

    /* ── TABLE ── */
    .admin-table-wrap {
      overflow-x: auto;
    }

    .admin-table {
      width: 100%;
      border-collapse: collapse;
    }

    .admin-table th {
      padding: 10px 14px;
      text-align: left;
      font-size: .72rem;
      font-weight: 700;
      letter-spacing: .08em;
      text-transform: uppercase;
      color: rgba(247,251,252,.45);
      border-bottom: 1px solid var(--glass-border);
      white-space: nowrap;
    }

    .admin-table td {
      padding: 12px 14px;
      font-size: .86rem;
      border-bottom: 1px solid rgba(90,200,230,.06);
      vertical-align: middle;
    }

    .admin-table tr:last-child td { border-bottom: none; }

    .admin-table tr:hover td {
      background: rgba(26,179,216,.04);
    }

    /* ── BADGES ── */
    .badge {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      padding: 3px 10px;
      border-radius: 99px;
      font-size: .68rem;
      font-weight: 700;
      letter-spacing: .05em;
    }

    .badge::before {
      content: '';
      width: 5px; height: 5px;
      border-radius: 50%;
      background: currentColor;
    }

    .badge-success { background: rgba(46,160,97,.15); color: #6ee09a; border: 1px solid rgba(46,160,97,.25); }
    .badge-warning { background: rgba(212,168,83,.15); color: var(--ocean-gold); border: 1px solid rgba(212,168,83,.25); }
    .badge-danger  { background: rgba(224,92,58,.15); color: #f5856e; border: 1px solid rgba(224,92,58,.25); }
    .badge-info    { background: rgba(26,179,216,.12); color: var(--ocean-bright); border: 1px solid rgba(26,179,216,.2); }
    .badge-muted   { background: rgba(255,255,255,.06); color: rgba(247,251,252,.5); border: 1px solid var(--glass-border); }

    /* ── ACTION BUTTONS ── */
    .action-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 30px; height: 30px;
      border-radius: 7px;
      border: 1px solid var(--glass-border);
      background: transparent;
      color: rgba(247,251,252,.6);
      cursor: pointer;
      transition: all .2s;
      text-decoration: none;
    }

    .action-btn:hover { background: rgba(255,255,255,.08); color: var(--ocean-white); border-color: rgba(94,231,247,.25); }
    .action-btn-edit:hover { background: rgba(26,179,216,.12); border-color: rgba(26,179,216,.3); color: var(--ocean-bright); }
    .action-btn-delete:hover { background: rgba(224,92,58,.12); border-color: rgba(224,92,58,.3); color: var(--ocean-coral); }
    .action-btn-toggle:hover { background: rgba(46,160,97,.12); border-color: rgba(46,160,97,.3); color: #6ee09a; }

    /* ── FORM STYLES ── */
    .admin-form-group {
      margin-bottom: 1.25rem;
    }

    .admin-form-label {
      display: block;
      font-size: .76rem;
      font-weight: 600;
      letter-spacing: .07em;
      text-transform: uppercase;
      color: rgba(247,251,252,.65);
      margin-bottom: 7px;
    }

    .admin-form-label .req { color: var(--ocean-coral); }

    .admin-input {
      width: 100%;
      padding: 10px 14px;
      background: rgba(255,255,255,.05);
      border: 1.5px solid rgba(90,200,230,.15);
      border-radius: 8px;
      color: var(--ocean-white);
      font-family: var(--font-body);
      font-size: .9rem;
      transition: border-color .2s, box-shadow .2s;
      outline: none;
    }

    .admin-input::placeholder { color: rgba(247,251,252,.3); }
    .admin-input:focus { border-color: var(--ocean-bright); box-shadow: 0 0 0 3px rgba(26,179,216,.12); }
    .admin-input.is-invalid { border-color: var(--ocean-coral); }

    select.admin-input { cursor: pointer; }
    textarea.admin-input { resize: vertical; min-height: 100px; }

    .admin-form-hint {
      font-size: .74rem;
      color: var(--text-muted);
      margin-top: 5px;
    }

    .admin-form-error {
      font-size: .76rem;
      color: #f5856e;
      margin-top: 5px;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .form-row-2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
    }

    .form-row-3 {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      gap: 1rem;
    }

    .toggle-wrap {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .toggle-switch {
      position: relative;
      width: 42px; height: 24px;
      flex-shrink: 0;
    }

    .toggle-switch input { opacity: 0; width: 0; height: 0; }

    .toggle-slider {
      position: absolute;
      cursor: pointer;
      inset: 0;
      background: rgba(255,255,255,.12);
      border-radius: 99px;
      transition: background .25s;
    }

    .toggle-slider::before {
      content: '';
      position: absolute;
      height: 18px; width: 18px;
      left: 3px; bottom: 3px;
      background: rgba(247,251,252,.6);
      border-radius: 50%;
      transition: transform .25s, background .25s;
    }

    .toggle-switch input:checked + .toggle-slider {
      background: linear-gradient(135deg, var(--ocean-teal), var(--ocean-bright));
    }

    .toggle-switch input:checked + .toggle-slider::before {
      transform: translateX(18px);
      background: #fff;
    }

    .toggle-label {
      font-size: .86rem;
      color: rgba(247,251,252,.7);
    }

    /* ── SEARCH/FILTER BAR ── */
    .admin-filter-bar {
      display: flex;
      align-items: center;
      gap: .75rem;
      flex-wrap: wrap;
    }

    .admin-search-wrap {
      display: flex;
      align-items: center;
      gap: 8px;
      background: rgba(255,255,255,.05);
      border: 1.5px solid rgba(90,200,230,.15);
      border-radius: 8px;
      padding: 8px 14px;
      transition: border-color .2s;
      flex: 1;
      min-width: 200px;
      max-width: 320px;
    }

    .admin-search-wrap:focus-within { border-color: var(--ocean-bright); }

    .admin-search-input {
      background: none; border: none; outline: none;
      color: var(--ocean-white); font-family: var(--font-body);
      font-size: .88rem; width: 100%;
    }

    .admin-search-input::placeholder { color: rgba(247,251,252,.35); }

    .admin-filter-select {
      padding: 8px 12px;
      background: rgba(255,255,255,.05);
      border: 1.5px solid rgba(90,200,230,.15);
      border-radius: 8px;
      color: var(--ocean-white);
      font-family: var(--font-body);
      font-size: .85rem;
      cursor: pointer;
      outline: none;
      transition: border-color .2s;
    }

    .admin-filter-select:focus { border-color: var(--ocean-bright); }

    /* ── PAGINATION ── */
    .admin-pagination {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      gap: .5rem;
      padding: 1rem 1.5rem;
      border-top: 1px solid var(--glass-border);
      font-size: .82rem;
      color: var(--text-muted);
    }

    /* ── FLASH ── */
    .admin-flash {
      margin-bottom: 1.5rem;
      padding: 13px 18px;
      border-radius: 10px;
      font-size: .88rem;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .admin-flash-success {
      background: rgba(46,160,97,.15);
      border: 1px solid rgba(46,160,97,.3);
      color: #6ee09a;
    }

    .admin-flash-error {
      background: rgba(224,92,58,.15);
      border: 1px solid rgba(224,92,58,.3);
      color: #f5856e;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 1024px) {
      .admin-sidebar { transform: translateX(-100%); }
      .admin-sidebar.open { transform: translateX(0); }
      .admin-main { margin-left: 0; }
      .topbar-toggle { display: flex; }
      .stat-grid { grid-template-columns: repeat(2, 1fr); }
      .form-row-3 { grid-template-columns: 1fr 1fr; }
    }

    @media (max-width: 640px) {
      .stat-grid { grid-template-columns: 1fr 1fr; }
      .form-row-2 { grid-template-columns: 1fr; }
      .admin-content { padding: 1.25rem; }
    }

    /* ── OVERLAY ── */
    .sidebar-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,.5);
      z-index: 199;
      backdrop-filter: blur(2px);
    }

    .sidebar-overlay.show { display: block; }

    /* ── CONFIRM MODAL ── */
    .confirm-modal {
      display: none;
      position: fixed;
      inset: 0;
      z-index: 9000;
      background: rgba(6,13,24,.8);
      align-items: center;
      justify-content: center;
      backdrop-filter: blur(8px);
    }
    .confirm-modal.show { display: flex; }
    .confirm-modal-box {
      background: rgba(13,38,69,.95);
      border: 1px solid var(--glass-border);
      border-radius: 16px;
      padding: 2rem;
      max-width: 380px;
      width: 90%;
      text-align: center;
      box-shadow: 0 24px 80px rgba(0,0,0,.6);
    }
    .confirm-modal-icon { font-size: 2.5rem; margin-bottom: 1rem; }
    .confirm-modal-title { font-family: var(--font-display); font-size: 1.1rem; font-weight: 600; margin-bottom: .5rem; }
    .confirm-modal-desc { font-size: .85rem; color: rgba(247,251,252,.6); margin-bottom: 1.5rem; }
    .confirm-modal-actions { display: flex; gap: .75rem; justify-content: center; }
    .confirm-btn-cancel {
      padding: 9px 22px;
      border-radius: 8px;
      border: 1.5px solid var(--glass-border);
      background: transparent;
      color: rgba(247,251,252,.7);
      font-family: var(--font-body);
      font-size: .88rem;
      font-weight: 500;
      cursor: pointer;
      transition: all .2s;
    }
    .confirm-btn-cancel:hover { border-color: var(--ocean-bright); color: var(--ocean-white); }
    .confirm-btn-confirm {
      padding: 9px 22px;
      border-radius: 8px;
      border: none;
      background: linear-gradient(135deg, #c94025, var(--ocean-coral));
      color: #fff;
      font-family: var(--font-body);
      font-size: .88rem;
      font-weight: 600;
      cursor: pointer;
      transition: all .2s;
    }
    .confirm-btn-confirm:hover { filter: brightness(1.1); }
  </style>
</head>
<body>

<!-- Sidebar Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- ══ SIDEBAR ══ -->
<aside class="admin-sidebar" id="adminSidebar">
  <div class="sidebar-brand">
    <div class="sidebar-brand-icon">🤿</div>
    <div class="sidebar-brand-text">
      POSSI Bali
      <span>Admin Panel</span>
    </div>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-section-label">Utama</div>

    <a href="{{ route('admin.dashboard') }}"
       class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
        <rect x="2" y="2" width="6" height="6" rx="1.5" stroke="currentColor" stroke-width="1.5"/>
        <rect x="10" y="2" width="6" height="6" rx="1.5" stroke="currentColor" stroke-width="1.5"/>
        <rect x="2" y="10" width="6" height="6" rx="1.5" stroke="currentColor" stroke-width="1.5"/>
        <rect x="10" y="10" width="6" height="6" rx="1.5" stroke="currentColor" stroke-width="1.5"/>
      </svg>
      Dashboard
    </a>

    <div class="nav-section-label" style="margin-top:1rem;">Konten</div>

    <a href="{{ route('admin.news.index') }}"
       class="sidebar-item {{ request()->routeIs('admin.news*') ? 'active' : '' }}">
      <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
        <rect x="2" y="2" width="14" height="14" rx="2" stroke="currentColor" stroke-width="1.5"/>
        <path d="M5 6h8M5 9h8M5 12h5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
      </svg>
      Berita
    </a>

    <a href="{{ route('admin.events.index') }}"
       class="sidebar-item {{ request()->routeIs('admin.events*') ? 'active' : '' }}">
      <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
        <rect x="2" y="3" width="14" height="13" rx="2" stroke="currentColor" stroke-width="1.5"/>
        <path d="M2 7h14" stroke="currentColor" stroke-width="1.3"/>
        <path d="M6 2v2M12 2v2" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
        <path d="M5 11h3M10 11h3M5 14h2" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/>
      </svg>
      Events
    </a>

    <a href="{{ route('admin.clubs.index') }}"
       class="sidebar-item {{ request()->routeIs('admin.clubs*') ? 'active' : '' }}">
      <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
        <circle cx="9" cy="7" r="3" stroke="currentColor" stroke-width="1.5"/>
        <path d="M3 16c0-3.314 2.686-6 6-6s6 2.686 6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
      </svg>
      Club Selam
    </a>

    <a href="{{ route('admin.satgas.index') }}"
       class="sidebar-item {{ request()->routeIs('admin.satgas*') ? 'active' : '' }}">
      <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
        <path d="M9 2l2 5h5l-4 3 2 5-5-3-5 3 2-5-4-3h5z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
      </svg>
      Satgas
    </a>

    <div class="nav-section-label" style="margin-top:1rem;">Umum</div>

    <a href="{{ url('/') }}" target="_blank" class="sidebar-item">
      <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
        <path d="M8 3H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
        <path d="M10 2h6v6M16 2l-7 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      Lihat Website
    </a>
  </nav>

  <div class="sidebar-footer">
    <div class="sidebar-user">
      <div class="sidebar-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
      <div class="sidebar-user-info">
        <div class="sidebar-user-name">{{ Str::limit(Auth::user()->name, 18) }}</div>
        <div class="sidebar-user-role">Administrator</div>
      </div>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="sidebar-logout" title="Keluar">
          <svg width="15" height="15" viewBox="0 0 15 15" fill="none">
            <path d="M6 2H3a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3M10 10l3-2.5L10 5M13 7.5H6" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
      </form>
    </div>
  </div>
</aside>

<!-- ══ MAIN ══ -->
<div class="admin-main">
  <!-- Topbar -->
  <div class="admin-topbar">
    <button class="topbar-toggle" id="sidebarToggle">
      <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
        <path d="M3 5h14M3 10h14M3 15h14" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
      </svg>
    </button>
    <div class="topbar-title">
      @yield('page-title', 'Dashboard')
      <span>@yield('page-subtitle', 'POSSI Bali Admin')</span>
    </div>
    <div class="topbar-actions">
      @yield('topbar-actions')
    </div>
  </div>

  <!-- Content -->
  <main class="admin-content">
    @if(session('success'))
    <div class="admin-flash admin-flash-success">
      <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.5"/><path d="M5 8l2.5 2.5 3.5-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
      {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="admin-flash admin-flash-error">
      <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.5"/><path d="M8 4.5v4M8 10.5v.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
      {{ session('error') }}
    </div>
    @endif

    @yield('content')
  </main>
</div>

<!-- Confirm Delete Modal -->
<div class="confirm-modal" id="confirmModal">
  <div class="confirm-modal-box">
    <div class="confirm-modal-icon">🗑️</div>
    <div class="confirm-modal-title">Hapus Data?</div>
    <div class="confirm-modal-desc">Tindakan ini tidak dapat dibatalkan. Data akan dihapus secara permanen.</div>
    <div class="confirm-modal-actions">
      <button class="confirm-btn-cancel" id="confirmCancel">Batal</button>
      <button class="confirm-btn-confirm" id="confirmOk">Ya, Hapus</button>
    </div>
  </div>
</div>

<script>
// Sidebar toggle
const sidebar = document.getElementById('adminSidebar');
const overlay = document.getElementById('sidebarOverlay');
const toggle  = document.getElementById('sidebarToggle');

toggle?.addEventListener('click', () => {
  sidebar.classList.toggle('open');
  overlay.classList.toggle('show');
});

overlay?.addEventListener('click', () => {
  sidebar.classList.remove('open');
  overlay.classList.remove('show');
});

// Confirm modal
let pendingForm = null;

document.querySelectorAll('[data-confirm]').forEach(el => {
  el.addEventListener('click', function(e) {
    e.preventDefault();
    const form = document.getElementById(this.dataset.confirm);
    if (form) {
      pendingForm = form;
      document.getElementById('confirmModal').classList.add('show');
    }
  });
});

document.getElementById('confirmOk')?.addEventListener('click', () => {
  if (pendingForm) pendingForm.submit();
  document.getElementById('confirmModal').classList.remove('show');
});

document.getElementById('confirmCancel')?.addEventListener('click', () => {
  document.getElementById('confirmModal').classList.remove('show');
  pendingForm = null;
});

// Auto close flash
setTimeout(() => {
  document.querySelectorAll('.admin-flash').forEach(el => {
    el.style.transition = 'opacity .4s';
    el.style.opacity = '0';
    setTimeout(() => el.remove(), 400);
  });
}, 4000);
</script>

@stack('scripts')
</body>
</html>