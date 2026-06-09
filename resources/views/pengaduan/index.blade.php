@extends('layouts.app')

@section('title', 'Pengaduan — POSSI Bali')
@section('meta_description', 'Sampaikan pengaduan Anda kepada POSSI Bali. Kami berkomitmen menangani setiap laporan dengan serius, transparan, dan tepat waktu.')

@push('styles')
<style>
/* ══════════════════════════════════════════════
   PENGADUAN PAGE — Ocean Theme Integration
   ══════════════════════════════════════════════ */

/* ── Page Header ── */
.pengaduan-header {
  padding: 130px 2rem 70px;
  background:
    radial-gradient(ellipse 65% 70% at 75% 20%, rgba(14,107,138,0.35) 0%, transparent 65%),
    radial-gradient(ellipse 40% 50% at 15% 85%, rgba(26,179,216,0.1) 0%, transparent 60%),
    linear-gradient(165deg, var(--ocean-mid) 0%, var(--ocean-deep) 100%);
  position: relative;
  overflow: hidden;
  text-align: center;
}

.pengaduan-header::after {
  content: '';
  position: absolute;
  bottom: -2px; left: 0; right: 0;
  height: 80px;
  background: linear-gradient(to bottom, transparent, var(--ocean-deep));
  pointer-events: none;
}

.header-icon-wrap {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 72px; height: 72px;
  border-radius: 18px;
  background: rgba(26,179,216,0.12);
  border: 1px solid rgba(26,179,216,0.25);
  font-size: 2rem;
  margin: 0 auto 1.5rem;
  position: relative;
  z-index: 1;
}

.header-icon-wrap svg {
  width: 34px; height: 34px;
  color: var(--ocean-foam);
}

.header-eyebrow {
  display: inline-block;
  font-size: 0.7rem;
  font-weight: 700;
  letter-spacing: 0.22em;
  text-transform: uppercase;
  color: var(--ocean-bright);
  margin-bottom: 1rem;
  position: relative;
  z-index: 1;
}

.header-title {
  font-family: var(--font-display);
  font-size: clamp(2rem, 4vw, 3rem);
  font-weight: 700;
  line-height: 1.1;
  margin-bottom: 1rem;
  position: relative;
  z-index: 1;
}

.header-title em {
  font-style: italic;
  background: linear-gradient(135deg, var(--ocean-bright), var(--ocean-foam));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.header-desc {
  font-size: 1rem;
  color: rgba(247,251,252,0.6);
  max-width: 520px;
  margin: 0 auto;
  line-height: 1.75;
  position: relative;
  z-index: 1;
}

/* ── Page Body ── */
.pengaduan-body {
  background: var(--ocean-deep);
  padding: 4rem 2rem 6rem;
  min-height: 60vh;
}

.pengaduan-layout {
  max-width: 1100px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: 320px 1fr;
  gap: 2.5rem;
  align-items: start;
}

/* ── Sidebar Info ── */
.sidebar-info {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
  position: sticky;
  top: 92px;
}

.info-card {
  background: var(--glass-bg);
  border: 1px solid var(--glass-border);
  border-radius: var(--radius-md);
  padding: 1.5rem;
  backdrop-filter: blur(12px);
}

.info-card-title {
  font-family: var(--font-display);
  font-size: 0.95rem;
  font-weight: 600;
  margin-bottom: 1rem;
  display: flex;
  align-items: center;
  gap: 8px;
  color: var(--ocean-foam);
}

.info-card-title svg {
  opacity: 0.7;
  flex-shrink: 0;
}

.info-steps {
  display: flex;
  flex-direction: column;
  gap: 0;
}

.info-step {
  display: flex;
  gap: 12px;
  position: relative;
}

.info-step:not(:last-child)::before {
  content: '';
  position: absolute;
  left: 13px;
  top: 28px;
  bottom: -2px;
  width: 1px;
  background: var(--glass-border);
}

.step-dot {
  width: 26px; height: 26px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--ocean-teal), var(--ocean-bright));
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.65rem;
  font-weight: 700;
  color: #fff;
  flex-shrink: 0;
  margin-top: 2px;
}

.step-content {
  padding-bottom: 1.25rem;
}

.step-content strong {
  display: block;
  font-size: 0.82rem;
  font-weight: 600;
  color: var(--ocean-white);
  margin-bottom: 3px;
}

.step-content p {
  font-size: 0.75rem;
  color: rgba(247,251,252,0.45);
  line-height: 1.55;
}

