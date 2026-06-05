<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login — POSSI Bali Admin</title>
  <link rel="stylesheet" href="{{ asset('css/possi.css') }}">
  <style>
    .login-page {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background:
        radial-gradient(ellipse 80% 60% at 20% 30%, rgba(14,107,138,.35) 0%, transparent 60%),
        radial-gradient(ellipse 60% 70% at 80% 80%, rgba(26,179,216,.12) 0%, transparent 60%),
        linear-gradient(170deg, var(--ocean-deep) 0%, #060e1c 100%);
      padding: 2rem;
      position: relative;
      overflow: hidden;
    }

    .login-orb {
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
      pointer-events: none;
      animation: floatOrb 9s ease-in-out infinite;
    }
    .login-orb-1 {
      width: 400px; height: 400px;
      background: radial-gradient(circle, rgba(26,179,216,.15), transparent 70%);
      top: -10%; right: -5%;
    }
    .login-orb-2 {
      width: 300px; height: 300px;
      background: radial-gradient(circle, rgba(14,107,138,.2), transparent 70%);
      bottom: -5%; left: 0%;
      animation-delay: -4s;
    }

    .login-card {
      position: relative;
      z-index: 10;
      width: 100%;
      max-width: 440px;
      background: rgba(13, 38, 69, 0.65);
      border: 1px solid rgba(90, 200, 230, 0.18);
      border-radius: 24px;
      padding: 2.5rem;
      backdrop-filter: blur(24px);
      box-shadow: 0 24px 80px rgba(0, 0, 0, 0.5), 0 0 60px rgba(26, 179, 216, 0.08);
      animation: fadeInUp .5s ease forwards;
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(24px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .login-logo {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 2rem;
      justify-content: center;
    }

    .login-logo-img {
      width: 48px; height: 48px;
      border-radius: 12px;
      background: linear-gradient(135deg, var(--ocean-teal), var(--ocean-bright));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
    }

    .login-logo-text {
      text-align: left;
    }

    .login-logo-title {
      font-family: var(--font-display);
      font-size: 1.2rem;
      font-weight: 700;
      line-height: 1;
    }

    .login-logo-sub {
      font-size: .68rem;
      color: var(--ocean-foam);
      letter-spacing: .12em;
      text-transform: uppercase;
      opacity: .75;
    }

    .login-heading {
      text-align: center;
      margin-bottom: 2rem;
    }

    .login-heading h1 {
      font-family: var(--font-display);
      font-size: 1.6rem;
      font-weight: 700;
      margin-bottom: .35rem;
    }

    .login-heading p {
      font-size: .85rem;
      color: rgba(247,251,252,.55);
    }

    .divider {
      height: 1px;
      background: var(--glass-border);
      margin: 1.5rem 0;
    }

    .form-group {
      margin-bottom: 1.1rem;
    }

    .form-label {
      display: block;
      font-size: .76rem;
      font-weight: 600;
      letter-spacing: .07em;
      text-transform: uppercase;
      color: rgba(247,251,252,.65);
      margin-bottom: 7px;
    }

    .input-wrap {
      position: relative;
    }

    .input-icon {
      position: absolute;
      left: 14px; top: 50%;
      transform: translateY(-50%);
      color: var(--text-muted);
      pointer-events: none;
    }

    .form-input {
      width: 100%;
      padding: 11px 14px 11px 42px;
      background: rgba(255,255,255,.05);
      border: 1.5px solid rgba(90,200,230,.15);
      border-radius: 10px;
      color: var(--ocean-white);
      font-family: var(--font-body);
      font-size: .92rem;
      transition: border-color .25s ease, box-shadow .25s ease, background .25s ease;
      outline: none;
    }

    .form-input::placeholder { color: rgba(247,251,252,.3); }

    .form-input:focus {
      border-color: var(--ocean-bright);
      background: rgba(26,179,216,.06);
      box-shadow: 0 0 0 3px rgba(26,179,216,.12);
    }

    .form-input.is-error {
      border-color: var(--ocean-coral);
      box-shadow: 0 0 0 3px rgba(224,92,58,.12);
    }

    .error-msg {
      display: flex;
      align-items: center;
      gap: 6px;
      margin-top: 6px;
      font-size: .76rem;
      color: #f5856e;
    }

    .remember-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 1.5rem;
    }

    .checkbox-label {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: .84rem;
      color: rgba(247,251,252,.65);
      cursor: pointer;
    }

    .checkbox-label input[type="checkbox"] {
      width: 16px; height: 16px;
      accent-color: var(--ocean-bright);
      cursor: pointer;
    }

    .btn-login {
      width: 100%;
      padding: 13px;
      background: linear-gradient(135deg, var(--ocean-teal), var(--ocean-bright));
      border: none;
      border-radius: 10px;
      color: #fff;
      font-family: var(--font-body);
      font-size: .95rem;
      font-weight: 600;
      letter-spacing: .03em;
      cursor: pointer;
      transition: all .25s ease;
      box-shadow: 0 4px 24px rgba(26,179,216,.3);
      position: relative;
      overflow: hidden;
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 32px rgba(26,179,216,.45);
    }

    .btn-login:active {
      transform: translateY(0);
    }

    .btn-login:disabled {
      opacity: .7;
      cursor: not-allowed;
      transform: none;
    }

    .login-footer {
      text-align: center;
      margin-top: 1.5rem;
      font-size: .8rem;
      color: rgba(247,251,252,.4);
    }

    .login-footer a {
      color: var(--ocean-bright);
      transition: color .2s;
    }
    .login-footer a:hover { color: var(--ocean-foam); }

    .alert-login-error {
      background: rgba(224,92,58,.15);
      border: 1px solid rgba(224,92,58,.3);
      border-radius: 10px;
      padding: 12px 16px;
      font-size: .84rem;
      color: #f5856e;
      margin-bottom: 1.25rem;
      display: flex;
      align-items: flex-start;
      gap: 8px;
    }

    .waves-bottom {
      position: fixed;
      bottom: 0; left: 0; right: 0;
      pointer-events: none;
      z-index: 0;
      opacity: .35;
    }
  </style>
</head>
<body>
<div class="login-page">
  <div class="login-orb login-orb-1"></div>
  <div class="login-orb login-orb-2"></div>

  <div class="login-card">
    <!-- Logo -->
    <div class="login-logo">
      <div class="login-logo-img">🤿</div>
      <div class="login-logo-text">
        <div class="login-logo-title">POSSI Bali</div>
        <div class="login-logo-sub">Admin Panel</div>
      </div>
    </div>

    <div class="login-heading">
      <h1>Selamat Datang</h1>
      <p>Masuk ke panel administrator POSSI Bali</p>
    </div>

    <div class="divider"></div>

    <!-- Error alert -->
    @if($errors->any())
    <div class="alert-login-error">
      <svg width="16" height="16" viewBox="0 0 16 16" fill="none" style="flex-shrink:0;margin-top:1px">
        <circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.5"/>
        <path d="M8 4.5v4M8 10.5v.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
      </svg>
      <span>{{ $errors->first() }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="alert-login-error">
      <svg width="16" height="16" viewBox="0 0 16 16" fill="none" style="flex-shrink:0;margin-top:1px">
        <circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.5"/>
        <path d="M8 4.5v4M8 10.5v.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
      </svg>
      <span>{{ session('error') }}</span>
    </div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('login.post') }}" id="loginForm">
      @csrf

      <div class="form-group">
        <label for="email" class="form-label">Email</label>
        <div class="input-wrap">
          <span class="input-icon">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
              <path d="M2 4h12v8H2z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round" opacity=".7"/>
              <path d="M2 4l6 5 6-5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" opacity=".7"/>
            </svg>
          </span>
          <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="admin@possibali.org"
            class="form-input {{ $errors->has('email') ? 'is-error' : '' }}"
            autocomplete="email"
            required
          >
        </div>
        @error('email')
          <div class="error-msg">
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><circle cx="6" cy="6" r="5" stroke="currentColor" stroke-width="1.2"/><path d="M6 3.5v3M6 8v.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <div class="input-wrap">
          <span class="input-icon">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
              <rect x="3" y="7" width="10" height="7" rx="1.5" stroke="currentColor" stroke-width="1.3" opacity=".7"/>
              <path d="M5 7V5a3 3 0 0 1 6 0v2" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" opacity=".7"/>
            </svg>
          </span>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="••••••••"
            class="form-input {{ $errors->has('password') ? 'is-error' : '' }}"
            autocomplete="current-password"
            required
          >
        </div>
        @error('password')
          <div class="error-msg">
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><circle cx="6" cy="6" r="5" stroke="currentColor" stroke-width="1.2"/><path d="M6 3.5v3M6 8v.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="remember-row">
        <label class="checkbox-label">
          <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
          Ingat saya
        </label>
      </div>

      <button type="submit" class="btn-login" id="btnLogin">
        Masuk ke Dashboard
      </button>
    </form>

    <div class="login-footer">
      <a href="{{ url('/') }}">← Kembali ke website</a>
    </div>
  </div>
</div>

<script>
document.getElementById('loginForm').addEventListener('submit', function() {
  const btn = document.getElementById('btnLogin');
  btn.disabled = true;
  btn.textContent = 'Memproses...';
});
</script>
</body>
</html>