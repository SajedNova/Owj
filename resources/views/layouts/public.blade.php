<!doctype html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? 'وبلاگ — OWJcode' }}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    /* ===== global reset + base ===== */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    img, svg { max-width: 100%; display: block; }
    .sr-only { position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0,0,0,0); white-space: nowrap; border: 0; }
    html { -webkit-text-size-adjust: 100%; text-size-adjust: 100%; }
    body {
      font-family: 'Vazirmatn', 'Segoe UI', system-ui, -apple-system, sans-serif;
      background: #fafbfe;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      color: #1a1a2e;
      overflow-x: hidden;
    }

    /* ===== LIQUID GLASS HEADER ===== */
    .lg-header {
      position: sticky; top: 0; z-index: 50; width: 100%;
      padding: 10px clamp(16px, 4vw, 64px); min-height: 72px;
      display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; row-gap: 8px; gap: 24px;
      background: color-mix(in oklab, white 70%, transparent);
      backdrop-filter: blur(4px) saturate(180%);
      -webkit-backdrop-filter: blur(4px) saturate(180%);
      border-bottom: 1px solid rgba(0,0,0,0.06);
      box-shadow: 0 4px 30px rgba(0,0,0,0.04);
      transition: all 0.2s;
    }
    .lg-brand { display: flex; align-items: center; gap: 12px; color: #b51c1c; font-weight: 700; font-size: 22px; letter-spacing: -0.3px; white-space: nowrap; }
    .lg-brand small { font-weight: 400; font-size: 13px; color: rgba(0,0,0,0.4); background: rgba(0,0,0,0.04); padding: 4px 12px; border-radius: 100px; border: 1px solid rgba(0,0,0,0.04); }
    .lg-nav { display: flex; gap: 4px; flex-wrap: wrap; justify-content: center; }
    .lg-nav a { color: rgba(0,0,0,0.55); text-decoration: none; font-size: 15px; font-weight: 500; padding: 8px 16px; border-radius: 999px; transition: all 0.2s ease; white-space: nowrap; }
    .lg-nav a:hover { background: rgba(0,0,0,0.04); color: #1a1a2e; }
    .lg-nav a.lg-active { background: #1a1a2e; color: #fff; font-weight: 600; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
    .lg-actions { display: flex; align-items: center; gap: 10px; flex-shrink: 0; }
    .lg-badge { background: rgba(0,0,0,0.03); color: rgba(0,0,0,0.6); font-size: 14px; font-weight: 500; padding: 6px 14px; border-radius: 100px; border: 1px solid rgba(0,0,0,0.04); display: flex; align-items: center; gap: 6px; white-space: nowrap; }
    .lg-badge strong { color: #1a1a2e; font-weight: 600; }
    .lg-search-icon { display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 50%; background: rgba(0,0,0,0.02); color: rgba(0,0,0,0.45); font-size: 18px; transition: 0.2s; cursor: default; border: 1px solid rgba(0,0,0,0.04); }
    .lg-search-icon:hover { background: rgba(0,0,0,0.04); color: #1a1a2e; }

    /* toggle switch (liquid) */
    .lg-04 { --on: oklch(0.56 0.19 23.4); --off: oklch(0.55 0.03 260); display: inline-flex; align-items: center; }
    .lg-04__switch { font-size: 22px; display: inline-flex; align-items: center; gap: .9em; cursor: pointer; color: #eceaf5; }
    .lg-04__input { position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(0 0 0 0); white-space: nowrap; }
    .lg-04__track { position: relative; width: 3.4em; height: 1.7em; border-radius: 999px; background: var(--off); border: 1px solid rgba(255,255,255,.25); box-shadow: inset 0 2px 8px rgba(0,0,0,.45),inset 0 1px 0 rgba(255,255,255,.25); backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); transition: background .35s; }
    .lg-04__goo { position: absolute; inset: 0; filter: url(#lg-04-goo); }
    .lg-04__blob { position: absolute; top: 50%; border-radius: 50%; background: #fff; transform: translateY(-50%); }
    .lg-04__blob--fixed { left: .28em; width: 1.14em; height: 1.14em; opacity: .9; transition: opacity .3s ease .18s; }
    .lg-04__input:checked+.lg-04__track .lg-04__blob--fixed { opacity: 0; }
    .lg-04__blob--handle { left: .28em; width: 1.14em; height: 1.14em; box-shadow: 0 2px 6px rgba(0,0,0,.35); transition: left .4s cubic-bezier(.6,-.4,.4,1.4),transform .4s; }
    .lg-04__input:checked+.lg-04__track { background: var(--on); }
    .lg-04__input:checked+.lg-04__track .lg-04__blob--handle { left: 2.0em; animation: lg-04-stretch .4s ease; }
    .lg-04__input:not(:checked)+.lg-04__track .lg-04__blob--handle { animation: lg-04-stretch .4s ease; }
    @keyframes lg-04-stretch { 0% { transform: translateY(-50%) scaleX(1); } 45% { transform: translateY(-50%) scaleX(1.55); } 100% { transform: translateY(-50%) scaleX(1); } }
    @media (prefers-reduced-motion: reduce) { .lg-04__blob--handle { transition: left .2s; } .lg-04__input:checked+.lg-04__track .lg-04__blob--handle, .lg-04__input:not(:checked)+.lg-04__track .lg-04__blob--handle { animation: none; } }

    /* language switcher (glass) */
    .lang-switcher { position: relative; width: min(100px, 80vw); }
    .lang-switcher__trigger { list-style: none; cursor: pointer; display: flex; align-items: center; justify-content: space-between; font-size: 15px; font-weight: 700; color: #4c4a4a; padding: 13px 18px; border-radius: 14px; border:1px solid rgba(0, 0, 0, 0.04); background: rgb(0 0 0 / 3%); backdrop-filter: blur(16px) saturate(170%); -webkit-backdrop-filter: blur(16px) saturate(170%); transition: background .2s; user-select: none; }
    .lang-switcher__trigger::-webkit-details-marker { display: none; }
    .lang-switcher__trigger:hover { background: color-mix(in oklab, white 20%, transparent); }
    .lang-switcher__chev { transition: transform .3s; font-size: 14px; opacity: 0.7; }
    .lang-switcher[open] .lang-switcher__chev { transform: rotate(180deg); }
    .lang-switcher__panel { position: absolute; left: 0; right: 0; margin-top: 10px; padding: 8px; border-radius: 16px; transform-origin: top center; background: color-mix(in oklab, white 12%, transparent); border: 1px solid rgba(255, 255, 255, .3); box-shadow: inset 0 1px 0 rgba(255, 255, 255, .4), 0 26px 50px -24px rgba(0, 0, 0, .7); backdrop-filter: blur(22px) saturate(180%); -webkit-backdrop-filter: blur(22px) saturate(180%); }
    .lang-switcher[open] .lang-switcher__panel { animation: lang-drop .4s cubic-bezier(.3, 1.3, .5, 1); }
    .lang-switcher__item { display: flex; align-items: center; gap: 10px; text-decoration: none; font-size: 14px; font-weight: 600; color: #484848; padding: 11px 14px; border-radius: 10px; transition: background .18s; cursor: pointer; }
    .lang-switcher__item:hover { background: rgba(255,255,255,.18); }
    .lang-switcher__item .flag { font-size: 20px; line-height: 1; }
    .lang-switcher__item .check { opacity: 0; transition: opacity .2s; font-size: 14px; }
    .lang-switcher__item.active .check { opacity: 1; color: #7c3aed; }
    @keyframes lang-drop { 0% { opacity: 0; transform: translateY(-10px) scaleY(.6); } 60% { opacity: 1; transform: translateY(2px) scaleY(1.05); } 100% { opacity: 1; transform: translateY(0) scaleY(1); } }
    @media (prefers-reduced-motion: reduce) { .lang-switcher[open] .lang-switcher__panel { animation: none; } .lang-switcher__chev { transition: none; } }

    @media (max-width: 1180px) { .lg-header { height: auto; flex-wrap: wrap; padding: 12px 20px; gap: 12px; } .lg-nav { order: 3; width: 100%; justify-content: center; gap: 2px; } }
    @media (max-width: 860px) { .lg-nav a { font-size: 14px; padding: 6px 14px; } .lg-actions { gap: 6px; } .lg-badge { font-size: 12px; padding: 4px 10px; } .lg-search-icon { width: 34px; height: 34px; font-size: 15px; } .lg-brand small { display: none; } }
    @media (max-width: 520px) { .lg-nav a { font-size: 13px; padding: 4px 10px; } .lg-badge { display: none; } .lg-search-icon { width: 32px; height: 32px; font-size: 14px; } }

    /* ===== BLOG LIST ===== */
    .blog-section { flex: 1; padding: 60px clamp(20px, 5vw, 80px) 100px; max-width: 1100px; margin: 0 auto; width: 100%; }
    .blog-header { margin-bottom: 48px; }
    .blog-header h1 { font-size: 38px; font-weight: 800; color: #1a1a2e; letter-spacing: -0.5px; margin-bottom: 8px; text-align: right; }
    .blog-header p { font-size: 18px; color: rgba(0,0,0,0.5); text-align: right; }
    .blog-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 32px; }
    .blog-card {
      background: rgba(255,255,255,0.5); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
      border: 1px solid rgba(255,255,255,0.7); border-radius: 24px; overflow: hidden;
      transition: 0.25s ease; box-shadow: 0 12px 40px -20px rgba(0,0,0,0.08);
      background: color-mix(in oklab, white 80%, transparent);
      text-decoration: none; color: inherit; display: block;
    }
    .blog-card:hover { transform: translateY(-6px); box-shadow: 0 24px 50px -24px rgba(0,0,0,0.2); border-color: rgba(255,255,255,1); }
    .blog-card__img { height: 200px; background: #e6e9f2; position: relative; overflow: hidden; }
    .blog-card__img img { width: 100%; height: 100%; object-fit: cover; }
    .blog-card__cat { position: absolute; top: 14px; right: 14px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; color: #f53003; background: color-mix(in oklab, white 85%, transparent); padding: 5px 14px; border-radius: 999px; backdrop-filter: blur(4px); }
    .blog-card__body { padding: 22px 24px 28px; text-align: right; }
    .blog-card__date { font-size: 13px; color: rgba(0,0,0,0.4); margin-bottom: 8px; }
    .blog-card__body h3 { font-size: 20px; font-weight: 700; color: #1a1a2e; margin-bottom: 10px; line-height: 1.3; }
    .blog-card__body p { font-size: 15px; line-height: 1.6; color: rgba(0,0,0,0.55); }
    .blog-empty { text-align: center; padding: 60px 20px; color: rgba(0,0,0,0.4); font-size: 16px; }
    .blog-pagination { margin-top: 48px; display: flex; justify-content: center; }
    .blog-pagination nav > div { justify-content: center !important; }

    /* ===== SINGLE POST ===== */
    .single-section { flex: 1; padding: 60px clamp(20px, 5vw, 80px) 100px; max-width: 860px; margin: 0 auto; width: 100%; }
    .single-section .back-link { display: inline-block; margin-bottom: 24px; color: #f53003; font-weight: 600; text-decoration: none; }
    .single-section .back-link:hover { text-decoration: underline; }
    .single-header { margin-bottom: 32px; }
    .single-header .meta { display: flex; gap: 20px; font-size: 14px; color: rgba(0,0,0,0.5); margin-bottom: 12px; flex-wrap: wrap; }
    .single-header h1 { font-size: 40px; font-weight: 800; color: #1a1a2e; letter-spacing: -0.02em; line-height: 1.2; text-align: right; }
    .single-hero { border-radius: 28px; overflow: hidden; margin-bottom: 40px; background: #e6e9f2; max-height: 420px; }
    .single-hero img { width: 100%; height: auto; object-fit: cover; }
    .single-content { font-size: 18px; line-height: 1.8; color: #1a1a2e; text-align: right; }
    .single-content p { margin-bottom: 24px; }
    .single-content h2 { font-size: 28px; font-weight: 700; margin: 40px 0 16px; }
    .single-content h3 { font-size: 22px; font-weight: 700; margin: 32px 0 12px; }

    /* ===== CONTACT BOX ===== */
    .ct-wrap { display: grid; grid-template-columns: 1fr 1.2fr; gap: 40px; max-width: 1000px; margin: 60px auto 0; padding: 0 20px; direction: rtl; }
    .ct-info { display: flex; flex-direction: column; gap: 22px; }
    .ct-info-item { display: flex; align-items: flex-start; gap: 14px; }
    .ct-info-item .ic { width: 42px; height: 42px; border-radius: 12px; background: rgba(245,48,3,0.06); color: #f53003; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0; }
    .ct-info-item h4 { font-size: 14.5px; font-weight: 700; color: #1a1a2e; margin-bottom: 3px; }
    .ct-info-item p { font-size: 14px; color: rgba(26,26,46,0.55); }
    .ct-form { background: #fff; border-radius: 24px; padding: 32px; border: 1px solid rgba(26,26,46,0.06); box-shadow: 0 24px 50px -28px rgba(26,26,46,0.25); display: flex; flex-direction: column; gap: 16px; }
    .ct-form .row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .ct-form label { font-size: 13px; font-weight: 600; color: #1a1a2e; margin-bottom: 6px; display: block; }
    .ct-form input, .ct-form textarea { width: 100%; padding: 12px 16px; border-radius: 12px; border: 1px solid rgba(26,26,46,0.1); font-size: 14px; font-family: inherit; background: #fafbfe; color: #1a1a2e; }
    .ct-form textarea { resize: vertical; min-height: 100px; }
    .ct-form button { align-self: flex-start; padding: 13px 30px; border-radius: 100px; background: #f53003; color: #fff; border: none; font-weight: 700; font-size: 14.5px; cursor: pointer; box-shadow: 0 4px 20px rgba(245,48,3,0.25); transition: 0.2s; }
    .ct-form button:hover { background: #d42a02; }
    .ct-alert { padding: 12px 16px; border-radius: 12px; font-size: 13.5px; margin-bottom: 4px; }
    .ct-alert-success { background: #e6f7ec; color: #1c7c3f; }
    .ct-alert-error { background: #fdecea; color: #e5484d; }
    .ct-field-error { color: #e5484d; font-size: 12px; margin-top: 4px; display: block; }
    @media (max-width: 860px) { .ct-wrap { grid-template-columns: 1fr; } .ct-form .row { grid-template-columns: 1fr; } }

    /* ===== FOOTER ===== */
    .site-footer { width: 100%; background: #1a1a2e; color: rgba(255,255,255,0.65); padding: 72px clamp(20px, 12vw, 300px) 0; margin-top: 72px; direction: rtl; }
    .ft-top { display: grid; grid-template-columns: 1.6fr 1fr 1fr 1fr 1.4fr; gap: 40px; padding-bottom: 56px; border-bottom: 1px solid rgba(255,255,255,0.08); }
    .ft-brand .ft-logo { color: #ff6b4a; font-weight: 700; font-size: 22px; letter-spacing: -0.3px; margin-bottom: 14px; }
    .ft-brand p { font-size: 14.5px; line-height: 1.7; color: rgba(255,255,255,0.5); max-width: 320px; margin-bottom: 22px; }
    .ft-social { display: flex; gap: 10px; direction: ltr; justify-content: flex-end; }
    .ft-social a { width: 38px; height: 38px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); transition: 0.2s; }
    .ft-social a:hover { background: #f53003; border-color: #f53003; color: #fff; }
    .ft-social svg { width: 16px; height: 16px; }
    .ft-col h4 { color: #f2f2f7; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 18px; }
    .ft-col ul { list-style: none; display: flex; flex-direction: column; gap: 12px; }
    .ft-col a { color: rgba(255,255,255,0.55); text-decoration: none; font-size: 14.5px; transition: 0.15s; }
    .ft-col a:hover { color: #fff; }
    .ft-newsletter h4 { color: #f2f2f7; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 12px; }
    .ft-newsletter p { font-size: 14px; line-height: 1.6; color: rgba(255,255,255,0.5); margin-bottom: 18px; }
    .ft-nl-form { display: flex; gap: 8px; }
    .ft-nl-form input { flex: 1; min-width: 0; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 11px 14px; color: #fff; font-size: 14px; outline: none; }
    .ft-nl-form input::placeholder { color: rgba(255,255,255,0.35); }
    .ft-nl-form input:focus { border-color: #f53003; }
    .ft-nl-form button { background: #f53003; color: #fff; border: none; border-radius: 10px; padding: 0 18px; font-weight: 600; font-size: 14px; cursor: pointer; white-space: nowrap; transition: 0.2s; flex-shrink: 0; }
    .ft-nl-form button:hover { background: #d42a02; }
    .ft-bottom { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px; padding: 24px 0; font-size: 13.5px; color: rgba(255,255,255,0.4); }
    .ft-legal { display: flex; gap: 22px; flex-wrap: wrap; }
    .ft-legal a { color: rgba(255,255,255,0.4); text-decoration: none; transition: 0.15s; }
    .ft-legal a:hover { color: rgba(255,255,255,0.8); }
    @media (max-width: 1024px) { .ft-top { grid-template-columns: 1fr 1fr; row-gap: 40px; } .ft-brand { grid-column: 1 / -1; } .ft-newsletter { grid-column: 1 / -1; } .ft-nl-form { max-width: 420px; } }
    @media (max-width: 600px) { .site-footer { padding-top: 56px; } .ft-top { grid-template-columns: 1fr; gap: 32px; } .ft-brand p { max-width: 100%; } .ft-bottom { flex-direction: column; align-items: flex-start; } .ft-nl-form { flex-direction: column; } .ft-nl-form button { padding: 12px; } }

    /* ===== DARK MODE ===== */
    body.dark-mode { background: #0f1018; color: #e8e8f0; }
    body.dark-mode .lg-header { background: color-mix(in oklab, #0f1018 70%, transparent); border-bottom-color: rgba(255,255,255,0.08); }
    body.dark-mode .lg-brand { color: #ff6b4a; }
    body.dark-mode .lg-brand small { color: rgba(255,255,255,0.45); background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.06); }
    body.dark-mode .lg-nav a { color: rgba(255,255,255,0.6); }
    body.dark-mode .lg-nav a:hover { background: rgba(255,255,255,0.07); color: #fff; }
    body.dark-mode .lg-nav a.lg-active { background: #fff; color: #0f1018; }
    body.dark-mode .lg-badge, body.dark-mode .lg-search-icon { background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); }
    body.dark-mode .lg-badge strong { color: #fff; }
    body.dark-mode .lang-switcher__trigger { background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.08); color: rgba(255,255,255,0.7); }
    body.dark-mode .lang-switcher__panel { background: #1a1a2e; border-color: rgba(255,255,255,0.1); }
    body.dark-mode .lang-switcher__item { color: #e8e8f0; }
    body.dark-mode .lang-switcher__item:hover { background: rgba(255,255,255,0.06); }
    body.dark-mode .blog-card { background: #1a1a2e; border-color: rgba(255,255,255,0.08); }
    body.dark-mode .blog-card__body h3, body.dark-mode .blog-header h1, body.dark-mode .single-header h1, body.dark-mode .single-content { color: #f2f2f7; }
    body.dark-mode .blog-card__body p, body.dark-mode .blog-header p, body.dark-mode .single-header .meta { color: rgba(232,232,240,0.6); }
    body.dark-mode .ct-form { background: #1a1a2e; border-color: rgba(255,255,255,0.08); }
    body.dark-mode .ct-form input, body.dark-mode .ct-form textarea { background: #0f1018; border-color: rgba(255,255,255,0.1); color: #e8e8f0; }
    body.dark-mode .ct-info-item h4 { color: #f2f2f7; }
    body.dark-mode .ct-info-item p { color: rgba(232,232,240,0.6); }

    @media (max-width: 600px) { .blog-grid { grid-template-columns: 1fr; } .single-header h1 { font-size: 28px; } }
  </style>
  @stack('styles')
</head>
<body>


  @yield('content')

  <div class="ct-wrap" id="contact">
    <div class="ct-info">
      <div class="ct-info-item"><span class="ic">✉</span><div><h4>ایمیل</h4><p>hello@owjcode.com</p></div></div>
      <div class="ct-info-item"><span class="ic">☎</span><div><h4>تلفن</h4><p>+98 21 1234 5678</p></div></div>
      <div class="ct-info-item"><span class="ic">📍</span><div><h4>دفتر</h4><p>خیابان نمونه، پلاک 400</p></div></div>
    </div>

    <form class="ct-form" action="{{ route('contact.store') }}" method="POST">
      @csrf
      @if(session('contact_success'))
        <div class="ct-alert ct-alert-success">{{ session('contact_success') }}</div>
      @endif

      <div class="row">
        <div>
          <label for="ct-name">نام</label>
          <input id="ct-name" name="name" type="text" value="{{ old('name') }}" placeholder="نام شما">
          @error('name') <span class="ct-field-error">{{ $message }}</span> @enderror
        </div>
        <div>
          <label for="ct-email">ایمیل</label>
          <input id="ct-email" name="email" type="email" value="{{ old('email') }}" placeholder="you@company.com">
          @error('email') <span class="ct-field-error">{{ $message }}</span> @enderror
        </div>
      </div>
      <div>
        <label for="ct-msg">پیام</label>
        <textarea id="ct-msg" name="message" placeholder="درباره پروژه‌تان بنویسید...">{{ old('message') }}</textarea>
        @error('message') <span class="ct-field-error">{{ $message }}</span> @enderror
      </div>
      <button type="submit">ارسال پیام</button>
    </form>
  </div>

  <footer class="site-footer" role="contentinfo">
    <div class="ft-top">
      <div class="ft-brand">
        <div class="ft-logo">OWJcode</div>
        <p>ما محصولات دیجیتال را طراحی و توسعه می‌دهیم — از استراتژی و UI تا انتشار و پشتیبانی بلندمدت.</p>
        <div class="ft-social">
          <a href="#" aria-label="X"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.9 2H22l-7.6 8.7L23.3 22h-6.9l-5.4-6.9L4.8 22H1.6l8.1-9.3L1 2h7.1l4.9 6.3L18.9 2zm-1.2 18h1.9L7.4 4H5.4l12.3 16z"/></svg></a>
          <a href="#" aria-label="GitHub"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.58 2 12.2c0 4.5 2.87 8.32 6.84 9.67.5.1.68-.22.68-.49 0-.24-.01-.87-.01-1.71-2.78.62-3.37-1.37-3.37-1.37-.45-1.18-1.11-1.49-1.11-1.49-.91-.64.07-.63.07-.63 1 .07 1.53 1.05 1.53 1.05.89 1.56 2.34 1.11 2.91.85.09-.66.35-1.11.63-1.37-2.22-.26-4.56-1.14-4.56-5.05 0-1.12.39-2.03 1.03-2.75-.1-.26-.45-1.3.1-2.71 0 0 .84-.28 2.75 1.05a9.29 9.29 0 0 1 5 0c1.9-1.33 2.74-1.05 2.74-1.05.56 1.41.21 2.45.1 2.71.65.72 1.03 1.63 1.03 2.75 0 3.92-2.34 4.78-4.57 5.04.36.32.68.94.68 1.9 0 1.37-.01 2.47-.01 2.81 0 .27.18.6.69.49A10.02 10.02 0 0 0 22 12.2C22 6.58 17.52 2 12 2z"/></svg></a>
          <a href="#" aria-label="LinkedIn"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M6.94 5a2 2 0 1 1-4-.02 2 2 0 0 1 4 .02zM7 8.48H3V21h4V8.48zm6.32 0H9.34V21h3.94v-6.57c0-3.66 4.77-3.96 4.77 0V21H22v-7.93c0-6.17-7.06-5.94-8.68-2.91V8.48z"/></svg></a>
        </div>
      </div>
      <div class="ft-col"><h4>شرکت</h4><ul><li><a href="#">درباره ما</a></li><li><a href="#">فرصت‌های شغلی</a></li><li><a href="{{ route('blog.index') }}">وبلاگ</a></li><li><a href="{{ url('/#contact') }}">تماس با ما</a></li></ul></div>
      <div class="ft-col"><h4>خدمات</h4><ul><li><a href="#">استراتژی محصول</a></li><li><a href="#">طراحی UI / UX</a></li><li><a href="#">توسعه وب</a></li><li><a href="#">توسعه موبایل</a></li></ul></div>
      <div class="ft-col"><h4>منابع</h4><ul><li><a href="#">مستندات</a></li><li><a href="#">مطالعات موردی</a></li><li><a href="#">پشتیبانی</a></li><li><a href="#">وضعیت سرویس</a></li></ul></div>
      <div class="ft-newsletter">
        <h4>در جریان باشید</h4>
        <p>یادداشت‌های محصول و مطالعات موردی، گاه‌به‌گاه ارسال می‌شود — بدون اسپم.</p>
        <form class="ft-nl-form" onsubmit="return false;">
          <label for="ft-nl-email" class="sr-only">آدرس ایمیل</label>
          <input id="ft-nl-email" type="email" placeholder="you@company.com">
          <button type="submit">عضویت</button>
        </form>
      </div>
    </div>
    <div class="ft-bottom">
      <p>© {{ now()->format('Y') }} OWJcode. تمامی حقوق محفوظ است.</p>
      <div class="ft-legal"><a href="#">حریم خصوصی</a><a href="#">شرایط استفاده</a><a href="#">کوکی‌ها</a></div>
    </div>
  </footer>

  <script>
    // ===== DARK MODE TOGGLE =====
    (() => {
      const input = document.querySelector('.lg-04__input');
      if (input) {
        function applyMode(){ document.body.classList.toggle('dark-mode', !input.checked); }
        input.addEventListener('change', applyMode);
        applyMode();
      }
    })();
  </script>
  @stack('scripts')
</body>
</html>