.kategori-list {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.kategori-item {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 0.8rem;
  color: rgba(247,251,252,0.65);
}

.kategori-dot {
  width: 6px; height: 6px;
  border-radius: 50%;
  background: var(--ocean-bright);
  flex-shrink: 0;
}

.tracking-link-wrap {
  background: linear-gradient(135deg, rgba(14,107,138,0.25), rgba(26,179,216,0.1));
  border: 1px solid rgba(26,179,216,0.2);
  border-radius: var(--radius-md);
  padding: 1.25rem;
  text-align: center;
}

.tracking-link-wrap p {
  font-size: 0.8rem;
  color: rgba(247,251,252,0.55);
  margin-bottom: 1rem;
  line-height: 1.55;
}

.btn-tracking {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 22px;
  border: 1.5px solid rgba(94,231,247,0.35);
  border-radius: var(--radius-sm);
  font-size: 0.82rem;
  font-weight: 600;
  color: var(--ocean-foam);
  background: transparent;
  transition: all var(--transition);
  cursor: pointer;
  text-decoration: none;
}

.btn-tracking:hover {
  background: rgba(94,231,247,0.1);
  border-color: var(--ocean-foam);
}

/* ── Main Form Card ── */
.form-card {
  background: var(--glass-bg);
  border: 1px solid var(--glass-border);
  border-radius: var(--radius-lg);
  padding: 2.5rem;
  backdrop-filter: blur(16px);
  position: relative;
  overflow: hidden;
}

.form-card::before {
  content: '';
  position: absolute;
  top: -80px; right: -80px;
  width: 280px; height: 280px;
  background: radial-gradient(circle, rgba(26,179,216,0.07), transparent 70%);
  pointer-events: none;
}

.form-section-title {
  font-family: var(--font-display);
  font-size: 1.4rem;
  font-weight: 700;
  margin-bottom: 0.4rem;
}

.form-section-sub {
  font-size: 0.85rem;
  color: rgba(247,251,252,0.45);
  margin-bottom: 2rem;
}

.form-divider {
  display: flex;
  align-items: center;
  gap: 12px;
  margin: 1.75rem 0;
}

.form-divider-label {
  font-size: 0.7rem;
  font-weight: 700;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  color: var(--ocean-bright);
  white-space: nowrap;
}

.form-divider-line {
  flex: 1;
  height: 1px;
  background: var(--glass-border);
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
}

.form-group {
  margin-bottom: 16px;
}

.form-group label {
  display: flex;
  align-items: center;
  gap: 5px;
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  color: rgba(247,251,252,0.65);
  margin-bottom: 8px;
}

.label-required {
  color: var(--ocean-coral);
  font-size: 0.85rem;
}

.form-control {
  width: 100%;
  padding: 11px 16px;
  background: rgba(255,255,255,0.04);
  border: 1.5px solid var(--glass-border);
  border-radius: var(--radius-sm);
  color: var(--ocean-white);
  font-family: var(--font-body);
  font-size: 0.9rem;
  transition: border-color var(--transition), box-shadow var(--transition), background var(--transition);
  outline: none;
  appearance: none;
}

.form-control::placeholder { color: rgba(247,251,252,0.25); }

.form-control:focus {
  border-color: var(--ocean-bright);
  box-shadow: 0 0 0 3px rgba(26,179,216,0.12);
  background: rgba(255,255,255,0.06);
}

.form-control.is-invalid {
  border-color: var(--ocean-coral);
  box-shadow: 0 0 0 3px rgba(224,92,58,0.12);
}

.invalid-feedback {
  display: block;
  font-size: 0.75rem;
  color: #f5956e;
  margin-top: 5px;
}

textarea.form-control {
  resize: vertical;
  min-height: 140px;
  line-height: 1.65;
}

select.form-control {
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath d='M2 4l4 4 4-4' stroke='%235ac8e6' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 14px center;
  padding-right: 36px;
  cursor: pointer;
}

select.form-control option {
  background: #0d2645;
  color: var(--ocean-white);
}

/* ── File Upload ── */
.file-upload-zone {
  border: 1.5px dashed var(--glass-border);
  border-radius: var(--radius-sm);
  padding: 1.5rem;
  text-align: center;
  cursor: pointer;
  transition: all var(--transition);
  background: rgba(255,255,255,0.02);
  position: relative;
}

.file-upload-zone:hover,
.file-upload-zone.dragover {
  border-color: var(--ocean-bright);
  background: rgba(26,179,216,0.06);
}

.file-upload-zone input[type="file"] {
  position: absolute;
  inset: 0;
  opacity: 0;
  cursor: pointer;
  width: 100%;
  height: 100%;
}

.upload-icon {
  font-size: 1.8rem;
  margin-bottom: 8px;
  opacity: 0.5;
}

.upload-text {
  font-size: 0.82rem;
  color: rgba(247,251,252,0.5);
  line-height: 1.5;
}

.upload-text strong {
  color: var(--ocean-bright);
}

.upload-hint {
  font-size: 0.72rem;
  color: rgba(247,251,252,0.3);
  margin-top: 4px;
}

.file-selected {
  display: none;
  align-items: center;
  gap: 8px;
  padding: 8px 12px;
  margin-top: 8px;
  background: rgba(26,179,216,0.1);
  border: 1px solid rgba(26,179,216,0.25);
  border-radius: var(--radius-sm);
  font-size: 0.78rem;
  color: var(--ocean-foam);
}

.file-selected.visible { display: flex; }

.file-remove {
  margin-left: auto;
  background: none;
  border: none;
  color: rgba(247,251,252,0.4);
  cursor: pointer;
  font-size: 1rem;
  line-height: 1;
  transition: color var(--transition);
  padding: 0;
}

.file-remove:hover { color: var(--ocean-coral); }

/* ── Anonim Toggle ── */
.anonim-toggle {
  display: flex;
  align-items: flex-start;
  gap: 14px;
  padding: 1.2rem;
  border-radius: var(--radius-sm);
  background: rgba(255,255,255,0.03);
  border: 1px solid var(--glass-border);
  cursor: pointer;
  transition: background var(--transition), border-color var(--transition);
}

.anonim-toggle:hover {
  background: rgba(255,255,255,0.05);
  border-color: rgba(90,200,230,0.2);
}

.toggle-switch {
  position: relative;
  width: 42px; height: 24px;
  flex-shrink: 0;
}

.toggle-switch input {
  opacity: 0;
  width: 0; height: 0;
}

.toggle-slider {
  position: absolute;
  inset: 0;
  background: rgba(255,255,255,0.12);
  border-radius: 99px;
  transition: background var(--transition);
  cursor: pointer;
}

.toggle-slider::before {
  content: '';
  position: absolute;
  width: 18px; height: 18px;
  border-radius: 50%;
  background: #fff;
  left: 3px; top: 3px;
  transition: transform var(--transition);
  box-shadow: 0 1px 4px rgba(0,0,0,0.3);
}

.toggle-switch input:checked + .toggle-slider {
  background: linear-gradient(135deg, var(--ocean-teal), var(--ocean-bright));
}

.toggle-switch input:checked + .toggle-slider::before {
  transform: translateX(18px);
}

.anonim-text strong {
  display: block;
  font-size: 0.85rem;
  font-weight: 600;
  color: var(--ocean-white);
  margin-bottom: 3px;
}

.anonim-text p {
  font-size: 0.75rem;
  color: rgba(247,251,252,0.4);
  line-height: 1.5;
}

/* ── Submit Area ── */
.form-submit-area {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1rem;
  margin-top: 2rem;
  padding-top: 1.75rem;
  border-top: 1px solid var(--glass-border);
  flex-wrap: wrap;
}

.submit-note {
  font-size: 0.75rem;
  color: rgba(247,251,252,0.35);
  max-width: 320px;
  line-height: 1.55;
}

.submit-note svg {
  display: inline;
  vertical-align: -2px;
  opacity: 0.5;
  margin-right: 4px;
}

.btn-submit {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 14px 36px;
  background: linear-gradient(135deg, var(--ocean-teal), var(--ocean-bright));
  color: #fff;
  border: none;
  border-radius: var(--radius-sm);
  font-family: var(--font-body);
  font-size: 0.9rem;
  font-weight: 700;
  letter-spacing: 0.04em;
  cursor: pointer;
  transition: all var(--transition);
  box-shadow: 0 4px 24px rgba(26,179,216,0.3);
  position: relative;
  overflow: hidden;
}

.btn-submit::after {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, var(--ocean-bright), var(--ocean-foam));
  opacity: 0;
  transition: opacity var(--transition);
}

