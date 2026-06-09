```blade
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pengaduan Diterima — POSSI Bali</title>

<style>
*{margin:0;padding:0;box-sizing:border-box;}

body{
    font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;
    background:#0a1628;
    color:#e8f4f8;
    -webkit-font-smoothing:antialiased;
}

.wrapper{
    max-width:620px;
    margin:0 auto;
    padding:32px 16px;
}

/* HEADER */
.email-header{
    background:linear-gradient(135deg,#0e3a5c 0%,#0e6b8a 100%);
    border-radius:12px 12px 0 0;
    padding:36px 40px 32px;
    text-align:center;
    border:1px solid rgba(26,179,216,.2);
    border-bottom:none;
}

.logo-mark{
    display:inline-block;
    width:52px;
    height:52px;
    border-radius:14px;
    background:rgba(26,179,216,.15);
    border:1px solid rgba(26,179,216,.3);
    line-height:52px;
    font-size:22px;
    margin-bottom:16px;
}

.header-label{
    font-size:11px;
    font-weight:700;
    letter-spacing:.2em;
    text-transform:uppercase;
    color:#1ab3d8;
    margin-bottom:8px;
}

.header-title{
    font-size:22px;
    font-weight:700;
    color:#f0f9fc;
    line-height:1.3;
}

.header-title span{
    color:#5ee7f7;
}

/* SUCCESS STRIP */
.alert-strip{
    background:rgba(39,174,96,.12);
    border-left:3px solid #27ae60;
    border-right:1px solid rgba(26,179,216,.15);
    padding:12px 40px;
    font-size:12px;
    color:#7ef0a7;
    font-weight:600;
    letter-spacing:.05em;
}

/* BODY */
.email-body{
    background:#0d2040;
    border:1px solid rgba(26,179,216,.15);
    border-top:none;
    border-bottom:none;
    padding:32px 40px;
}

.tiket-badge{
    display:inline-block;
    background:rgba(26,179,216,.12);
    border:1px solid rgba(26,179,216,.3);
    border-radius:8px;
    padding:10px 20px;
    font-size:15px;
    font-weight:700;
    color:#5ee7f7;
    letter-spacing:.08em;
    margin-bottom:24px;
}

.intro-box{
    background:rgba(26,179,216,.06);
    border:1px solid rgba(26,179,216,.12);
    border-radius:8px;
    padding:18px;
    margin-bottom:24px;
    line-height:1.8;
    color:rgba(232,244,248,.8);
    font-size:13px;
}

.section-label{
    font-size:10px;
    font-weight:700;
    letter-spacing:.18em;
    text-transform:uppercase;
    color:#1ab3d8;
    margin-bottom:14px;
    padding-bottom:8px;
    border-bottom:1px solid rgba(26,179,216,.15);
}

.info-grid{
    display:table;
    width:100%;
    border-collapse:collapse;
    margin-bottom:24px;
}

.info-row{
    display:table-row;
}

.info-key,
.info-val{
    display:table-cell;
    padding:9px 0;
    border-bottom:1px solid rgba(255,255,255,.04);
    vertical-align:top;
    font-size:13px;
}

.info-key{
    width:38%;
    color:rgba(232,244,248,.45);
    padding-right:16px;
}

.info-val{
    color:#e8f4f8;
    font-weight:500;
}

.badge{
    display:inline-block;
    padding:3px 10px;
    border-radius:99px;
    font-size:11px;
    font-weight:700;
    letter-spacing:.05em;
    text-transform:uppercase;
}

.badge-perilaku{
    background:rgba(224,92,58,.15);
    color:#f5956e;
    border:1px solid rgba(224,92,58,.3);
}

.badge-administrasi{
    background:rgba(212,168,83,.15);
    color:#d4a853;
    border:1px solid rgba(212,168,83,.3);
}

.badge-fasilitas{
    background:rgba(26,179,216,.15);
    color:#1ab3d8;
    border:1px solid rgba(26,179,216,.3);
}

.badge-keselamatan{
    background:rgba(224,92,58,.2);
    color:#f5956e;
    border:1px solid rgba(224,92,58,.4);
}

.badge-lainnya{
    background:rgba(255,255,255,.07);
    color:rgba(232,244,248,.7);
    border:1px solid rgba(255,255,255,.12);
}

.kronologi-box{
    background:rgba(255,255,255,.03);
    border:1px solid rgba(26,179,216,.12);
    border-radius:8px;
    padding:18px 20px;
    font-size:13px;
    line-height:1.75;
    color:rgba(232,244,248,.75);
    white-space:pre-wrap;
    word-break:break-word;
    margin-bottom:24px;
}

.status-box{
    background:rgba(39,174,96,.08);
    border:1px solid rgba(39,174,96,.18);
    border-radius:8px;
    padding:18px;
    margin-bottom:24px;
}

.status-box h4{
    color:#7ef0a7;
    margin-bottom:8px;
    font-size:13px;
}

.status-box p{
    font-size:13px;
    line-height:1.7;
    color:rgba(232,244,248,.75);
}

.cta-wrap{
    text-align:center;
    margin:28px 0 8px;
}

.cta-btn{
    display:inline-block;
    padding:13px 36px;
    background:linear-gradient(135deg,#0e7a9e,#1ab3d8);
    color:#fff !important;
    text-decoration:none;
    border-radius:8px;
    font-size:13px;
    font-weight:700;
}

.meta-strip{
    background:rgba(255,255,255,.025);
    border-radius:8px;
    padding:14px 18px;
    font-size:11px;
    color:rgba(232,244,248,.35);
    line-height:1.8;
}

.meta-strip strong{
    color:rgba(232,244,248,.55);
}

.email-footer{
    background:#091525;
    border:1px solid rgba(26,179,216,.1);
    border-top:none;
    border-radius:0 0 12px 12px;
    padding:22px 40px;
    text-align:center;
    font-size:11px;
    color:rgba(232,244,248,.3);
    line-height:1.7;
}

.email-footer a{
    color:#1ab3d8;
    text-decoration:none;
}

@media (max-width:480px){
    .email-header,
    .email-body,
    .alert-strip,
    .email-footer{
        padding-left:20px;
        padding-right:20px;
    }
}
</style>
</head>

<body>
<div class="wrapper">

<div class="email-header">
    <div class="logo-mark">📩</div>
    <div class="header-label">Sistem Pengaduan</div>
    <div class="header-title">
        Pengaduan Berhasil <span>Diterima</span>
    </div>
</div>

<div class="alert-strip">
    ✓ Terima kasih. Laporan Anda telah tercatat dalam sistem POSSI Bali.
</div>

<div class="email-body">

    <div class="tiket-badge">
        {{ $data['nomor_tiket'] }}
    </div>

    <div class="intro-box">
        Halo {{ $data['nama_pelapor'] ?? 'Pelapor' }},<br><br>

        Terima kasih telah menyampaikan pengaduan kepada POSSI Bali.
        Laporan Anda telah kami terima dan akan ditinjau oleh tim yang berwenang.

        Mohon simpan nomor tiket di atas sebagai referensi apabila diperlukan
        untuk tindak lanjut atau pelacakan status pengaduan.
    </div>

    <div class="section-label">Ringkasan Pengaduan</div>

    <div class="info-grid">

        <div class="info-row">
            <div class="info-key">Nomor Tiket</div>
            <div class="info-val">{{ $data['nomor_tiket'] }}</div>
        </div>

        <div class="info-row">
            <div class="info-key">Kategori</div>
            <div class="info-val">
                <span class="badge badge-{{ $data['kategori'] }}">
                    {{ ucfirst($data['kategori']) }}
                </span>
            </div>
        </div>

        <div class="info-row">
            <div class="info-key">Judul Pengaduan</div>
            <div class="info-val">
                {{ $data['judul'] }}
            </div>
        </div>

        <div class="info-row">
            <div class="info-key">Tanggal Pengajuan</div>
            <div class="info-val">
                {{ $data['waktu'] }}
            </div>
        </div>

        <div class="info-row">
            <div class="info-key">Status Saat Ini</div>
            <div class="info-val">
                Diterima & Menunggu Verifikasi
            </div>
        </div>

    </div>

    <div class="section-label">Isi Pengaduan</div>

    <div class="kronologi-box">
        {{ $data['kronologi'] }}
    </div>

    <div class="status-box">
        <h4>📋 Tahapan Selanjutnya</h4>
        <p>
            Tim POSSI Bali akan melakukan verifikasi awal terhadap laporan yang masuk.
            Jika diperlukan informasi tambahan, kami dapat menghubungi Anda melalui
            email atau nomor telepon yang telah didaftarkan.
        </p>
    </div>

    <div class="cta-wrap">
        <a href="{{ config('app.url') }}/pengaduan/tracking/{{ $data['nomor_tiket'] }}"
           class="cta-btn">
            Lacak Status Pengaduan →
        </a>
    </div>

    <div class="meta-strip">
        <strong>Nomor Tiket:</strong> {{ $data['nomor_tiket'] }}
        &nbsp;&nbsp;·&nbsp;&nbsp;
        <strong>Status:</strong> Diterima
        &nbsp;&nbsp;·&nbsp;&nbsp;
        <strong>Dikirim:</strong> {{ $data['waktu'] }}
    </div>

</div>

<div class="email-footer">
    Email ini dikirim otomatis oleh Sistem Pengaduan POSSI Bali.<br>
    Mohon simpan email ini sebagai bukti penerimaan laporan Anda.<br><br>

    <a href="{{ config('app.url') }}">possibali.org</a>
    &nbsp;·&nbsp;
    <a href="mailto:pengaduan@possibali.org">
        pengaduan@possibali.org
    </a>
</div>

</div>
</body>
</html>
```
