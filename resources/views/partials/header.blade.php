  <!-- ===== LIQUID GLASS HEADER (LIGHT MODE) ===== -->
  <header class="lg-header" role="banner">
    <!-- Left: Brand + tag -->
    <div class="lg-brand">
      OWJcode
    </div>

    <!-- Center: Navigation -->
    <nav class="lg-nav" aria-label="Main navigation">
      <a href="#" data-i18n="nav.framework">Framework</a>
      <a href="#" data-i18n="nav.products">Products</a>
      <a href="#" data-i18n="nav.resources">Resources</a>
      <a href="#" data-i18n="nav.events">Events</a>
      <a href="#" data-i18n="nav.docs">Docs</a>
    </nav>

    <!-- Right: 84K + Sign in + Search -->
    <div class="lg-actions">
      <span class="lg-badge">
        <strong>84K</strong> ★
      </span>
       <details class="lang-switcher">
    <summary class="lang-switcher__trigger">
      <span>Lang</span>
      <span class="lang-switcher__chev" aria-hidden="true">▾</span>
    </summary>

    <div class="lang-switcher__panel" role="menu">
      <!-- Active language -->
      <a class="lang-switcher__item active" role="menuitem" href="#" data-lang="en">
        <span class="flag">🇺🇸</span>
        <span class="lang-name"><img src="{{ asset('storage/flags/us.svg') }}" alt="" style="border-radius: 5px;margin-top: 10px;"></span>
      </a>

      <a class="lang-switcher__item" role="menuitem" href="#" data-lang="fa">
        <span class="flag">🇮🇷</span>
        <span class="lang-name"><img src="{{ asset('storage/flags/ir.svg') }}" alt="" style="border-radius: 5px;margin-top: 10px;"></span>
      </a>



      <hr class="lang-switcher__sep">


    </div>
  </details>
      <section class="lg-04" aria-label="Liquid gooey toggle switch">
        <svg width="0" height="0" aria-hidden="true" focusable="false" style="position:absolute">
          <filter id="lg-04-goo"><feGaussianBlur in="SourceGraphic" stdDeviation="6" result="b"/><feColorMatrix in="b" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 20 -9" result="goo"/><feBlend in="SourceGraphic" in2="goo"/></filter>
        </svg>
        <label class="lg-04__switch">
          <input class="lg-04__input" type="checkbox" checked>
          <span class="lg-04__track" aria-hidden="true"><span class="lg-04__goo"><span class="lg-04__blob lg-04__blob--fixed"></span><span class="lg-04__blob lg-04__blob--handle"></span></span></span>
        </label>
      </section>

      <span class="lg-search-icon" aria-label="Search">⌕</span>
    </div>
  </header>