.btn-submit:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 32px rgba(26,179,216,0.48);
}

.btn-submit:hover::after { opacity: 1; }

.btn-submit span,
.btn-submit svg { position: relative; z-index: 1; }

.btn-submit:disabled {
  opacity: 0.6;
  cursor: not-allowed;
  transform: none;
}

/* ── Success Banner ── */
.success-pengaduan {
  background: rgba(46,160,97,0.12);
  border: 1px solid rgba(46,160,97,0.3);
  border-radius: var(--radius-md);
  padding: 1.5rem 1.75rem;
  margin-bottom: 2rem;
  display: flex;
  gap: 14px;
  align-items: flex-start;
}

.success-pengaduan-icon {
  width: 42px; height: 42px;
  border-radius: 10px;
  background: rgba(46,160,97,0.2);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.success-pengaduan-title {
  font-size: 0.95rem;
  font-weight: 700;
  color: #6ee09a;
  margin-bottom: 4px;
}

.success-pengaduan-body {
  font-size: 0.82rem;
  color: rgba(110,224,154,0.75);
  line-height: 1.6;
}

/* ── Tracking Section ── */
.tracking-section {
  background: linear-gradient(180deg, var(--ocean-deep) 0%, var(--ocean-mid) 100%);
  padding: 5rem 2rem;
  border-top: 1px solid var(--glass-border);
  position: relative;
  overflow: hidden;
}

.tracking-section::before {
  content: '';
  position: absolute;
  top: -40%; right: -10%;
  width: 500px; height: 500px;
  background: radial-gradient(circle, rgba(26,179,216,0.06), transparent 65%);
  pointer-events: none;
}

.tracking-wrap {
  max-width: 700px;
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

.tracking-header {
  text-align: center;
  margin-bottom: 2.5rem;
}

.tracking-form-card {
  background: var(--glass-bg);
  border: 1px solid var(--glass-border);
  border-radius: var(--radius-lg);
  padding: 2.5rem;
  backdrop-filter: blur(16px);
}

.tracking-form-title {
  font-family: var(--font-display);
  font-size: 1.15rem;
  font-weight: 600;
  margin-bottom: 1.5rem;
  display: flex;
  align-items: center;
  gap: 10px;
}

.tracking-form-title svg { color: var(--ocean-bright); }

/* ── Result Card ── */
.result-card {
  margin-top: 2rem;
  background: rgba(255,255,255,0.03);
  border: 1px solid var(--glass-border);
  border-radius: var(--radius-md);
  overflow: hidden;
}

.result-header {
  padding: 1.25rem 1.5rem;
  border-bottom: 1px solid var(--glass-border);
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1rem;
  flex-wrap: wrap;
}

.result-tiket {
  font-family: var(--font-display);
  font-size: 1.1rem;
  font-weight: 700;
  color: var(--ocean-foam);
}

.status-badge {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 5px 14px;
  border-radius: 99px;
  font-size: 0.72rem;
  font-weight: 700;
  letter-spacing: 0.1em;
  text-transform: uppercase;
}

.status-diterima    { background: rgba(26,179,216,0.15);  border: 1px solid rgba(26,179,216,0.3);  color: var(--ocean-bright); }
.status-diverifikasi{ background: rgba(212,168,83,0.15);  border: 1px solid rgba(212,168,83,0.3);  color: var(--ocean-gold); }
.status-diproses    { background: rgba(94,231,247,0.12);  border: 1px solid rgba(94,231,247,0.25); color: var(--ocean-foam); }
.status-selesai     { background: rgba(46,160,97,0.15);   border: 1px solid rgba(46,160,97,0.3);   color: #6ee09a; }
.status-ditolak     { background: rgba(224,92,58,0.15);   border: 1px solid rgba(224,92,58,0.3);   color: var(--ocean-coral); }

.status-dot {
  width: 7px; height: 7px;
  border-radius: 50%;
  background: currentColor;
  animation: pulse 1.8s ease-in-out infinite;
}

.result-body { padding: 1.5rem; }

.result-meta-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 14px;
  margin-bottom: 1.5rem;
}

.result-meta-item {}

.result-meta-label {
  font-size: 0.68rem;
  font-weight: 700;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--ocean-bright);
  margin-bottom: 4px;
}

.result-meta-value {
  font-size: 0.88rem;
  color: rgba(247,251,252,0.8);
  line-height: 1.4;
}

/* ── Progress Tracker ── */
.progress-tracker {
  margin: 1.5rem 0;
  padding: 1.25rem;
  background: rgba(255,255,255,0.03);
  border-radius: var(--radius-sm);
  border: 1px solid var(--glass-border);
}

.progress-tracker-label {
  font-size: 0.7rem;
  font-weight: 700;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  color: rgba(247,251,252,0.4);
  margin-bottom: 1rem;
}

.progress-steps {
  display: flex;
  align-items: center;
  gap: 0;
}

.progress-step {
  display: flex;
  flex-direction: column;
  align-items: center;
  flex: 1;
  position: relative;
}

.progress-step:not(:last-child)::after {
  content: '';
  position: absolute;
  left: 50%;
  top: 14px;
  width: 100%;
  height: 2px;
  background: var(--glass-border);
  z-index: 0;
  transition: background 0.4s ease;
}

.progress-step.done:not(:last-child)::after {
  background: linear-gradient(90deg, var(--ocean-teal), var(--ocean-bright));
}

.progress-node {
  width: 28px; height: 28px;
  border-radius: 50%;
  border: 2px solid var(--glass-border);
  background: var(--ocean-deep);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.62rem;
  font-weight: 700;
  color: rgba(247,251,252,0.3);
  position: relative;
  z-index: 1;
  transition: all 0.3s ease;
}

.progress-step.done .progress-node {
  border-color: var(--ocean-teal);
  background: linear-gradient(135deg, var(--ocean-teal), var(--ocean-bright));
  color: #fff;
}

.progress-step.active .progress-node {
  border-color: var(--ocean-foam);
  box-shadow: 0 0 0 4px rgba(94,231,247,0.2);
  color: var(--ocean-foam);
  background: rgba(94,231,247,0.12);
}

.progress-step-label {
  font-size: 0.63rem;
  color: rgba(247,251,252,0.35);
  margin-top: 7px;
  text-align: center;
  line-height: 1.3;
}

.progress-step.done .progress-step-label,
.progress-step.active .progress-step-label {
  color: rgba(247,251,252,0.7);
}

/* ── Log Timeline ── */
.log-timeline {
  margin-top: 1.25rem;
}

.log-timeline-title {
  font-size: 0.72rem;
  font-weight: 700;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  color: rgba(247,251,252,0.35);
  margin-bottom: 1rem;
}

.log-item {
  display: flex;
  gap: 12px;
  position: relative;
}

.log-item:not(:last-child)::before {
  content: '';
  position: absolute;
  left: 11px;
  top: 26px;
  bottom: 0;
  width: 1px;
  background: var(--glass-border);
}

.log-dot {
  width: 22px; height: 22px;
  border-radius: 50%;
  background: rgba(26,179,216,0.2);
  border: 1px solid rgba(26,179,216,0.3);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  margin-top: 1px;
}

.log-dot svg { width: 10px; height: 10px; color: var(--ocean-bright); }

.log-content {
  padding-bottom: 1.1rem;
}

.log-meta {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
  margin-bottom: 3px;
}

.log-status {
  font-size: 0.75rem;
  font-weight: 700;
  color: var(--ocean-foam);
}

.log-time {
  font-size: 0.7rem;
  color: rgba(247,251,252,0.3);
}

.log-keterangan {
  font-size: 0.78rem;
  color: rgba(247,251,252,0.55);
  line-height: 1.5;
}

/* ── Error Notice ── */
.tracking-error {
  background: rgba(224,92,58,0.1);
  border: 1px solid rgba(224,92,58,0.25);
  border-radius: var(--radius-sm);
  padding: 1rem 1.25rem;
  margin-top: 1.25rem;
  font-size: 0.85rem;
  color: #f5956e;
  display: flex;
  align-items: flex-start;
  gap: 10px;
}

.tracking-error svg { flex-shrink: 0; margin-top: 1px; }

/* ── Responsive ── */
@media (max-width: 900px) {
  .pengaduan-layout {
    grid-template-columns: 1fr;
  }
  .sidebar-info {
    position: static;
    flex-direction: row;
    flex-wrap: wrap;
  }
  .sidebar-info > * { flex: 1; min-width: 240px; }
}

@media (max-width: 600px) {
  .form-row { grid-template-columns: 1fr; }
  .form-card { padding: 1.5rem; }
  .tracking-form-card { padding: 1.5rem; }
  .result-meta-grid { grid-template-columns: 1fr; }
  .form-submit-area { flex-direction: column; align-items: stretch; }
  .btn-submit { justify-content: center; }
  .sidebar-info { flex-direction: column; }
}
</style>
@endpush

@section('content')

{{-- ══════════════════════════
     PAGE HEADER
══════════════════════════ --}}
<section class="pengaduan-header">
  <div class="header-icon-wrap">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
      <path d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
    </svg>
  </div>
  <div class="header-eyebrow">Pusat Pengaduan</div>
  <h1 class="header-title">Sampaikan <em>Laporan</em> Anda</h1>
  <p class="header-desc">
    POSSI Bali berkomitmen menangani setiap pengaduan dengan serius dan transparan.
    Identitas Anda terjaga sepenuhnya.
  </p>
</section>

{{-- ══════════════════════════
     FORM PENGADUAN
══════════════════════════ --}}
<section class="pengaduan-body">
  <div class="pengaduan-layout">

    {{-- Sidebar --}}
    <aside class="sidebar-info fade-in-left">

      {{-- Alur Proses --}}
      <div class="info-card">
        <div class="info-card-title">
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
            <circle cx="8" cy="8" r="6.5" stroke="currentColor" stroke-width="1.4"/>
            <path d="M8 5v4l2.5 2" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
          </svg>
          Alur Penanganan
        </div>
        <div class="info-steps">
          <div class="info-step">
            <div class="step-dot">1</div>
            <div class="step-content">
              <strong>Diterima</strong>
              <p>Pengaduan masuk dan nomor tiket diterbitkan otomatis.</p>
            </div>
          </div>
          <div class="info-step">
            <div class="step-dot">2</div>
            <div class="step-content">
              <strong>Diverifikasi</strong>
              <p>Tim kami memverifikasi kelengkapan laporan dalam 1×24 jam.</p>
            </div>
          </div>
          <div class="info-step">
            <div class="step-dot">3</div>
            <div class="step-content">
              <strong>Diproses</strong>
              <p>Penanganan aktif oleh petugas yang ditunjuk.</p>
            </div>
          </div>
          <div class="info-step">
            <div class="step-dot">4</div>
            <div class="step-content">
              <strong>Selesai</strong>
              <p>Respons resmi dikirimkan ke email pelapor.</p>
            </div>
          </div>
        </div>
      </div>

      {{-- Kategori --}}
      <div class="info-card">
        <div class="info-card-title">
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
            <rect x="1.5" y="1.5" width="5" height="5" rx="1" stroke="currentColor" stroke-width="1.4"/>
            <rect x="9.5" y="1.5" width="5" height="5" rx="1" stroke="currentColor" stroke-width="1.4"/>
            <rect x="1.5" y="9.5" width="5" height="5" rx="1" stroke="currentColor" stroke-width="1.4"/>
            <rect x="9.5" y="9.5" width="5" height="5" rx="1" stroke="currentColor" stroke-width="1.4"/>
          </svg>
          Kategori Pengaduan
        </div>
        <div class="kategori-list">
          <div class="kategori-item"><div class="kategori-dot"></div>Perilaku tidak profesional</div>
          <div class="kategori-item"><div class="kategori-dot"></div>Masalah administrasi</div>
          <div class="kategori-item"><div class="kategori-dot"></div>Fasilitas & sarana</div>
          <div class="kategori-item"><div class="kategori-dot"></div>Keselamatan selam</div>
          <div class="kategori-item"><div class="kategori-dot"></div>Lainnya</div>
        </div>
      </div>

      {{-- Tracking shortcut --}}
      <div class="tracking-link-wrap">
        <p>Sudah pernah melapor? Pantau perkembangan pengaduan Anda di sini.</p>
        <a href="#tracking" class="btn-tracking">
          <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
            <circle cx="8" cy="8" r="6.5" stroke="currentColor" stroke-width="1.4"/>
            <path d="M5.5 8h5M8 5.5l2.5 2.5L8 10.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Lacak Status
        </a>
      </div>

    </aside>

    {{-- Main Form --}}
    <div class="fade-in-up">

      {{-- Success Banner --}}
      @if(session('success_pengaduan'))
        <div class="success-pengaduan">
          <div class="success-pengaduan-icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
              <circle cx="10" cy="10" r="8.5" stroke="#6ee09a" stroke-width="1.5"/>
              <path d="M6.5 10l2.5 2.5 4.5-4.5" stroke="#6ee09a" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <div>
            <div class="success-pengaduan-title">Pengaduan Berhasil Dikirim</div>
            <div class="success-pengaduan-body">{!! session('success_pengaduan') !!}</div>
          </div>
        </div>
      @endif

      <div class="form-card">
        <div class="form-section-title">Form Pengaduan</div>
        <p class="form-section-sub">Semua kolom bertanda <span style="color:var(--ocean-coral)">*</span> wajib diisi. Data Anda dijaga kerahasiaannya.</p>

        <form method="POST" action="{{ route('pengaduan.send') }}" enctype="multipart/form-data" id="pengaduan-form" novalidate>
          @csrf

          {{-- Data Pelapor --}}
          <div class="form-divider">
            <div class="form-divider-label">Data Pelapor</div>
            <div class="form-divider-line"></div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="nama_pelapor">Nama Lengkap <span class="label-required">*</span></label>
              <input type="text"
                     id="nama_pelapor"
                     name="nama_pelapor"
                     class="form-control @error('nama_pelapor') is-invalid @enderror"
                     placeholder="Nama Anda"
                     value="{{ old('nama_pelapor') }}"
                     maxlength="100"
                     required>
              @error('nama_pelapor')
                <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="email_pelapor">Alamat Email <span class="label-required">*</span></label>
              <input type="email"
                     id="email_pelapor"
                     name="email_pelapor"
                     class="form-control @error('email_pelapor') is-invalid @enderror"
                     placeholder="email@contoh.com"
                     value="{{ old('email_pelapor') }}"
                     maxlength="150"
                     required>
              @error('email_pelapor')
                <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="form-group" style="max-width:280px;">
            <label for="telepon">Nomor Telepon <span style="font-weight:400;text-transform:none;font-size:0.7rem;color:rgba(247,251,252,0.3)">(opsional)</span></label>
            <input type="tel"
                   id="telepon"
                   name="telepon"
                   class="form-control @error('telepon') is-invalid @enderror"
                   placeholder="+62 8xx xxxx xxxx"
                   value="{{ old('telepon') }}"
                   maxlength="20">
            @error('telepon')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>

          {{-- Detail Pengaduan --}}
          <div class="form-divider">
            <div class="form-divider-label">Detail Pengaduan</div>
            <div class="form-divider-line"></div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="kategori">Kategori <span class="label-required">*</span></label>
              <select id="kategori"
                      name="kategori"
                      class="form-control @error('kategori') is-invalid @enderror"
                      required>
                <option value="" disabled {{ old('kategori') ? '' : 'selected' }}>— Pilih kategori —</option>
                <option value="perilaku"      {{ old('kategori') === 'perilaku'      ? 'selected' : '' }}>Perilaku Tidak Profesional</option>
                <option value="administrasi"  {{ old('kategori') === 'administrasi'  ? 'selected' : '' }}>Masalah Administrasi</option>
                <option value="fasilitas"     {{ old('kategori') === 'fasilitas'     ? 'selected' : '' }}>Fasilitas & Sarana</option>
                <option value="keselamatan"   {{ old('kategori') === 'keselamatan'   ? 'selected' : '' }}>Keselamatan Selam</option>
                <option value="lainnya"       {{ old('kategori') === 'lainnya'       ? 'selected' : '' }}>Lainnya</option>
              </select>
              @error('kategori')
                <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="judul">Judul Pengaduan <span class="label-required">*</span></label>
              <input type="text"
                     id="judul"
                     name="judul"
                     class="form-control @error('judul') is-invalid @enderror"
                     placeholder="Ringkasan singkat permasalahan"
                     value="{{ old('judul') }}"
                     maxlength="200"
                     required>
              @error('judul')
                <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="form-group">
            <label for="kronologi">Kronologi Kejadian <span class="label-required">*</span></label>
            <textarea id="kronologi"
                      name="kronologi"
                      class="form-control @error('kronologi') is-invalid @enderror"
                      placeholder="Ceritakan kejadian secara runtut: kapan, di mana, apa yang terjadi, siapa yang terlibat, dan dampaknya. Minimal 50 karakter."
                      maxlength="5000"
                      required>{{ old('kronologi') }}</textarea>
            <div style="display:flex;justify-content:flex-end;font-size:0.7rem;color:rgba(247,251,252,0.3);margin-top:5px;">
              <span id="kronologi-count">0</span>/5000
            </div>
            @error('kronologi')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>

          {{-- Lampiran & Opsi --}}
          <div class="form-divider">
            <div class="form-divider-label">Lampiran & Opsi</div>
            <div class="form-divider-line"></div>
          </div>

          <div class="form-group">
            <label>
              Bukti Pendukung
              <span style="font-weight:400;text-transform:none;font-size:0.7rem;color:rgba(247,251,252,0.3)">(opsional — jpg, png, pdf maks. 5MB)</span>
            </label>
            <div class="file-upload-zone" id="upload-zone">
              <input type="file"
                     name="bukti"
                     id="bukti"
                     accept=".jpg,.jpeg,.png,.pdf"
                     onchange="handleFileSelect(this)">
              <div class="upload-icon">📎</div>
              <p class="upload-text"><strong>Klik untuk pilih file</strong> atau seret ke sini</p>
              <p class="upload-hint">JPG, PNG, PDF — maks 5 MB</p>
            </div>
            <div class="file-selected" id="file-selected">
              <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                <path d="M13 2H3a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z" stroke="currentColor" stroke-width="1.3"/>
                <path d="M5 6h6M5 9h4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
              </svg>
              <span id="file-name"></span>
              <button type="button" class="file-remove" onclick="removeFile()">×</button>
            </div>
            @error('bukti')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label class="anonim-toggle" for="anonim" id="anonim-label">
              <div class="toggle-switch">
                <input type="checkbox"
                       id="anonim"
                       name="anonim"
                       value="1"
                       {{ old('anonim') ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
              </div>
              <div class="anonim-text">
                <strong>Kirim sebagai Anonim</strong>
                <p>Nama Anda tidak akan ditampilkan dalam laporan. Email tetap digunakan untuk konfirmasi dan pembaruan status.</p>
              </div>
            </label>
          </div>

          <div class="form-submit-area">
            <p class="submit-note">
              <svg width="13" height="13" viewBox="0 0 16 16" fill="none">
                <rect x="3" y="7" width="10" height="8" rx="1.5" stroke="currentColor" stroke-width="1.3"/>
                <path d="M5 7V5a3 3 0 0 1 6 0v2" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
              </svg>
              Data Anda dienkripsi dan hanya dapat diakses oleh tim internal POSSI Bali.
            </p>
            <button type="submit" class="btn-submit" id="submit-btn">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path d="M2 8l4 4 8-8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span>Kirim Pengaduan</span>
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>

{{-- ══════════════════════════
     TRACKING SECTION
══════════════════════════ --}}
<section class="tracking-section" id="tracking">
  <div class="tracking-wrap">

    <div class="tracking-header fade-in-up">
      <div class="section-eyebrow">Status Pengaduan</div>
      <h2 class="section-title">Lacak <em>Tiket</em> Anda</h2>
      <p class="section-desc">Masukkan nomor tiket dan email yang Anda gunakan saat melapor.</p>
    </div>

    <div class="tracking-form-card fade-in-up delay-1">
      <div class="tracking-form-title">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
          <circle cx="9" cy="9" r="7.5" stroke="currentColor" stroke-width="1.4"/>
          <path d="M9 5.5v4l2.5 1.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
        </svg>
        Cari Status Pengaduan
      </div>

      <form method="GET" action="{{ route('pengaduan.tracking') }}" id="tracking-form">
    @csrf
    <div class="form-row">
        <div class="form-group">
            <label for="nomor_tiket">Nomor Tiket <span class="label-required">*</span></label>
            <input type="text"
                   id="nomor_tiket"
                   name="nomor_tiket"
                   class="form-control"
                   placeholder="ADU-YYYYMMDD-XXXXX"
                   value="{{ old('nomor_tiket', session('tracking_result')?->nomor_tiket ?? session('_old_input.nomor_tiket')) }}"
                   style="text-transform:uppercase;letter-spacing:0.04em;"
                   required>
        </div>
        <div class="form-group">
            <label for="email_tracking">Email Pelapor <span class="label-required">*</span></label>
            <input type="email"
                   id="email_tracking"
                   name="email_pelapor"
                   class="form-control"
                   placeholder="email@contoh.com"
                   value="{{ old('email_pelapor', session('tracking_result')?->email_pelapor ?? session('_old_input.email_pelapor')) }}"
                   required>
        </div>
    </div>
    <div style="text-align:right;">
        <button type="submit" class="btn-submit" style="width:100%;">
            <svg width="15" height="15" viewBox="0 0 16 16" fill="none">
                <circle cx="7" cy="7" r="5.5" stroke="currentColor" stroke-width="1.5"/>
                <path d="M11 11l3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            <span>Cek Status</span>
        </button>
    </div>
</form>

      {{-- Error --}}
      @if(isset($error) && $error)
        <div class="tracking-error">
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
            <circle cx="8" cy="8" r="6.5" stroke="currentColor" stroke-width="1.4"/>
            <path d="M8 5v3.5M8 10.5v.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
          </svg>
          {{ $error }}
        </div>
      @endif

      {{-- Result --}}
      @if(isset($pengaduan) && $pengaduan)
        @php
          $steps  = \App\Models\Pengaduan::STATUS_STEPS;
          $curIdx = array_search($pengaduan->status, $steps);
          $stepLabels = ['Diterima','Diverifikasi','Diproses','Selesai'];
        @endphp

        <div class="result-card">
          <div class="result-header">
            <div class="result-tiket">{{ $pengaduan->nomor_tiket }}</div>
            <div class="status-badge status-{{ $pengaduan->status }}">
              <div class="status-dot"></div>
              {{ $pengaduan->status_label }}
            </div>
          </div>

          <div class="result-body">
            {{-- Progress Tracker --}}
            @if($pengaduan->status !== 'ditolak')
              <div class="progress-tracker">
                <div class="progress-tracker-label">Progres Penanganan</div>
                <div class="progress-steps">
                  @foreach($steps as $i => $step)
                    <div class="progress-step
                      {{ $curIdx !== false && $i < $curIdx ? 'done' : '' }}
                      {{ $curIdx !== false && $i === $curIdx ? 'active' : '' }}">
                      <div class="progress-node">
                        @if($curIdx !== false && $i < $curIdx)
                          <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
                            <path d="M2 5l2.5 2.5 3.5-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                          </svg>
                        @else
                          {{ $i + 1 }}
                        @endif
                      </div>
                      <div class="progress-step-label">{{ $stepLabels[$i] }}</div>
                    </div>
                  @endforeach
                </div>
              </div>
            @endif

            {{-- Meta Info --}}
            <div class="result-meta-grid">
              <div class="result-meta-item">
                <div class="result-meta-label">Kategori</div>
                <div class="result-meta-value">{{ ucfirst($pengaduan->kategori) }}</div>
              </div>
              <div class="result-meta-item">
                <div class="result-meta-label">Dilaporkan</div>
                <div class="result-meta-value">{{ $pengaduan->created_at->timezone('Asia/Makassar')->format('d M Y, H:i') }} WITA</div>
              </div>
              <div class="result-meta-item" style="grid-column: 1 / -1;">
                <div class="result-meta-label">Judul</div>
                <div class="result-meta-value">{{ $pengaduan->judul }}</div>
              </div>
              @if($pengaduan->catatan_admin)
                <div class="result-meta-item" style="grid-column: 1 / -1;">
                  <div class="result-meta-label">Catatan dari Tim POSSI</div>
                  <div class="result-meta-value">{{ $pengaduan->catatan_admin }}</div>
                </div>
              @endif
            </div>

            {{-- Log Timeline --}}
            @if($pengaduan->logs && $pengaduan->logs->count())
              <div class="log-timeline">
                <div class="log-timeline-title">Riwayat Aktivitas</div>
                @foreach($pengaduan->logs as $log)
                  <div class="log-item">
                    <div class="log-dot">
                      <svg viewBox="0 0 10 10" fill="none">
                        <circle cx="5" cy="5" r="3" fill="currentColor"/>
                      </svg>
                    </div>
                    <div class="log-content">
                      <div class="log-meta">
                        <span class="log-status">{{ \App\Models\Pengaduan::STATUS_LABELS[$log->status_baru] ?? $log->status_baru }}</span>
                        <span class="log-time">{{ $log->created_at->timezone('Asia/Makassar')->format('d M Y, H:i') }} WITA</span>
                      </div>
                      @if($log->keterangan)
                        <p class="log-keterangan">{{ $log->keterangan }}</p>
                      @endif
                    </div>
                  </div>
                @endforeach
              </div>
            @endif

          </div>
        </div>
      @endif

    </div>
  </div>
</section>

@endsection

@push('scripts')
<script>
/* ── File Upload ── */
function handleFileSelect(input) {
  const file = input.files[0];
  if (!file) return;
  const el   = document.getElementById('file-selected');
  const name = document.getElementById('file-name');
  name.textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
  el.classList.add('visible');
}

function removeFile() {
  document.getElementById('bukti').value = '';
  document.getElementById('file-selected').classList.remove('visible');
}

/* ── Drag & Drop ── */
const zone = document.getElementById('upload-zone');
if (zone) {
  zone.addEventListener('dragover',  (e) => { e.preventDefault(); zone.classList.add('dragover'); });
  zone.addEventListener('dragleave', ()  => zone.classList.remove('dragover'));
  zone.addEventListener('drop', (e) => {
    e.preventDefault();
    zone.classList.remove('dragover');
    const dt    = e.dataTransfer;
    const input = document.getElementById('bukti');
    if (dt.files.length) {
      input.files = dt.files;
      handleFileSelect(input);
    }
  });
}

/* ── Kronologi counter ── */
const kronologi = document.getElementById('kronologi');
const counter   = document.getElementById('kronologi-count');
if (kronologi && counter) {
  const update = () => counter.textContent = kronologi.value.length;
  kronologi.addEventListener('input', update);
  update();
}

/* ── Uppercase ticket input ── */
const tiketInput = document.getElementById('nomor_tiket');
if (tiketInput) {
  tiketInput.addEventListener('input', () => {
    const pos = tiketInput.selectionStart;
    tiketInput.value = tiketInput.value.toUpperCase();
    tiketInput.setSelectionRange(pos, pos);
  });
}

/* ── Submit loading state ── */
const pengaduanForm = document.getElementById('pengaduan-form');
const submitBtn     = document.getElementById('submit-btn');
if (pengaduanForm && submitBtn) {
  pengaduanForm.addEventListener('submit', () => {
    submitBtn.disabled = true;
    submitBtn.innerHTML = `
      <svg width="16" height="16" viewBox="0 0 16 16" fill="none" style="animation:spin 0.8s linear infinite">
        <circle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="1.8" stroke-dasharray="12 20"/>
      </svg>
      <span>Mengirim…</span>`;
  });
}

/* ── Smooth scroll to tracking ── */
document.querySelector('.btn-tracking')?.addEventListener('click', (e) => {
  e.preventDefault();
  document.getElementById('tracking')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
});

const trackingForm = document.getElementById('tracking-form');
const trackingBtn  = trackingForm?.querySelector('[type="submit"]');
if (trackingForm && trackingBtn) {
  trackingForm.addEventListener('submit', () => {
    trackingBtn.disabled = true;
    trackingBtn.innerHTML = `
      <svg width="15" height="15" viewBox="0 0 16 16" fill="none" style="animation:spin 0.8s linear infinite">
        <circle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="1.5" stroke-dasharray="10 18"/>
      </svg>
      <span>Mencari…</span>`;
  });
}
</script>
<style>
@keyframes spin { to { transform: rotate(360deg); } }
</style>
@endpush