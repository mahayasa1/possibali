<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pengaduan Baru — POSSI Bali</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background: #0a1628;
      color: #e8f4f8;
      -webkit-font-smoothing: antialiased;
    }
    .wrapper {
      max-width: 620px;
      margin: 0 auto;
      padding: 32px 16px;
    }

    /* Header */
    .email-header {
      background: linear-gradient(135deg, #0e3a5c 0%, #0e6b8a 100%);
      border-radius: 12px 12px 0 0;
      padding: 36px 40px 32px;
      text-align: center;
      border: 1px solid rgba(26,179,216,0.2);
      border-bottom: none;
    }
    .logo-mark {
      display: inline-block;
      width: 52px; height: 52px;
      border-radius: 14px;
      background: rgba(26,179,216,0.15);
      border: 1px solid rgba(26,179,216,0.3);
      line-height: 52px;
      font-size: 22px;
      margin-bottom: 16px;
    }
    .header-label {
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: #1ab3d8;
      margin-bottom: 8px;
    }
    .header-title {
      font-size: 22px;
      font-weight: 700;
      color: #f0f9fc;
      line-height: 1.3;
    }
    .header-title span {
      color: #5ee7f7;
    }

    /* Alert strip */
    .alert-strip {
      background: rgba(224,92,58,0.12);
      border-left: 3px solid #e05c3a;
      border-right: 1px solid rgba(26,179,216,0.15);
      padding: 12px 40px;
      font-size: 12px;
      color: #f5956e;
      font-weight: 600;
      letter-spacing: 0.05em;
    }

    /* Body */
    .email-body {
      background: #0d2040;
      border: 1px solid rgba(26,179,216,0.15);
      border-top: none;
      border-bottom: none;
      padding: 32px 40px;
    }

    /* Tiket badge */
    .tiket-badge {
      display: inline-block;
      background: rgba(26,179,216,0.12);
      border: 1px solid rgba(26,179,216,0.3);
      border-radius: 8px;
      padding: 10px 20px;
      font-size: 15px;
      font-weight: 700;
      color: #5ee7f7;
      letter-spacing: 0.08em;
      margin-bottom: 24px;
    }

    /* Section label */
    .section-label {
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      color: #1ab3d8;
      margin-bottom: 14px;
      padding-bottom: 8px;
      border-bottom: 1px solid rgba(26,179,216,0.15);
    }

    /* Info grid */
    .info-grid {
      display: table;
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 24px;
    }
    .info-row {
      display: table-row;
    }
    .info-key, .info-val {
      display: table-cell;
      padding: 9px 0;
      border-bottom: 1px solid rgba(255,255,255,0.04);
      vertical-align: top;
      font-size: 13px;
      line-height: 1.5;
    }
    .info-key {
      color: rgba(232,244,248,0.45);
      width: 38%;
      padding-right: 16px;
      white-space: nowrap;
    }
    .info-val {
      color: #e8f4f8;
      font-weight: 500;
    }
    .info-val .badge {
      display: inline-block;
      padding: 3px 10px;
      border-radius: 99px;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.06em;
      text-transform: uppercase;
    }
    .badge-perilaku     { background: rgba(224,92,58,0.15);  color: #f5956e; border: 1px solid rgba(224,92,58,0.3); }
    .badge-administrasi { background: rgba(212,168,83,0.15); color: #d4a853; border: 1px solid rgba(212,168,83,0.3); }
    .badge-fasilitas    { background: rgba(26,179,216,0.15); color: #1ab3d8; border: 1px solid rgba(26,179,216,0.3); }
    .badge-keselamatan  { background: rgba(224,92,58,0.2);   color: #f5956e; border: 1px solid rgba(224,92,58,0.4); }
    .badge-lainnya      { background: rgba(255,255,255,0.07);color: rgba(232,244,248,0.6); border: 1px solid rgba(255,255,255,0.12); }
    .badge-anonim       { background: rgba(212,168,83,0.15); color: #d4a853; border: 1px solid rgba(212,168,83,0.3); }

    /* Kronologi box */
    .kronologi-box {
      background: rgba(255,255,255,0.03);
      border: 1px solid rgba(26,179,216,0.12);
      border-radius: 8px;
      padding: 18px 20px;
      font-size: 13px;
      color: rgba(232,244,248,0.75);
      line-height: 1.75;
      white-space: pre-wrap;
      word-break: break-word;
      margin-bottom: 24px;
    }

    /* Bukti attachment */
    .bukti-box {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 16px;
      background: rgba(26,179,216,0.08);
      border: 1px solid rgba(26,179,216,0.2);
      border-radius: 8px;
      font-size: 12px;
      color: #5ee7f7;
      margin-bottom: 24px;
      word-break: break-all;
    }

    /* CTA */
    .cta-wrap {
      text-align: center;
      margin: 28px 0 8px;
    }
    .cta-btn {
      display: inline-block;
      padding: 13px 36px;
      background: linear-gradient(135deg, #0e7a9e, #1ab3d8);
      color: #fff !important;
      text-decoration: none;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 700;
      letter-spacing: 0.05em;
    }

    /* Meta strip */
    .meta-strip {
      background: rgba(255,255,255,0.025);
      border-radius: 8px;
      padding: 14px 18px;
      font-size: 11px;
      color: rgba(232,244,248,0.35);
      line-height: 1.8;
    }
    .meta-strip strong { color: rgba(232,244,248,0.55); }

    /* Footer */
    .email-footer {
      background: #091525;
      border: 1px solid rgba(26,179,216,0.1);
      border-top: none;
      border-radius: 0 0 12px 12px;
      padding: 22px 40px;
      text-align: center;
      font-size: 11px;
      color: rgba(232,244,248,0.3);
      line-height: 1.7;
    }
    .email-footer a { color: #1ab3d8; text-decoration: none; }

    @media (max-width: 480px) {
      .email-header, .email-body, .alert-strip, .email-footer { padding-left: 20px; padding-right: 20px; }
      .info-key { width: 42%; }
    }
  </style>
</head>
<body>
<div class="wrapper">

  {{-- Header --}}
  <div class="email-header">
    <div class="logo-mark">🏊</div>
    <div class="header-label">Sistem Pengaduan</div>
    <div class="header-title">Pengaduan Baru <span>Masuk</span></div>
  </div>

  {{-- Alert strip --}}
  <div class="alert-strip">
    ⚠️ &nbsp;Tindakan diperlukan — harap tinjau dan verifikasi laporan ini sesegera mungkin.
  </div>

  {{-- Body --}}
  <div class="email-body">

    <div class="tiket-badge">{{ $data['nomor_tiket'] }}</div>

    {{-- Data Pelapor --}}
    <div class="section-label">Data Pelapor</div>
    <div class="info-grid">
      <div class="info-row">
        <div class="info-key">Nama</div>
        <div class="info-val">
          {{ $data['anonim'] ? '—' : $data['nama_pelapor'] }}
          @if($data['anonim'])
            <span class="badge badge-anonim">Anonim</span>
          @endif
        </div>
      </div>
      <div class="info-row">
        <div class="info-key">Email</div>
        <div class="info-val">{{ $data['email_pelapor'] }}</div>
      </div>
      @if(!empty($data['telepon']))
      <div class="info-row">
        <div class="info-key">Telepon</div>
        <div class="info-val">{{ $data['telepon'] }}</div>
      </div>
      @endif
    </div>

    {{-- Detail Pengaduan --}}
    <div class="section-label">Detail Pengaduan</div>
    <div class="info-grid">
      <div class="info-row">
        <div class="info-key">Kategori</div>
        <div class="info-val">
          <span class="badge badge-{{ $data['kategori'] }}">{{ ucfirst($data['kategori']) }}</span>
        </div>
      </div>
      <div class="info-row">
        <div class="info-key">Judul</div>
        <div class="info-val">{{ $data['judul'] }}</div>
      </div>
      <div class="info-row">
        <div class="info-key">Waktu Masuk</div>
        <div class="info-val">{{ $data['waktu'] }}</div>
      </div>
      <div class="info-row">
        <div class="info-key">IP Address</div>
        <div class="info-val">{{ $data['ip'] }}</div>
      </div>
    </div>

    {{-- Kronologi --}}
    <div class="section-label">Kronologi Kejadian</div>
    <div class="kronologi-box">{{ $data['kronologi'] }}</div>

    {{-- Bukti --}}
    @if(!empty($data['bukti_nama']))
      <div class="section-label">Bukti Lampiran</div>
      <div class="bukti-box">
        📎 &nbsp;{{ $data['bukti_nama'] }}
      </div>
    @endif

    {{-- CTA --}}
    <div class="cta-wrap">
      <a href="{{ config('app.url') }}/admin/pengaduan/{{ $data['id'] ?? '' }}" class="cta-btn">
        Buka di Panel Admin →
      </a>
    </div>

    {{-- Meta --}}
    <div class="meta-strip">
      <strong>Nomor Tiket:</strong> {{ $data['nomor_tiket'] }}&nbsp;&nbsp;·&nbsp;&nbsp;
      <strong>Status:</strong> Diterima&nbsp;&nbsp;·&nbsp;&nbsp;
      <strong>Dikirim:</strong> {{ $data['waktu'] }}
    </div>

  </div>

  {{-- Footer --}}
  <div class="email-footer">
    Email ini dikirim otomatis oleh sistem POSSI Bali.<br>
    Jangan balas email ini langsung — gunakan panel admin untuk merespons pengaduan.<br><br>
    <a href="{{ config('app.url') }}">possibali.org</a> &nbsp;·&nbsp;
    <a href="mailto:admin@possibali.org">admin@possibali.org</a>
  </div>

</div>
</body>
</html>