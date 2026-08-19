<!doctype html>
<html lang="en" >
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>OWJcode — Cloud Dashboard</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    /* Reset & Base */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    img, svg { max-width: 100%; display: block; }

    .sr-only {
      position: absolute;
      width: 1px; height: 1px;
      padding: 0; margin: -1px;
      overflow: hidden;
      clip: rect(0,0,0,0);
      white-space: nowrap;
      border: 0;
    }

    html { -webkit-text-size-adjust: 100%; text-size-adjust: 100%; }

    body {
      font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
      background: #fafbfe;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      color: #1a1a2e;
      overflow-x: hidden;
    }

    /* --- Liquid Glass Header (Light) --- */
    .lg-header {
      position: sticky;
      top: 0;
      z-index: 50;
      width: 100%;
      padding: 10px clamp(16px, 4vw, 64px);
      min-height: 72px;
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
      row-gap: 8px;
      gap: 24px;
      background: color-mix(in oklab, white 70%, transparent);
      backdrop-filter: blur(4px) saturate(180%);
      -webkit-backdrop-filter: blur(4px) saturate(180%);
      border-bottom: 1px solid rgba(0, 0, 0, 0.06);
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.04);
      transition: all 0.2s;
    }

    /* Left: Logo + Tag */
    .lg-brand {
      display: flex;
      align-items: center;
      gap: 12px;
      color: #b51c1c;
      font-weight: 700;
      font-size: 22px;
      letter-spacing: -0.3px;
      white-space: nowrap;
    }

    .lg-brand small {
      font-weight: 400;
      font-size: 13px;
      color: rgba(0, 0, 0, 0.4);
      background: rgba(0, 0, 0, 0.04);
      padding: 4px 12px;
      border-radius: 100px;
      letter-spacing: 0.2px;
      border: 1px solid rgba(0, 0, 0, 0.04);
    }

    /* Center: Navigation */
    .lg-nav {
      display: flex;
      gap: 4px;
      flex-wrap: wrap;
      justify-content: center;
    }

    .lg-nav a {
      color: rgba(0, 0, 0, 0.55);
      text-decoration: none;
      font-size: 15px;
      font-weight: 500;
      padding: 8px 16px;
      border-radius: 999px;
      transition: all 0.2s ease;
      white-space: nowrap;
    }

    .lg-nav a:hover {
      background: rgba(0, 0, 0, 0.04);
      color: #1a1a2e;
    }

    .lg-nav a.lg-active {
      background: #1a1a2e;
      color: #fff;
      font-weight: 600;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    /* Right: Actions (like Laravel) */
    .lg-actions {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-shrink: 0;
    }

    .lg-badge {
      background: rgba(0, 0, 0, 0.03);
      color: rgba(0, 0, 0, 0.6);
      font-size: 14px;
      font-weight: 500;
      padding: 6px 14px;
      border-radius: 100px;
      border: 1px solid rgba(0, 0, 0, 0.04);
      display: flex;
      align-items: center;
      gap: 6px;
      white-space: nowrap;
    }

    .lg-badge strong {
      color: #1a1a2e;
      font-weight: 600;
    }

    .lg-btn {
      background: rgba(0, 0, 0, 0.03);
      color: #1a1a2e;
      border: 1px solid rgba(0, 0, 0, 0.06);
      padding: 8px 18px;
      border-radius: 100px;
      font-weight: 600;
      font-size: 14px;
      cursor: default;
      transition: 0.2s;
      white-space: nowrap;
      backdrop-filter: blur(4px);
    }

    .lg-btn-outline {
      background: transparent;
      border-color: rgba(0, 0, 0, 0.1);
      color: rgba(0, 0, 0, 0.65);
    }

    .lg-btn-outline:hover {
      background: rgba(0, 0, 0, 0.03);
    }

    .lg-btn-primary {
      background: #f53003;
      border-color: #f53003;
      color: #fff;
      box-shadow: 0 4px 16px rgba(245, 48, 3, 0.15);
    }

    .lg-btn-primary:hover {
      background: #d42a02;
      border-color: #d42a02;
    }

    /* Search icon (like Laravel docs) */
    .lg-search-icon {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: rgba(0, 0, 0, 0.02);
      color: rgba(0, 0, 0, 0.45);
      font-size: 18px;
      transition: 0.2s;
      cursor: default;
      border: 1px solid rgba(0, 0, 0, 0.04);
    }

    .lg-search-icon:hover {
      background: rgba(0, 0, 0, 0.04);
      color: #1a1a2e;
    }

    /* --- Scrollable content (to show glass effect) --- */
    .content {
      flex: 1;
      padding: 40px clamp(20px, 5vw, 80px) 120px;
      max-width: 1100px;
      margin: 0 auto;
      width: 100%;
      color: #1a1a2e;
    }

    .content h1 {
      font-size: 42px;
      font-weight: 800;
      color: #1a1a2e;
      margin-bottom: 12px;
      letter-spacing: -0.5px;
    }

    .content p {
      font-size: 18px;
      line-height: 1.7;
      max-width: 600px;
      color: rgba(0, 0, 0, 0.55);
      margin-bottom: 40px;
    }

    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 28px;
      margin-top: 20px;
    }

    .card {
      background: rgba(255, 255, 255, 0.5);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border: 1px solid rgba(255, 255, 255, 0.7);
      border-radius: 24px;
      padding: 28px 22px;
      transition: 0.25s ease;
      box-shadow: 0 12px 40px -20px rgba(0, 0, 0, 0.08);
      background: color-mix(in oklab, white 80%, transparent);
    }

    .card:hover {
      background: color-mix(in oklab, white 95%, transparent);
      transform: translateY(-4px);
      border-color: rgba(255, 255, 255, 1);
      box-shadow: 0 20px 40px -16px rgba(0, 0, 0, 0.12);
    }

    .card h3 {
      color: #1a1a2e;
      font-size: 20px;
      margin-bottom: 8px;
    }

    .card p {
      font-size: 15px;
      color: rgba(0, 0, 0, 0.5);
      margin-bottom: 0;
    }

    /* Responsive */
    @media (max-width: 1180px) {
      .lg-header {
        height: auto;
        flex-wrap: wrap;
        padding: 12px 20px;
        gap: 12px;
      }
      .lg-nav {
        order: 3;
        width: 100%;
        justify-content: center;
        gap: 2px;
      }
    }

    @media (max-width: 860px) {
      .lg-nav a {
        font-size: 14px;
        padding: 6px 14px;
      }
      .lg-actions {
        gap: 6px;
      }
      .lg-badge {
        font-size: 12px;
        padding: 4px 10px;
      }
      .lg-btn {
        font-size: 12px;
        padding: 6px 14px;
      }
      .lg-search-icon {
        width: 34px;
        height: 34px;
        font-size: 15px;
      }
      .lg-brand small {
        display: none;
      }
    }

    @media (max-width: 520px) {
      .lg-nav a {
        font-size: 13px;
        padding: 4px 10px;
      }
      .lg-btn {
        font-size: 11px;
        padding: 4px 10px;
      }
      .lg-badge {
        display: none;
      }
      .lg-search-icon {
        width: 32px;
        height: 32px;
        font-size: 14px;
      }
    }



    .lg-04 {
      --on: oklch(0.56 0.19 23.4);
      --off: oklch(0.55 0.03 260);
      font-family: 'Segoe UI',system-ui,sans-serif;
      display: inline-flex;
      align-items: center;
    }

    .lg-04__switch {
      font-size: 22px;
      display: inline-flex;
      align-items: center;
      gap: .9em;
      cursor: pointer;
      color: #eceaf5;
    }

    .lg-04__input {
      position: absolute;
      width: 1px;
      height: 1px;
      overflow: hidden;
      clip: rect(0 0 0 0);
      white-space: nowrap;
    }

    .lg-04__track {
      position: relative;
      width: 3.4em;
      height: 1.7em;
      border-radius: 999px;
      background: var(--off);
      border: 1px solid rgba(255,255,255,.25);
      box-shadow: inset 0 2px 8px rgba(0,0,0,.45),inset 0 1px 0 rgba(255,255,255,.25);
      backdrop-filter: blur(6px);
      -webkit-backdrop-filter: blur(6px);
      transition: background .35s;
    }

    .lg-04__goo {
      position: absolute;
      inset: 0;
      filter: url(#lg-04-goo);
    }

    .lg-04__blob {
      position: absolute;
      top: 50%;
      border-radius: 50%;
      background: #fff;
      transform: translateY(-50%);
    }

    .lg-04__blob--fixed {
      left: .28em;
      width: 1.14em;
      height: 1.14em;
      opacity: .9;
      transition: opacity .3s ease .18s;
    }

    .lg-04__input:checked+.lg-04__track .lg-04__blob--fixed {
      opacity: 0;
    }

    .lg-04__blob--handle {
      left: .28em;
      width: 1.14em;
      height: 1.14em;
      box-shadow: 0 2px 6px rgba(0,0,0,.35);
      transition: left .4s cubic-bezier(.6,-.4,.4,1.4),transform .4s;
    }

    .lg-04__input:checked+.lg-04__track {
      background: var(--on);
    }

    .lg-04__input:checked+.lg-04__track .lg-04__blob--handle {
      left: 2.0em;
      animation: lg-04-stretch .4s ease;
    }

    .lg-04__input:not(:checked)+.lg-04__track .lg-04__blob--handle {
      animation: lg-04-stretch .4s ease;
    }

    .lg-04__input:focus-visible+.lg-04__track {
      outline: 3px solid #fff;
      outline-offset: 3px;
    }

    .lg-04__label {
      font-size: .85em;
      font-weight: 600;
    }

    @keyframes lg-04-stretch {
      0% {
        transform: translateY(-50%) scaleX(1);
      }

      45% {
        transform: translateY(-50%) scaleX(1.55);
      }

      100% {
        transform: translateY(-50%) scaleX(1);
      }
    }

    @media (prefers-reduced-motion: reduce) {
      .lg-04__blob--handle {
        transition: left .2s;
      }

      .lg-04__input:checked+.lg-04__track .lg-04__blob--handle,
      .lg-04__input:not(:checked)+.lg-04__track .lg-04__blob--handle {
        animation: none;
      }
    }

    .lg-09,
    .lg-09 *,
    .lg-09 *::before,
    .lg-09 *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    .lg-09 {
      font-family: 'Segoe UI',system-ui,sans-serif;
      position: relative;
      width: 100%;
      min-height: 100vh;
      display: flex;
      align-items: flex-start;
      justify-content: center;
      padding: 120px 20px;
      overflow: hidden;
    }

    .lg-09__bg {
      position: absolute;
      inset: -40px;
      filter: blur(60px);
      opacity: .7;
      pointer-events: none;
    }

    .lg-09__dd {
      position: relative;
      z-index: 90;
      width: min(240px,80vw);
    }

    .lg-09__trigger {
      list-style: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 15px;
      font-weight: 700;
      color: #fff;
      padding: 13px 18px;
      border-radius: 14px;
      border: 1px solid rgba(255,255,255,.35);
      background: color-mix(in oklab,white 14%,transparent);
      box-shadow: inset 0 1px 0 rgba(255,255,255,.5),0 12px 26px -16px rgba(0,0,0,.6);
      backdrop-filter: blur(16px) saturate(170%);
      -webkit-backdrop-filter: blur(16px) saturate(170%);
      transition: background .2s;
    }

    .lg-09__trigger::-webkit-details-marker {
      display: none;
    }

    .lg-09__trigger:hover {
      background: color-mix(in oklab,white 20%,transparent);
    }

    .lg-09__dd[open] .lg-09__trigger:focus-visible,
    .lg-09__trigger:focus-visible {
      outline: 3px solid #fff;
      outline-offset: 3px;
    }

    .lg-09__chev {
      transition: transform .3s;
    }

    .lg-09__dd[open] .lg-09__chev {
      transform: rotate(180deg);
    }


    .lg-09__dd[open] .lg-09__panel {
      animation: lg-09-drop .4s cubic-bezier(.3,1.3,.5,1);
    }

    .lg-09__item {
      display: block;
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      color: #fff;
      padding: 11px 14px;
      border-radius: 10px;
      transition: background .18s;
    }

    .lg-09__item:hover {
      background: rgba(255,255,255,.18);
    }

    .lg-09__item:focus-visible {
      outline: 2px solid #fff;
      outline-offset: -2px;
    }

    .lg-09__sep {
      border: none;
      border-top: 1px solid rgba(255,255,255,.18);
      margin: 6px 8px;
    }

    @keyframes lg-09-drop {
      0% {
        opacity: 0;
        transform: translateY(-10px) scaleY(.6);
      }

      60% {
        opacity: 1;
        transform: translateY(2px) scaleY(1.05);
      }

      100% {
        opacity: 1;
        transform: translateY(0) scaleY(1);
      }
    }
    .lg-09__panel {
      position: absolute;
      left: 0;
      right: 0;
      margin-top: 10px;
      padding: 8px;
      border-radius: 16px;
      transform-origin: top center;
      background: color-mix(in oklab,white 12%,transparent);
      border: 1px solid rgba(255,255,255,.3);
      box-shadow: inset 0 1px 0 rgba(255,255,255,.4),0 26px 50px -24px rgba(0,0,0,.7);
      backdrop-filter: blur(22px) saturate(180%);
      -webkit-backdrop-filter: blur(22px) saturate(180%);
      z-index: 1000;
    }

    @media (prefers-reduced-motion: reduce) {
      .lg-09__dd[open] .lg-09__panel {
        animation: none;
      }

      .lg-09__chev {
        transition: none;
      }
    }

     /* ===== Reset & Base ===== */
    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', system-ui, sans-serif;
      min-height: 100vh;
 
     
    }

    /* ===== Language Switcher Container ===== */
    .lang-switcher {
      position: relative;
      width: min(100px, 80vw);
      font-family: 'Segoe UI', system-ui, sans-serif;
    }

    /* ===== Trigger Button (like the dropdown) ===== */
    .lang-switcher__trigger {
      font-family: 'Segoe UI', system-ui, sans-serif;
      list-style: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 15px;
      font-weight: 700;
      color: #4c4a4a;
      padding: 13px 18px;
      border-radius: 14px;
      border:1px solid rgba(0, 0, 0, 0.04);
          background: rgb(0 0 0 / 3%);
      backdrop-filter: blur(16px) saturate(170%);
      -webkit-backdrop-filter: blur(16px) saturate(170%);
      transition: background .2s;
      user-select: none;
    }

    .lang-switcher__trigger::-webkit-details-marker {
      display: none;
    }

    .lang-switcher__trigger:hover {
      background: color-mix(in oklab, white 20%, transparent);
    }

    .lang-switcher__trigger:focus-visible {
      outline: 3px solid #fff;
      outline-offset: 3px;
    }

    .lang-switcher__chev {
      transition: transform .3s;
      font-size: 14px;
      opacity: 0.7;
    }

    .lang-switcher[open] .lang-switcher__chev {
      transform: rotate(180deg);
    }

    /* ===== Dropdown Panel (glass) ===== */
    .lang-switcher__panel {
      position: absolute;
      left: 0;
      right: 0;
      margin-top: 10px;
      padding: 8px;
      border-radius: 16px;
      transform-origin: top center;
      background: color-mix(in oklab, white 12%, transparent);
      border: 1px solid rgba(255, 255, 255, .3);
      box-shadow: inset 0 1px 0 rgba(255, 255, 255, .4), 0 26px 50px -24px rgba(0, 0, 0, .7);
      backdrop-filter: blur(22px) saturate(180%);
      -webkit-backdrop-filter: blur(22px) saturate(180%);
    }

    .lang-switcher[open] .lang-switcher__panel {
      animation: lang-drop .4s cubic-bezier(.3, 1.3, .5, 1);
    }

    /* ===== Language Items ===== */
    .lang-switcher__item {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      color: #484848;
      padding: 11px 14px;
      border-radius: 10px;
      transition: background .18s;
      cursor: pointer;
    }

    .lang-switcher__item:hover {
      background: rgba(255, 255, 255, .18);
    }

    .lang-switcher__item:focus-visible {
      outline: 2px solid #fff;
      outline-offset: -2px;
    }

    .lang-switcher__item .flag {
      font-size: 20px;
      line-height: 1;
    }

    .lang-switcher__item .lang-name {
      flex: 1;
    }

    .lang-switcher__item .check {
      opacity: 0;
      transition: opacity .2s;
      font-size: 14px;
    }

    .lang-switcher__item.active .check {
      opacity: 1;
      color: #7c3aed;
    }

    .lang-switcher__sep {
      border: none;
      border-top: 1px solid rgba(255, 255, 255, .18);
      margin: 6px 8px;
    }

    /* ===== Animation ===== */
    @keyframes lang-drop {
      0% {
        opacity: 0;
        transform: translateY(-10px) scaleY(.6);
      }
      60% {
        opacity: 1;
        transform: translateY(2px) scaleY(1.05);
      }
      100% {
        opacity: 1;
        transform: translateY(0) scaleY(1);
      }
    }

    /* ===== Reduce Motion ===== */
    @media (prefers-reduced-motion: reduce) {
      .lang-switcher[open] .lang-switcher__panel {
        animation: none;
      }
      .lang-switcher__chev {
        transition: none;
      }
    }
      .hero {
      font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;

      width: 100%;
      display: flex;
      align-items: center;
      gap: 60px;
      padding: 40px 300px;
      background: #ffffff;
      border-radius: 32px;
    }

    /* ===== Left Content ===== */
    .hero__content {
      flex: 1;
      text-align: left;
      padding-right: 20px;
      margin-top: 100px;
     
    }

    /* ===== Tagline ===== */
    .hero__tagline {
      font-size: 13px;
      font-weight: 600;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      color: #f53003;
      margin-bottom: 16px;
      display: inline-block;
      padding: 6px 16px;
      border-radius: 100px;
      background: rgba(245, 48, 3, 0.06);
      border: 1px solid rgba(245, 48, 3, 0.08);
    }

    /* ===== Main Heading ===== */
    .hero__title {
      font-size: clamp(32px, 4.5vw, 52px);
      font-weight: 500;
      line-height: 1.12;
      letter-spacing: -0.03em;
      margin-bottom: 20px;
      color: #1a1a2e;
    }

    .hero__title .highlight {
      color: #f53003;
      position: relative;
    }

    .hero__title .highlight::after {
      content: '';
      position: absolute;
      bottom: 2px;
      left: 0;
      right: 0;
      height: 6px;
      background: rgba(245, 48, 3, 0.15);
      border-radius: 4px;
    }

    /* ===== Description ===== */
    .hero__desc {
      font-size: clamp(16px, 1.4vw, 20px);
      font-weight: 400;
      color: rgba(26, 26, 46, 0.65);
      max-width: 520px;
      line-height: 1.7;
      margin-bottom: 32px;
      letter-spacing: -0.01em;
    }

    /* ===== Buttons ===== */
    .hero__actions {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 14px;
       margin-bottom: 150px;
    }

    .hero__btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 14px 32px;
      border-radius: 100px;
      font-size: 16px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.25s ease;
      border: none;
      cursor: pointer;
    }

    .hero__btn--primary {
      background: #f53003;
      color: #fff;
      box-shadow: 0 4px 20px rgba(245, 48, 3, 0.25);
    }

    .hero__btn--primary:hover {
      background: #d42a02;
      transform: translateY(-2px);
      box-shadow: 0 8px 30px rgba(245, 48, 3, 0.35);
    }

    .hero__btn--secondary {
      background: rgba(26, 26, 46, 0.04);
      color: #1a1a2e;
      border: 1px solid rgba(26, 26, 46, 0.08);
    }

    .hero__btn--secondary:hover {
      background: rgba(26, 26, 46, 0.08);
      transform: translateY(-2px);
      border-color: rgba(26, 26, 46, 0.15);
    }

    .hero__btn .arrow {
      transition: transform 0.2s;
      font-size: 18px;
    }

    .hero__btn:hover .arrow {
      transform: translateX(4px);
    }

    /* ===== Bottom Row: Laravel + NIGHTWATCH + Cloud ===== */
    .hero__bottom {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 20px 40px;
      padding-top: 24px;
      border-top: 1px solid rgba(26, 26, 46, 0.06);
    }

    .hero__brand {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .hero__brand .logo {
      font-size: 26px;
      font-weight: 800;
      letter-spacing: -0.03em;
      color: #f53003;
    }

    .hero__brand .logo-sub {
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      color: rgba(26, 26, 46, 0.25);
      padding: 4px 12px;
      border-radius: 100px;
      border: 1px solid rgba(26, 26, 46, 0.06);
    }

    .hero__badge {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      font-weight: 600;
      letter-spacing: 0.3px;
      text-transform: uppercase;
      color: rgba(26, 26, 46, 0.3);
    }

    .hero__badge .pill {
      background: rgba(26, 26, 46, 0.04);
      padding: 4px 14px;
      border-radius: 100px;
      border: 1px solid rgba(26, 26, 46, 0.06);
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.5px;
      color: rgba(26, 26, 46, 0.25);
    }

    .hero__badge .pill strong {
      color: #f53003;
      font-weight: 700;
    }

    .hero__cloud {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 14px;
      font-weight: 500;
      color: rgba(26, 26, 46, 0.3);
    }

    .hero__cloud .cloud-icon {
      font-size: 18px;
    }

    /* ===== Right Image ===== */
    .hero__image {
      flex: 0 0 480px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .hero__image img {
      width: 100%;
      height: auto;
      border-radius: 24px;
      display: block;
      transition: transform 0.3s ease;
    }

    .hero__image img:hover {
      transform: scale(1.02);
    }

    /* ===== Placeholder SVG (if no image) ===== */
    .hero__image .placeholder {
      width: 100%;
      aspect-ratio: 1/1;
      border-radius: 24px;
      background: linear-gradient(135deg, #f5f7fb 0%, #e8ecf3 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 80px;
      color: rgba(26, 26, 46, 0.1);
      border: 2px dashed rgba(26, 26, 46, 0.06);
    }

    /* ===== Responsive ===== */
    @media (max-width: 900px) {
      .hero {
        flex-direction: column;
        gap: 40px;
        padding: 30px 24px;
      }

      .hero__content {
        padding-right: 0;
        text-align: center;
      }

      .hero__desc {
        margin-left: auto;
        margin-right: auto;
      }

      .hero__actions {
        justify-content: center;
      }

      .hero__bottom {
        justify-content: center;
      }

      .hero__image {
        flex: 0 0 auto;
        width: 100%;
        max-width: 400px;
      }
    }

    @media (max-width: 600px) {
      .hero {
        padding: 24px 16px;
        border-radius: 20px;
      }

      .hero__actions {
        flex-direction: column;
        width: 100%;
      }

      .hero__btn {
        width: 100%;
        justify-content: center;
        padding: 14px 24px;
      }

      .hero__bottom {
        flex-direction: column;
        gap: 14px;
      }

      .hero__title {
        font-size: 28px;
      }

      .hero__image {
        max-width: 300px;
      }
    }


    
    /* ===== Main Container with SVG Background ===== */
    .categories-wrapper {
      position: relative;
      width: 100%;
      max-width: 1200px;
      padding: 40px;
      margin-left: 300px;
    }

    /* ===== SVG Background (Liquid Glass) ===== */
    .categories-svg {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      border-radius: 32px;
      overflow: hidden;
      box-shadow: 0 40px 80px -34px rgba(0, 0, 0, 0.8);
      filter: saturate(120%);
      z-index: 1;
    }

    .categories-svg img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    /* ===== Content (on top of SVG) ===== */
    .categories-content {
      background-color:white;
      position: relative;
      z-index: 2;
      padding-left: 300px;
      padding-right: 300px;
    }

    /* ===== Header ===== */
    .categories-header {
      text-align: center;
      margin-bottom: 40px;
    }

    .categories-header .tag {
      display: inline-block;
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      padding: 6px 16px;
      border-radius: 999px;
      background: rgba(255, 255, 255, 0.12);
      border: 1px solid rgba(255, 255, 255, 0.25);
      color: rgba(255, 255, 255, 0.7);
      margin-bottom: 12px;
    }

    .categories-header h2 {
      font-size: clamp(32px, 4vw, 48px);
      font-weight: 650;
      color: #020202;
      letter-spacing: -0.02em;
    }

    .categories-header h2 span {
      color: #f53003;
    }

    .categories-header p {
      color: #ba2200b6;
      font-size: 16px;
      margin-top: 8px;
    }

    /* ===== Cards Grid ===== */
    .categories-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 24px;
    }

    /* ===== Individual Card ===== */
    .category-card {
      position: relative;
      padding: 32px 24px 28px;
      border-radius: 20px;
      text-align: center;
      color: #fff;
      overflow: hidden;
      background: color-mix(in oklab, white 6%, transparent);
      border: 1px solid rgba(255, 255, 255, 0.12);
      backdrop-filter: blur(8px) saturate(150%);
      -webkit-backdrop-filter: blur(8px) saturate(150%);
      transition: all 0.3s ease;
      cursor: default;
    }

    /* ===== Gradient Overlay (Red from bottom, White from top) ===== */
    .category-card::before {
      content: '';
      position: absolute;
      inset: 0;
      border-radius: 20px;
      pointer-events: none;
      background: linear-gradient(
        to bottom,
        rgba(255, 255, 255, 0.15) 0%,
        rgba(255, 255, 255, 0.05) 30%,
        transparent 50%,
        rgba(245, 48, 3, 0.15) 80%,
        rgba(245, 48, 3, 0.25) 100%
      );
      z-index: 0;
    }

    /* ===== Card Content (on top) ===== */
    .category-card * {
      position: relative;
      z-index: 1;
    }

    .category-card:hover {
      transform: translateY(-6px);
      border-color: rgba(255, 255, 255, 0.25);
      background: color-mix(in oklab, white 10%, transparent);
      box-shadow: 0 20px 50px -16px rgba(245, 48, 3, 0.15);
    }

    .category-card .icon {
      font-size: 42px;
      display: block;
      margin-bottom: 14px;
    }

    .category-card h3 {
      font-size: 18px;
      font-weight: 700;
      margin-bottom: 6px;
      color: #fff;
    }

    .category-card p {
      font-size: 14px;
      color: rgba(255, 255, 255, 0.5);
      line-height: 1.5;
    }

    .category-card .count {
      display: inline-block;
      margin-top: 14px;
      font-size: 12px;
      font-weight: 600;
      color: rgba(255, 255, 255, 0.3);
      padding: 4px 14px;
      border-radius: 100px;
      border: 1px solid rgba(255, 255, 255, 0.06);
      background: rgba(255, 255, 255, 0.03);
    }

    .category-card .count strong {
      color: #f53003;
      font-weight: 700;
    }

    /* ===== Responsive ===== */
    @media (max-width: 1024px) {
      .categories-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
      }
    }

    @media (max-width: 600px) {
      .categories-wrapper {
        padding: 20px 12px;
      }

      .categories-content {
        padding: 10px;
      }

      .categories-grid {
        grid-template-columns: 1fr;
        gap: 16px;
      }

      .category-card {
        padding: 28px 20px;
      }

      .categories-header h2 {
        font-size: 28px;
      }
    }

    /* ===== Reduce Motion ===== */
    @media (prefers-reduced-motion: reduce) {
      .category-card {
        transition: none;
      }
      .category-card:hover {
        transform: none;
      }
    }
    .categories-content {
  position: relative;
  z-index: 2;
  padding: 120px clamp(20px, 12vw, 300px);
  border-radius: 3px;
  
  
  /* ===== گرادیانت از پایین به بالا (قرمز → سفید) ===== */
  background: linear-gradient(
    to bottom,
    #ffffff ,
    rgba(237, 236, 236, 0.375) 40%,
    rgba(245, 47, 3, 0.089) 70%,
    rgba(223, 48, 9, 0.075) 100%
  );
  
border-bottom: 1px solid #b51c1c67;
  
}
.category-card {
  position: relative;
  padding: 32px 24px 28px;
  border-radius: 20px;
  text-align: center;
  overflow: hidden;
  
  /* ===== شیشه‌ای خالص ===== */
  background: rgba(255, 255, 255, 0.08);
  backdrop-filter: blur(12px) saturate(180%);
  -webkit-backdrop-filter: blur(12px) saturate(180%);
  
  border: 1px solid rgba(255, 255, 255, 0.15);
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  cursor: default;
}

/* ===== حذف کامل گرادیانت ===== */
.category-card::before {
  display: none;
}

/* ===== هاور شیشه‌ای ===== */
.category-card:hover {
  background: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(16px) saturate(200%);
  -webkit-backdrop-filter: blur(16px) saturate(200%);
  border-color: rgba(255, 255, 255, 0.25);
  transform: translateY(-4px);
  box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
}
.category-card .icon {
  font-size: 42px;
  display: block;
  margin-bottom: 14px;
  color: #fff;
}

.category-card h3 {
  font-size: 18px;
  font-weight: 700;
  margin-bottom: 6px;
  color: #090909;
}

.category-card p {
  font-size: 14px;
  color: #090909;
  line-height: 1.5;
}

.category-card .count {
  display: inline-block;
  margin-top: 14px;
  font-size: 12px;
  font-weight: 600;
  color: rgba(22, 22, 22, 0.778);
  padding: 4px 14px;
  border-radius: 100px;
  border: 1px solid rgba(255, 255, 255, 0.08);
  background: rgba(255, 255, 255, 0.304);
}

.category-card .count strong {
  color: #f53003;
  font-weight: 700;
}

 .logo-strip {
    display: flex;
    align-items: stretch;
    border-top: 1px solid #e5e5e5;
    border-bottom: 1px solid #e5e5e5;
  
  }

  .logo-strip__label {
    flex: 0 0 300px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 20px 30px;
    font-family: 'Courier New', monospace;
    font-size: 15px;
    line-height: 1.5;
    letter-spacing: 0.5px;
    color: #111;
    border-left: 1px solid #e5e5e5;
    text-align: left;
    direction: ltr;
    padding-left: 130px;
  }

  /* ---- Marquee area ---- */
  .logo-strip__marquee {
    flex: 1;
    position: relative;
    overflow: hidden;
    height: 100px;
    /* fade edges so logos appear/disappear smoothly */
    -webkit-mask-image: linear-gradient(to right, transparent 0, #000 60px, #000 calc(100% - 60px), transparent 100%);
    mask-image: linear-gradient(to right, transparent 0, #000 60px, #000 calc(100% - 60px), transparent 100%);
  }

  .logo-strip__track {
    display: flex;
    align-items: center;
    height: 100%;
    width: max-content;
    animation: scroll-left 22s linear infinite;
  }

  .logo-strip__marquee:hover .logo-strip__track {
    animation-play-state: paused;
  }

  .logo-strip__logo {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100px;
    width: 220px;
    flex-shrink: 0;
    border-left: 1px solid #e5e5e5;
    padding: 0 20px;
  }

  .logo-strip__logo img {
    max-width: 190px;
    max-height: 40px;
    object-fit: contain;
  }

  @keyframes scroll-left {
    from { transform: translateX(-50%); }
    to   { transform: translateX(0); } /* track content is duplicated x2, so 50% = one full set */
  }

  @media (max-width: 900px) {
    .logo-strip { flex-wrap: wrap; }
    .logo-strip__label { flex: 1 1 100%; border-left: none; border-bottom: 1px solid #e5e5e5; }
  }

  /* ===== Portfolio (Liquid Glass) ===== */
  .pf-section {
    width: 100%;
    padding: 110px clamp(20px, 12vw, 300px) 130px;
    background: #fafbfe;
  }

  .pf-header {
    text-align: center;
    max-width: 560px;
    margin: 0 auto 48px;
  }

  .pf-header .tag {
    display: inline-block;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    padding: 6px 16px;
    border-radius: 999px;
    color: #f53003;
    background: rgba(245, 48, 3, 0.06);
    border: 1px solid rgba(245, 48, 3, 0.08);
    margin-bottom: 14px;
  }

  .pf-header h2 {
    font-size: clamp(30px, 4vw, 44px);
    font-weight: 650;
    color: #1a1a2e;
    letter-spacing: -0.02em;
  }

  .pf-header h2 span {
    color: #f53003;
  }

  .pf-header p {
    color: rgba(26, 26, 46, 0.55);
    font-size: 16px;
    margin-top: 10px;
    line-height: 1.6;
  }

  .pf-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 26px;
  }

  .pf-card {
    position: relative;
    aspect-ratio: 4 / 3;
    border-radius: 22px;
    overflow: hidden;
    background: #fff;
    border: 1px solid rgba(26, 26, 46, 0.06);
    box-shadow: 0 24px 50px -28px rgba(26, 26, 46, 0.25);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    isolation: isolate;
  }

  .pf-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 30px 60px -26px rgba(26, 26, 46, 0.3);
  }

  .pf-card__warp {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
  }

  .pf-card__tag {
    position: absolute;
    top: 14px;
    left: 14px;
    z-index: 3;
    font-size: 10.5px;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    padding: 5px 12px;
    border-radius: 999px;
    color: #f53003;
    background: color-mix(in oklab, white 82%, transparent);
    border: 1px solid rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(6px) saturate(160%);
    -webkit-backdrop-filter: blur(6px) saturate(160%);
  }

  .pf-card__panel {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 2;
    height: 20%;
    min-height: 76px;
    padding: 12px 18px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 3px;
    background: color-mix(in oklab, white 78%, transparent);
    border-top: 1px solid rgba(255, 255, 255, 0.65);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(14px) saturate(180%);
    -webkit-backdrop-filter: blur(14px) saturate(180%);
  }

  .pf-card__title {
    font-size: 15.5px;
    font-weight: 700;
    color: #1a1a2e;
    letter-spacing: -0.01em;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .pf-card__desc {
    font-size: 12px;
    line-height: 1.4;
    color: rgba(26, 26, 46, 0.55);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  @media (max-width: 1024px) {
    .pf-grid { grid-template-columns: repeat(2, 1fr); }
  }

  @media (max-width: 600px) {
    .pf-section { padding: 70px 18px 90px; }
    .pf-grid { grid-template-columns: 1fr; gap: 18px; }
  }

  @media (prefers-reduced-motion: reduce) {
    .pf-card { transition: none; }
  }

  /* ===== Team Section ===== */
  .tm-section {
    position: relative;
    width: 100%;
    background: #fff;
    overflow: hidden;
  }

  .tm-band {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 300px;
    background: linear-gradient(180deg, rgba(245, 48, 3, 0.08) 0%, rgba(245, 48, 3, 0.03) 100%);
    z-index: 0;
  }

  .tm-header {
    position: relative;
    z-index: 1;
    max-width: 640px;
    margin: 0 auto;
    text-align: center;
    padding: 46px 20px 36px;
  }

  .tm-header .tm-eyebrow {
    display: inline-block;
    font-size: 13px;
    font-weight: 600;
    color: #f53003;
    margin-bottom: 16px;
  }

  .tm-header .tm-title-row {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 16px;
  }

  .tm-header .tm-line {
    flex: 1;
    max-width: 120px;
    border-top: 1px dotted rgba(26, 26, 46, 0.28);
  }

  .tm-header h2 {
    font-size: clamp(19px, 2.4vw, 24px);
    font-weight: 800;
    color: #1a1a2e;
    letter-spacing: -0.01em;
    white-space: nowrap;
  }

  .tm-pennant {
    position: absolute;
    top: -30px;
    right: calc(50% - 10px);
    width: 20px;
    height: 26px;
    background: #f53003;
    opacity: 0.85;
    border-radius: 4px 4px 1px 1px;
    clip-path: polygon(0 0, 100% 0, 100% 68%, 50% 100%, 0 68%);
  }

  .tm-grid {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: flex-end;
    justify-content: center;
    flex-wrap: wrap;
    gap: 22px;
    padding: 90px 20px 60px;
  }

  .tm-card {
    position: relative;
    width: 165px;
    height: 250px;
    flex-shrink: 0;
    overflow: visible;
  }

  .tm-grid > .tm-card:nth-child(even) {
    height: 330px;
  }

  /* photo is taller than the card footprint and bottom-anchored,
     so the head/shoulders rise above the box's top edge */
  .tm-card__photo {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    height: calc(100% + 72px);
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 20px 40px -22px rgba(26, 26, 46, 0.3);
  }

  .tm-card__photo img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top;
    filter: grayscale(1) contrast(1.05);
    transition: filter 0.4s ease, transform 0.4s ease;
  }

  .tm-card:hover .tm-card__photo img {
    filter: grayscale(0);
    transform: scale(1.05);
  }

  .tm-card__photo::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(10, 10, 20, 0.78) 0%, rgba(10, 10, 20, 0) 52%);
  }

  .tm-card__info {
    position: absolute;
    left: 16px;
    right: 16px;
    bottom: 16px;
    z-index: 2;
    text-align: right;
  }

  .tm-card__name {
    font-size: 14.5px;
    font-weight: 700;
    color: #fff;
  }

  .tm-card__role {
    font-size: 12.5px;
    color: rgba(255, 255, 255, 0.85);
    margin-top: 2px;
  }

  .tm-card__bar {
    position: absolute;
    left: 16px;
    bottom: -8px;
    z-index: 2;
    width: 46px;
    height: 6px;
    border-radius: 999px;
    background: #f53003;
    box-shadow: 0 4px 10px -2px rgba(245, 48, 3, 0.5);
  }

  @media (max-width: 900px) {
    .tm-band { height: 220px; }
    .tm-card { width: 130px; height: 200px; }
    .tm-grid > .tm-card:nth-child(even) { height: 260px; }
    .tm-grid { gap: 14px; padding-top: 60px; }
    .tm-card__photo { height: calc(100% + 48px); }
  }

  @media (max-width: 600px) {
    .tm-band { height: 190px; }
    .tm-header .tm-line { display: none; }
    .tm-card { width: 42%; height: 190px; }
    .tm-grid > .tm-card:nth-child(even) { height: 240px; }
    .tm-grid { padding-top: 46px; }
    .tm-card__photo { height: calc(100% + 34px); }
  }

  @media (prefers-reduced-motion: reduce) {
    .tm-card__photo img { transition: none; }
  }

  
    .mar {
      margin-top: 100px;
      background: linear-gradient(to bottom, #ffffff 0px, #f52f0348 450px, white 351px, white 100%);
      position: relative;
      border-top: 1px solid rgb(205, 0, 0)f03b1;
      z-index: -3;
    }

    .team-section1 {
      padding: 150px 0;
      text-align: center;
    }

    .team-section h2 {
      font-size: 28px;
      font-weight: bold;
      color: #333;
      margin-bottom: 40px;
    }

    .slider-wrapper1 {
      /* overflow: hidden; */
      position: relative;
    }

    .slider1 {
      display: flex;
      gap: 30px;
      margin-top: 50px;
      padding: 130px 60px;
      overflow-x: auto;
      scroll-behavior: smooth;
      scroll-snap-type: x mandatory;
      margin: 20px 137px;
    }

    .slider1::-webkit-scrollbar {
      display: none;
    }

    @media (max-width: 900px) {
      .slider1 { margin: 20px 40px; padding: 90px 20px; }
    }

    @media (max-width: 600px) {
      .slider1 { margin: 20px 16px; padding: 60px 12px; gap: 18px; }
    }

    .card1 {
      flex: 0 0 220px;
      height: 246px;
      position: relative;
      border-radius: 16px 16px 20px 20px;
      overflow: visible;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
      background-color: #fff;
      /* transition: transform 0.3s ease; */
      border: 1px solid #ccc;
      scroll-snap-align: start;
      z-index: -2;
    }



    .card1 img {
      width: 100%;
      height: 290px;
      object-fit: cover;
      display: block;
      filter: grayscale(100%);
      position: relative;
      top: -45px;
      /* position: absolute; */
      border-radius: 0px 0px 20px 20px;
    }

    .overlay1 {
      position: absolute;
      bottom: 0;
      width: 100%;
      padding: 15px 10px;
      background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
      color: #fff;
      text-align: center;
      border-radius: 0px 0px 20px 20px;
    }

    .name1 {
      font-weight: bold;
      font-size: 18px;
    }

    .title1 {
      font-size: 14px;
      margin-top: 5px;
      color: #e0e0e0;
    }

    .margin {
      top: -80px;
    }

  /* ================================================================
     NEW SECTIONS — About, Services, Stats, Process, Industries,
     Case Studies, Technologies, Achievements, Articles, Careers, Contact
     (design tokens matched to existing .pf-section / .hero / .card system)
  ================================================================ */

  .nx-section { width: 100%; padding: 100px clamp(20px, 12vw, 300px) 100px; background: #fafbfe; }
  .nx-section--alt { background: #ffffff; }
  .nx-header { text-align: center; max-width: 620px; margin: 0 auto 48px; }
  .nx-header.nx-left { text-align: left; margin: 0 0 40px; }
  .nx-tag {
    display: inline-block; font-size: 12px; font-weight: 700; letter-spacing: 0.1em;
    text-transform: uppercase; padding: 6px 16px; border-radius: 999px;
    color: #f53003; background: rgba(245, 48, 3, 0.06); border: 1px solid rgba(245, 48, 3, 0.08);
    margin-bottom: 14px;
  }
  .nx-header h2 { font-size: clamp(30px, 4vw, 44px); font-weight: 650; color: #1a1a2e; letter-spacing: -0.02em; }
  .nx-header h2 span { color: #f53003; }
  .nx-header p { color: rgba(26, 26, 46, 0.55); font-size: 16px; margin-top: 10px; line-height: 1.6; }

  /* ---- About Us ---- */
  .au-wrap { display: flex; align-items: center; gap: 64px; }
  .au-content { flex: 1; }
  .au-content p { font-size: 16px; line-height: 1.8; color: rgba(26,26,46,0.6); margin-bottom: 20px; max-width: 540px; }
  .au-stats { display: flex; gap: 32px; margin-top: 32px; flex-wrap: wrap; }
  .au-stat { }
  .au-stat strong { display: block; font-size: 30px; font-weight: 800; color: #1a1a2e; letter-spacing: -0.02em; }
  .au-stat strong span { color: #f53003; }
  .au-stat small { font-size: 13px; color: rgba(26,26,46,0.5); }
  .au-visual {
    flex: 0 0 420px; height: 340px; border-radius: 28px;
    background: linear-gradient(135deg, #fff 0%, #f1f3fa 100%);
    border: 1px solid rgba(26,26,46,0.06); box-shadow: 0 24px 50px -28px rgba(26,26,46,0.25);
    display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;
  }
  .au-visual::before {
    content: '✦'; position: absolute; font-size: 220px; color: rgba(245,48,3,0.05); font-weight: 800;
  }
  .au-visual span { position: relative; font-size: 15px; font-weight: 600; color: rgba(26,26,46,0.3); letter-spacing: 0.05em; text-transform: uppercase; }
  @media (max-width: 860px) { .au-wrap { flex-direction: column; } .au-visual { flex: none; width: 100%; } }

  /* ---- Company Statistics (2 boxes) ---- */
  .cs-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 28px; max-width: 900px; margin: 0 auto; }
  .cs-box {
    padding: 48px 36px; border-radius: 26px; text-align: center;
    background: #1a1a2e; color: #fff; position: relative; overflow: hidden;
  }
  .cs-box:nth-child(2) { background: #f53003; }
  .cs-box .num { font-size: clamp(42px, 5vw, 60px); font-weight: 800; letter-spacing: -0.02em; display: block; }
  .cs-box .lbl { font-size: 15px; font-weight: 500; opacity: 0.75; margin-top: 8px; display: block; }
  @media (max-width: 640px) { .cs-grid { grid-template-columns: 1fr; } }

  /* ---- Our Process ---- */
  .op-steps { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; position: relative; }
  .op-steps::before {
    content: ''; position: absolute; top: 26px; left: 12.5%; right: 12.5%; height: 1px;
    background: repeating-linear-gradient(to right, rgba(26,26,46,0.15) 0 8px, transparent 8px 16px);
  }
  .op-step { position: relative; text-align: center; padding: 0 10px; }
  .op-step .op-num {
    width: 52px; height: 52px; margin: 0 auto 20px; border-radius: 50%; background: #fff;
    border: 1px solid rgba(26,26,46,0.08); box-shadow: 0 10px 24px -12px rgba(26,26,46,0.25);
    display: flex; align-items: center; justify-content: center; font-weight: 800; color: #f53003; font-size: 16px;
    position: relative; z-index: 1;
  }
  .op-step h3 { font-size: 17px; font-weight: 700; color: #1a1a2e; margin-bottom: 8px; }
  .op-step p { font-size: 14px; line-height: 1.6; color: rgba(26,26,46,0.55); }
  @media (max-width: 860px) { .op-steps { grid-template-columns: 1fr; gap: 32px; } .op-steps::before { display: none; } }

  /* ---- Industries (small boxes) ---- */
  .ind-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 16px; }
  .ind-box {
    padding: 22px 14px; border-radius: 16px; text-align: center; background: #fff;
    border: 1px solid rgba(26,26,46,0.06); box-shadow: 0 12px 30px -20px rgba(26,26,46,0.2);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .ind-box:hover { transform: translateY(-3px); box-shadow: 0 16px 34px -18px rgba(245,48,3,0.25); }
  .ind-box .ic { font-size: 24px; display: block; margin-bottom: 10px; }
  .ind-box span { font-size: 13px; font-weight: 600; color: #1a1a2e; }
  @media (max-width: 900px) { .ind-grid { grid-template-columns: repeat(3, 1fr); } }
  @media (max-width: 520px) { .ind-grid { grid-template-columns: repeat(2, 1fr); } }

  /* ---- Case Studies ---- */
  .case-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 26px; }
  .case-card {
    border-radius: 24px; overflow: hidden; background: #fff; border: 1px solid rgba(26,26,46,0.06);
    box-shadow: 0 24px 50px -28px rgba(26,26,46,0.25); transition: transform 0.25s ease;
  }
  .case-card:hover { transform: translateY(-5px); }
  .case-card__top { padding: 26px 24px 20px; }
  .case-card__tag {
    display: inline-block; font-size: 11px; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase;
    color: #f53003; background: rgba(245,48,3,0.06); border: 1px solid rgba(245,48,3,0.08);
    padding: 4px 12px; border-radius: 999px; margin-bottom: 14px;
  }
  .case-card__top h3 { font-size: 19px; font-weight: 700; color: #1a1a2e; margin-bottom: 8px; }
  .case-card__top p { font-size: 14px; line-height: 1.6; color: rgba(26,26,46,0.55); }
  .case-card__stats { display: flex; border-top: 1px solid rgba(26,26,46,0.06); }
  .case-card__stats div { flex: 1; padding: 16px 12px; text-align: center; }
  .case-card__stats div:first-child { border-right: 1px solid rgba(26,26,46,0.06); }
  .case-card__stats strong { display: block; font-size: 20px; font-weight: 800; color: #f53003; }
  .case-card__stats small { font-size: 11px; color: rgba(26,26,46,0.5); }
  @media (max-width: 900px) { .case-grid { grid-template-columns: 1fr; } }

  /* ---- Technologies ---- */
  .tech-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 16px; }
  .tech-box {
    aspect-ratio: 1; border-radius: 18px; background: #fff; border: 1px solid rgba(26,26,46,0.06);
    box-shadow: 0 12px 30px -20px rgba(26,26,46,0.2); display: flex; flex-direction: column;
    align-items: center; justify-content: center; gap: 8px; transition: transform 0.2s ease;
  }
  .tech-box:hover { transform: translateY(-4px); }
  .tech-box .ic { font-size: 26px; }
  .tech-box span { font-size: 12.5px; font-weight: 600; color: #1a1a2e; }
  @media (max-width: 900px) { .tech-grid { grid-template-columns: repeat(3, 1fr); } }
  @media (max-width: 520px) { .tech-grid { grid-template-columns: repeat(2, 1fr); } }

  /* ---- Achievements ---- */
  .ach-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }
  .ach-card { padding: 30px 22px; border-radius: 22px; background: #fff; border: 1px solid rgba(26,26,46,0.06);
    box-shadow: 0 20px 40px -24px rgba(26,26,46,0.22); text-align: center; }
  .ach-card .ic { font-size: 30px; margin-bottom: 14px; display: block; }
  .ach-card h3 { font-size: 16px; font-weight: 700; color: #1a1a2e; margin-bottom: 6px; }
  .ach-card p { font-size: 13px; color: rgba(26,26,46,0.5); line-height: 1.5; }
  @media (max-width: 900px) { .ach-grid { grid-template-columns: repeat(2, 1fr); } }

  /* ---- Articles ---- */
  .art-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 26px; }
  .art-card { border-radius: 22px; overflow: hidden; background: #fff; border: 1px solid rgba(26,26,46,0.06);
    box-shadow: 0 20px 40px -24px rgba(26,26,46,0.22); transition: transform 0.25s ease; }
  .art-card:hover { transform: translateY(-5px); }
  .art-card__img { height: 170px; background: linear-gradient(135deg, #f1f3fa, #e6e9f2); position: relative; }
  .art-card__cat {
    position: absolute; top: 14px; left: 14px; font-size: 10.5px; font-weight: 700; text-transform: uppercase;
    letter-spacing: 0.06em; color: #f53003; background: color-mix(in oklab, white 85%, transparent);
    padding: 5px 12px; border-radius: 999px;
  }
  .art-card__body { padding: 20px 22px 24px; }
  .art-card__date { font-size: 12px; color: rgba(26,26,46,0.4); margin-bottom: 8px; }
  .art-card__body h3 { font-size: 17px; font-weight: 700; color: #1a1a2e; margin-bottom: 8px; line-height: 1.4; }
  .art-card__body p { font-size: 13.5px; color: rgba(26,26,46,0.55); line-height: 1.6; }
  @media (max-width: 900px) { .art-grid { grid-template-columns: 1fr; } }

  /* ---- Careers ---- */
  .car-list { display: flex; flex-direction: column; gap: 14px; max-width: 780px; margin: 0 auto; }
  .car-item {
    display: flex; align-items: center; justify-content: space-between; gap: 20px;
    padding: 22px 26px; border-radius: 18px; background: #fff; border: 1px solid rgba(26,26,46,0.06);
    box-shadow: 0 14px 30px -22px rgba(26,26,46,0.2); transition: transform 0.2s ease;
  }
  .car-item:hover { transform: translateX(4px); }
  .car-item__info h3 { font-size: 16.5px; font-weight: 700; color: #1a1a2e; margin-bottom: 6px; }
  .car-item__meta { display: flex; gap: 10px; flex-wrap: wrap; }
  .car-item__meta span {
    font-size: 11.5px; font-weight: 600; color: rgba(26,26,46,0.5); background: rgba(26,26,46,0.04);
    padding: 4px 12px; border-radius: 999px;
  }
  .car-item__btn {
    flex-shrink: 0; padding: 10px 22px; border-radius: 100px; background: rgba(245,48,3,0.06);
    border: 1px solid rgba(245,48,3,0.15); color: #f53003; font-size: 13.5px; font-weight: 700;
    text-decoration: none; white-space: nowrap; transition: 0.2s;
  }
  .car-item__btn:hover { background: #f53003; color: #fff; }
  @media (max-width: 640px) { .car-item { flex-direction: column; align-items: flex-start; } }

  /* ---- Contact ---- */
  .ct-wrap { display: grid; grid-template-columns: 1fr 1.2fr; gap: 40px; max-width: 1000px; margin: 0 auto; }
  .ct-info { display: flex; flex-direction: column; gap: 22px; }
  .ct-info-item { display: flex; align-items: flex-start; gap: 14px; }
  .ct-info-item .ic {
    width: 42px; height: 42px; border-radius: 12px; background: rgba(245,48,3,0.06); color: #f53003;
    display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;
  }
  .ct-info-item h4 { font-size: 14.5px; font-weight: 700; color: #1a1a2e; margin-bottom: 3px; }
  .ct-info-item p { font-size: 14px; color: rgba(26,26,46,0.55); }
  .ct-form {
    background: #fff; border-radius: 24px; padding: 32px; border: 1px solid rgba(26,26,46,0.06);
    box-shadow: 0 24px 50px -28px rgba(26,26,46,0.25); display: flex; flex-direction: column; gap: 16px;
  }
  .ct-form .row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
  .ct-form label { font-size: 13px; font-weight: 600; color: #1a1a2e; margin-bottom: 6px; display: block; }
  .ct-form input, .ct-form textarea {
    width: 100%; padding: 12px 16px; border-radius: 12px; border: 1px solid rgba(26,26,46,0.1);
    font-size: 14px; font-family: inherit; background: #fafbfe; color: #1a1a2e;
  }
  .ct-form textarea { resize: vertical; min-height: 100px; }
  .ct-form button {
    align-self: flex-start; padding: 13px 30px; border-radius: 100px; background: #f53003; color: #fff;
    border: none; font-weight: 700; font-size: 14.5px; cursor: pointer; box-shadow: 0 4px 20px rgba(245,48,3,0.25);
    transition: 0.2s;
  }
  .ct-form button:hover { background: #d42a02; }
  @media (max-width: 860px) { .ct-wrap { grid-template-columns: 1fr; } .ct-form .row { grid-template-columns: 1fr; } }

  /* ================================================================
     DARK MODE — toggled via the header liquid switch (body.dark-mode)
  ================================================================ */
  body.dark-mode { background: #0f1018; color: #e8e8f0; }
  body.dark-mode .lg-header {
    background: color-mix(in oklab, #0f1018 70%, transparent);
    border-bottom-color: rgba(255,255,255,0.08);
  }
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

  body.dark-mode .hero, body.dark-mode .pf-section, body.dark-mode .nx-section,
  body.dark-mode .categories-content, body.dark-mode .tm-section { background: #0f1018; }
  body.dark-mode .nx-section--alt, body.dark-mode .logo-strip { background: #15161f; }
  body.dark-mode .hero__title, body.dark-mode .pf-header h2, body.dark-mode .nx-header h2,
  body.dark-mode .categories-header h2, body.dark-mode .au-stat strong,
  body.dark-mode .card h3, body.dark-mode .category-card h3, body.dark-mode .pf-card__title,
  body.dark-mode .op-step h3, body.dark-mode .case-card__top h3, body.dark-mode .ach-card h3,
  body.dark-mode .art-card__body h3, body.dark-mode .car-item__info h3, body.dark-mode .ct-info-item h4,
  body.dark-mode .tech-box span, body.dark-mode .ind-box span, body.dark-mode .ct-form label { color: #f2f2f7; }
  body.dark-mode .hero__desc, body.dark-mode .pf-header p, body.dark-mode .nx-header p,
  body.dark-mode .card p, body.dark-mode .au-content p, body.dark-mode .op-step p,
  body.dark-mode .case-card__top p, body.dark-mode .ach-card p, body.dark-mode .art-card__body p,
  body.dark-mode .car-item__meta span, body.dark-mode .ct-info-item p, body.dark-mode .au-stat small { color: rgba(232,232,240,0.6); }
  body.dark-mode .card, body.dark-mode .category-card, body.dark-mode .pf-card,
  body.dark-mode .case-card, body.dark-mode .ach-card, body.dark-mode .art-card,
  body.dark-mode .car-item, body.dark-mode .ct-form, body.dark-mode .ind-box,
  body.dark-mode .tech-box, body.dark-mode .au-visual, body.dark-mode .op-step .op-num,
  body.dark-mode .pf-card__panel { background: #1a1a2e; border-color: rgba(255,255,255,0.08); }
  body.dark-mode .ct-form input, body.dark-mode .ct-form textarea { background: #0f1018; border-color: rgba(255,255,255,0.1); color: #e8e8f0; }
  body.dark-mode .hero__bottom { border-top-color: rgba(255,255,255,0.08); }
  body.dark-mode .hero__btn--secondary { background: rgba(255,255,255,0.06); color: #f2f2f7; border-color: rgba(255,255,255,0.1); }
  body.dark-mode .logo-strip__label { color: #f2f2f7; }
  body.dark-mode .art-card__img { background: linear-gradient(135deg, #1a1a2e, #22233a); }
  body.dark-mode .au-stat strong span, body.dark-mode .cs-box:nth-child(2) { color: #f53003; }

  /* ================================================================
     PERSIAN / RTL MODE — toggled via the language switcher
  ================================================================ */
  body.lang-fa { direction: rtl; font-family: 'Vazirmatn', 'Segoe UI', sans-serif; }
  body.lang-fa .lg-nav, body.lang-fa .lg-actions, body.lang-fa .hero__actions,
  body.lang-fa .hero__bottom, body.lang-fa .au-stats, body.lang-fa .car-item,
  body.lang-fa .ct-info-item { direction: rtl; }
  body.lang-fa .hero { flex-direction: row-reverse; }
  body.lang-fa .hero__content, body.lang-fa .au-content, body.lang-fa .nx-header.nx-left { text-align: right; }
  body.lang-fa .au-wrap { flex-direction: row-reverse; }
  body.lang-fa .car-item { flex-direction: row-reverse; }
  body.lang-fa .ct-wrap { direction: rtl; }

  /* ===== FOOTER ===== */
  .site-footer {
    width: 100%;
    background: #14151f;
    color: rgba(255,255,255,0.65);
    padding: 72px clamp(20px, 12vw, 300px) 0;
    transition: background 0.2s;
  }

  .ft-top {
    display: grid;
    grid-template-columns: 1.6fr 1fr 1fr 1fr 1.4fr;
    gap: 40px;
    padding-bottom: 56px;
    border-bottom: 1px solid rgba(255,255,255,0.08);
  }

  .ft-brand .ft-logo {
    color: #ff6b4a;
    font-weight: 700;
    font-size: 22px;
    letter-spacing: -0.3px;
    margin-bottom: 14px;
  }

  .ft-brand p {
    font-size: 14.5px;
    line-height: 1.7;
    color: rgba(255,255,255,0.5);
    max-width: 320px;
    margin-bottom: 22px;
  }

  .ft-social {
    display: flex;
    gap: 10px;
  }

  .ft-social a {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);
    color: rgba(255,255,255,0.6);
    transition: 0.2s;
  }

  .ft-social a:hover {
    background: #f53003;
    border-color: #f53003;
    color: #fff;
  }

  .ft-social svg { width: 16px; height: 16px; }

  .ft-col h4 {
    color: #f2f2f7;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    margin-bottom: 18px;
  }

  .ft-col ul {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .ft-col a {
    color: rgba(255,255,255,0.55);
    text-decoration: none;
    font-size: 14.5px;
    transition: 0.15s;
  }

  .ft-col a:hover { color: #fff; }

  .ft-newsletter h4 {
    color: #f2f2f7;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    margin-bottom: 12px;
  }

  .ft-newsletter p {
    font-size: 14px;
    line-height: 1.6;
    color: rgba(255,255,255,0.5);
    margin-bottom: 18px;
  }

  .ft-nl-form {
    display: flex;
    gap: 8px;
  }

  .ft-nl-form input {
    flex: 1;
    min-width: 0;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 10px;
    padding: 11px 14px;
    color: #fff;
    font-size: 14px;
    outline: none;
  }

  .ft-nl-form input::placeholder { color: rgba(255,255,255,0.35); }
  .ft-nl-form input:focus { border-color: #f53003; }

  .ft-nl-form button {
    background: #f53003;
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: 0 18px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    white-space: nowrap;
    transition: 0.2s;
    flex-shrink: 0;
  }

  .ft-nl-form button:hover { background: #d42a02; }

  .ft-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 14px;
    padding: 24px 0;
    font-size: 13.5px;
    color: rgba(255,255,255,0.4);
  }

  .ft-legal {
    display: flex;
    gap: 22px;
    flex-wrap: wrap;
  }

  .ft-legal a {
    color: rgba(255,255,255,0.4);
    text-decoration: none;
    transition: 0.15s;
  }

  .ft-legal a:hover { color: rgba(255,255,255,0.8); }

  @media (max-width: 1024px) {
    .ft-top {
      grid-template-columns: 1fr 1fr;
      row-gap: 40px;
    }
    .ft-brand { grid-column: 1 / -1; }
    .ft-newsletter { grid-column: 1 / -1; }
    .ft-nl-form { max-width: 420px; }
  }

  @media (max-width: 600px) {
    .site-footer { padding-top: 56px; }
    .ft-top { grid-template-columns: 1fr; gap: 32px; }
    .ft-brand p { max-width: 100%; }
    .ft-bottom { flex-direction: column; align-items: flex-start; text-align: left; }
    .ft-nl-form { flex-direction: column; }
    .ft-nl-form button { padding: 12px; }
  }

  /* Footer — dark mode */
  body.dark-mode .site-footer { background: #0b0c13; }
  body.dark-mode .ft-top { border-bottom-color: rgba(255,255,255,0.06); }

  /* Footer — light mode (site default is light, so re-theme footer to sit on light pages too) */
  body:not(.dark-mode) .site-footer { background: #1a1a2e; color: rgba(255,255,255,0.65); }

  /* Footer — RTL / Persian */
  body.lang-fa .ft-brand p { text-align: right; }
  body.lang-fa .ft-social { direction: ltr; justify-content: flex-end; }
  body.lang-fa .ft-nl-form { direction: rtl; }
  body.lang-fa .ft-bottom { direction: rtl; }
  body.lang-fa .ft-legal { direction: rtl; }
  @media (max-width: 600px) {
    body.lang-fa .ft-bottom { align-items: flex-end; text-align: right; }
  }

  /* ================================================================
     EXTRA — Page banner, gallery, description, reveal-on-scroll,
     portfolio-card hover logo swap, team profile hero, activity tags
  ================================================================ */

  .pg-banner {
    width: 100%;
    padding: 64px clamp(20px, 12vw, 300px) 56px;
    background: linear-gradient(180deg, rgba(245,48,3,0.07) 0%, rgba(245,48,3,0.02) 100%);
    text-align: center;
  }
  .pg-banner .crumb {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 13px; font-weight: 600; color: rgba(26,26,46,0.5);
    text-decoration: none; margin-bottom: 18px;
  }
  .pg-banner .crumb:hover { color: #f53003; }
  .pg-banner .tag {
    display: inline-block; font-size: 12px; font-weight: 700; letter-spacing: 0.1em;
    text-transform: uppercase; padding: 6px 16px; border-radius: 999px; color: #f53003;
    background: rgba(245,48,3,0.06); border: 1px solid rgba(245,48,3,0.08); margin-bottom: 14px;
  }
  .pg-banner h1 { font-size: clamp(28px, 4.5vw, 46px); font-weight: 800; color: #1a1a2e; letter-spacing: -0.02em; }
  .pg-banner h1 span { color: #f53003; }
  .pg-banner p { max-width: 560px; margin: 12px auto 0; color: rgba(26,26,46,0.55); font-size: 16px; line-height: 1.7; }

  /* ===== Reveal on scroll ===== */
  .reveal { opacity: 0; transform: translateY(28px); transition: opacity .7s ease, transform .7s ease; will-change: opacity, transform; }
  .reveal.is-visible { opacity: 1; transform: translateY(0); }
  @media (prefers-reduced-motion: reduce) { .reveal { transition: none; opacity: 1; transform: none; } }

  /* ===== Portfolio card as a link + hover logo swap ===== */
  a.pf-card { text-decoration: none; display: block; }
  .pf-card__logo {
    position: absolute; inset: 0; z-index: 1; display: flex; align-items: center; justify-content: center;
    background: color-mix(in oklab, white 90%, transparent);
    backdrop-filter: blur(2px);
    opacity: 0; transition: opacity .3s ease;
  }
  .pf-card__logo img { width: 84px; height: 84px; object-fit: contain; filter: drop-shadow(0 6px 14px rgba(26,26,46,0.15)); }
  .pf-card:hover .pf-card__logo { opacity: 1; }
  body.dark-mode .pf-card__logo { background: color-mix(in oklab, #1a1a2e 88%, transparent); }

  /* ===== Detail page: hero / cover ===== */
  .det-hero { width: 100%; padding: 54px clamp(20px, 12vw, 300px) 0; }
  .det-hero__top { display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 20px; margin-bottom: 26px; }
  .det-hero__top h1 { font-size: clamp(28px, 4.5vw, 44px); font-weight: 800; color: #1a1a2e; letter-spacing: -0.02em; }
  .det-hero__top p { color: rgba(26,26,46,0.55); font-size: 15.5px; margin-top: 8px; max-width: 520px; }
  .det-hero__visit {
    display: inline-flex; align-items: center; gap: 8px; background: #f53003; color: #fff;
    padding: 12px 22px; border-radius: 100px; font-weight: 600; font-size: 14px; text-decoration: none;
    white-space: nowrap; box-shadow: 0 4px 16px rgba(245,48,3,0.2); transition: .2s;
  }
  .det-hero__visit:hover { background: #d42a02; }
  .det-hero__cover { border-radius: 26px; overflow: hidden; box-shadow: 0 30px 60px -30px rgba(26,26,46,0.35); }
  .det-hero__cover img { width: 100%; display: block; }

  /* ===== Gallery ===== */
  .gal-section { width: 100%; padding: 60px clamp(20px, 12vw, 300px) 20px; }
  .gal-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
  .gal-grid a { display: block; border-radius: 18px; overflow: hidden; box-shadow: 0 16px 34px -22px rgba(26,26,46,0.3); }
  .gal-grid img { width: 100%; height: 220px; object-fit: cover; display: block; transition: transform .4s ease; }
  .gal-grid a:hover img { transform: scale(1.06); }
  @media (max-width: 860px) { .gal-grid { grid-template-columns: repeat(2, 1fr); } }
  @media (max-width: 560px) { .gal-grid { grid-template-columns: 1fr; } .gal-grid img { height: 200px; } }

  /* ===== Description ===== */
  .desc-section { width: 100%; padding: 60px clamp(20px, 12vw, 300px); display: grid; grid-template-columns: 1.5fr 1fr; gap: 50px; }
  .desc-main h2 { font-size: clamp(24px, 3vw, 32px); font-weight: 800; color: #1a1a2e; margin-bottom: 16px; letter-spacing: -0.01em; }
  .desc-main p { font-size: 16px; line-height: 1.85; color: rgba(26,26,46,0.62); margin-bottom: 16px; }
  .desc-side { display: flex; flex-direction: column; gap: 22px; }
  .desc-box { background: #fff; border: 1px solid rgba(26,26,46,0.06); border-radius: 20px; padding: 22px 24px; box-shadow: 0 16px 40px -28px rgba(26,26,46,0.25); }
  .desc-box h4 { font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: #f53003; margin-bottom: 12px; }
  .desc-box ul { list-style: none; display: flex; flex-direction: column; gap: 10px; }
  .desc-box li { font-size: 14.5px; color: #1a1a2e; display: flex; justify-content: space-between; gap: 10px; }
  .desc-box li span { color: rgba(26,26,46,0.5); }
  .tech-pills { display: flex; flex-wrap: wrap; gap: 8px; }
  .tech-pills span { font-size: 12.5px; font-weight: 600; background: rgba(245,48,3,0.06); color: #f53003; padding: 6px 12px; border-radius: 999px; border: 1px solid rgba(245,48,3,0.1); }
  @media (max-width: 860px) { .desc-section { grid-template-columns: 1fr; } }

  /* ===== Built-by team strip (reuses tm-card visuals via a-wrapped cards) ===== */
  .builtby-section { width: 100%; padding: 40px clamp(20px, 12vw, 300px) 90px; }
  .builtby-grid { display: flex; flex-wrap: wrap; gap: 20px; }
  a.tm-mini { text-decoration: none; display: flex; align-items: center; gap: 14px; background: #fff; border: 1px solid rgba(26,26,46,0.06);
    border-radius: 999px; padding: 10px 20px 10px 10px; box-shadow: 0 12px 30px -22px rgba(26,26,46,0.25); transition: .25s; }
  a.tm-mini:hover { transform: translateY(-3px); box-shadow: 0 18px 34px -20px rgba(26,26,46,0.3); }
  a.tm-mini img { width: 46px; height: 46px; border-radius: 50%; object-fit: cover; }
  a.tm-mini .nm { font-size: 14px; font-weight: 700; color: #1a1a2e; }
  a.tm-mini .rl { font-size: 12px; color: rgba(26,26,46,0.5); }

  /* ===== Similar work ===== */
  .sim-section { width: 100%; padding: 20px clamp(20px, 12vw, 300px) 110px; }

  /* ===== Team member profile hero ===== */
  .prof-hero { width: 100%; padding: 64px clamp(20px, 12vw, 300px) 50px; display: flex; align-items: center; gap: 40px; flex-wrap: wrap; }
  .prof-hero__photo { width: 190px; height: 190px; border-radius: 28px; overflow: hidden; flex-shrink: 0; box-shadow: 0 24px 50px -26px rgba(26,26,46,0.35); }
  .prof-hero__photo img { width: 100%; height: 100%; object-fit: cover; }
  .prof-hero__info { flex: 1; min-width: 260px; }
  .prof-hero__info .role { color: #f53003; font-weight: 700; font-size: 13.5px; text-transform: uppercase; letter-spacing: .06em; margin-bottom: 10px; display: block; }
  .prof-hero__info h1 { font-size: clamp(26px, 4vw, 38px); font-weight: 800; color: #1a1a2e; margin-bottom: 12px; }
  .prof-hero__info p { color: rgba(26,26,46,0.6); font-size: 15.5px; line-height: 1.75; max-width: 560px; }
  .prof-hero__social { display: flex; gap: 10px; margin-top: 18px; }
  .prof-hero__social a { width: 38px; height: 38px; border-radius: 50%; display: flex; align-items: center; justify-content: center;
    background: rgba(26,26,46,0.04); color: #1a1a2e; border: 1px solid rgba(26,26,46,0.06); transition: .2s; }
  .prof-hero__social a:hover { background: #f53003; color: #fff; border-color: #f53003; }
  .prof-hero__social svg { width: 16px; height: 16px; }

  /* ===== Activity / expertise tags ===== */
  .act-section { width: 100%; padding: 20px clamp(20px, 12vw, 300px) 70px; }
  .act-tags { display: flex; flex-wrap: wrap; gap: 10px; }
  .act-tags span { font-size: 13.5px; font-weight: 600; background: #fff; border: 1px solid rgba(26,26,46,0.08); color: #1a1a2e;
    padding: 9px 18px; border-radius: 999px; box-shadow: 0 8px 20px -16px rgba(26,26,46,0.2); }

  /* ===== Dark mode additions ===== */
  body.dark-mode .pg-banner { background: linear-gradient(180deg, rgba(245,48,3,0.10) 0%, rgba(15,16,24,0) 100%); }
  body.dark-mode .pg-banner h1, body.dark-mode .det-hero__top h1, body.dark-mode .desc-main h2 { color: #f2f2f7; }
  body.dark-mode .pg-banner p, body.dark-mode .crumb, body.dark-mode .det-hero__top p,
  body.dark-mode .desc-main p, body.dark-mode a.tm-mini .rl { color: rgba(232,232,240,0.6); }
  body.dark-mode .desc-box, body.dark-mode a.tm-mini { background: #1a1a2e; border-color: rgba(255,255,255,0.08); }
  body.dark-mode .desc-box li, body.dark-mode a.tm-mini .nm, body.dark-mode .act-tags span,
  body.dark-mode .prof-hero__info h1 { color: #f2f2f7; }
  body.dark-mode .act-tags span { background: #1a1a2e; border-color: rgba(255,255,255,0.08); }
  body.dark-mode .prof-hero__info p { color: rgba(232,232,240,0.62); }
  body.dark-mode .prof-hero__social a { background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.08); color: #f2f2f7; }
  body.dark-mode .pf-card__media img.pf-card__logo { background: color-mix(in oklab, #1a1a2e 92%, transparent); }

  /* ===== RTL tweaks ===== */
  body.lang-fa .det-hero__top { flex-direction: row-reverse; }
  body.lang-fa .det-hero__top p { text-align: right; }
  body.lang-fa .desc-box li { flex-direction: row-reverse; }
  body.lang-fa .prof-hero { flex-direction: row-reverse; }
  body.lang-fa .prof-hero__info { text-align: right; }
  body.lang-fa .desc-main { text-align: right; }

  @media (max-width: 700px) {
    .det-hero__top { flex-direction: column; align-items: flex-start; }
    .prof-hero { flex-direction: column; text-align: center; }
    .prof-hero__info { text-align: center; }
    body.lang-fa .prof-hero, body.lang-fa .det-hero__top { flex-direction: column; }
  }

  </style>
</head>

<body>

  <!-- ===== LIQUID GLASS HEADER (LIGHT MODE) ===== -->
  <header class="lg-header" role="banner">
    <!-- Left: Brand + tag -->
    <div class="lg-brand">
      OWJcode
      <small data-i18n="nav.tag">tame</small>
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
        <span class="lang-name"><img src="us.svg" alt="" style="border-radius: 5px;margin-top: 10px;"></span>
      </a>

      <a class="lang-switcher__item" role="menuitem" href="#" data-lang="fa">
        <span class="flag">🇮🇷</span>
        <span class="lang-name"><img src="ir.svg" alt="" style="border-radius: 5px;margin-top: 10px;"></span>
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


  <!-- ===== PAGE BANNER / CROSSLINK ===== -->
  <section class="pg-banner" style="padding-bottom: 0;">
    <a class="crumb" href="{{ route('portfolio.list') }}">&#8592; <span data-i18n="pgDet.back">Back to portfolio</span></a>
  </section>

  <!-- ===== PROJECT HERO / COVER ===== -->
  <section class="det-hero">
    <div class="det-hero__top">
      <div>
        <span class="tag">{{ $portfolio->category }}</span>
        <h1 data-i18n="pgDet.title">{{ $portfolio->title }}</h1>
        <p data-i18n="pgDet.subtitle">{{ $portfolio->short_description }}</p>
      </div>
      @if ($portfolio->project_url)
      <a class="det-hero__visit" href="{{ $portfolio->project_url }}" target="_blank" rel="noopener">
        <span data-i18n="pgDet.visit">Visit live site</span> &#8599;
      </a>
      @endif
    </div>
    <div class="det-hero__cover">
      @php
        $mainImg = $portfolio->images->firstWhere('is_main', true) ?? $portfolio->images->first();
      @endphp
      @if ($mainImg)
        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($mainImg->url) }}" alt="{{ $portfolio->title }}" loading="lazy">
      @endif
    </div>
  </section>

  <!-- ===== GALLERY — images of the site ===== -->
  @if ($portfolio->images->count() > 1)
  <section class="gal-section">
    <div class="gal-grid">
      @foreach ($portfolio->images as $image)
      <a href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($image->url) }}" target="_blank" rel="noopener">
        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($image->url) }}" alt="{{ $portfolio->title }}" loading="lazy">
      </a>
      @endforeach
    </div>
  </section>
  @endif

  <!-- ===== DESCRIPTION (reveals on scroll) ===== -->
  <section class="desc-section reveal">
    <div class="desc-main">
      <h2 data-i18n="pgDet.overviewTitle">Project overview</h2>
      <p data-i18n="pgDet.desc" style="white-space: pre-line;">{{ $portfolio->description }}</p>
    </div>
    <div class="desc-side">
      <div class="desc-box">
        <h4 data-i18n="pgDet.factsTitle">Project facts</h4>
        <ul>
          @if ($portfolio->client_name)
          <li><span data-i18n="pgDet.client">Client</span> <strong>{{ $portfolio->client_name }}</strong></li>
          @endif
          <li><span data-i18n="pgDet.industry">Industry</span> <strong>{{ $portfolio->category }}</strong></li>
          @if ($portfolio->duration)
          <li><span data-i18n="pgDet.timeline">Timeline</span> <strong>{{ $portfolio->duration }}</strong></li>
          @endif
        </ul>
      </div>
      @if (!empty($portfolio->tools))
      <div class="desc-box">
        <h4 data-i18n="pgDet.stackTitle">Technologies</h4>
        <div class="tech-pills">
          @foreach ($portfolio->tools as $tool)
          <span>{{ $tool }}</span>
          @endforeach
        </div>
      </div>
      @endif
    </div>
  </section>

  <!-- ===== TEAM WHO BUILT IT (reveals on scroll) ===== -->
  @if ($portfolio->teamMembers->count())
  <section class="builtby-section reveal">
    <div class="nx-header" style="margin-bottom:28px;">
      <span class="nx-tag" data-i18n="pgDet.teamTag">✦ The team</span>
      <h2 data-i18n="pgDet.teamTitle">Who built this</h2>
    </div>
    <div class="builtby-grid">
      @foreach ($portfolio->teamMembers as $member)
      <a class="tm-mini" href="{{ route('team.show', $member->slug) }}">
        @if ($member->avatar)
        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($member->avatar) }}" alt="{{ $member->name }}">
        @endif
        <span>
          <span class="nm" data-i18n="tm.member{{ $member->id }}.name">{{ $member->name }}</span><br>
          <span class="rl" data-i18n="tm.member{{ $member->id }}.role">{{ $member->role }}</span>
        </span>
      </a>
      @endforeach
    </div>
  </section>
  @endif

  <!-- ===== SIMILAR PROJECTS (reveals on scroll) ===== -->
  @if ($similar->count())
  <section class="sim-section reveal">
    <div class="nx-header" style="margin-bottom:28px;">
      <span class="nx-tag" data-i18n="pgDet.simTag">✦ More work</span>
      <h2 data-i18n="pgDet.simTitle">Similar projects</h2>
    </div>
    <div class="pf-grid">
      @foreach ($similar as $item)
      @php
        $simImg = $item->images->firstWhere('is_main', true) ?? $item->images->first();
        $simUrl = $simImg ? \Illuminate\Support\Facades\Storage::disk('public')->url($simImg->url) : 'https://picsum.photos/seed/owj' . $item->id . '/480/360';
      @endphp
      <a class="pf-card" href="{{ route('portfolio.show', $item->slug) }}" data-seed="pf{{ $item->id }}">
        <svg class="pf-card__warp" viewBox="0 0 480 360" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
          <defs>
            <filter id="pf-warp-s{{ $item->id }}" x="-20%" y="-20%" width="140%" height="140%">
              <feTurbulence class="pf-card__turb" type="fractalNoise" baseFrequency="0.012 0.02" numOctaves="2" seed="{{ $item->id }}" result="noise"/>
              <feDisplacementMap class="pf-card__disp" in="SourceGraphic" in2="noise" scale="0" xChannelSelector="R" yChannelSelector="G"/>
            </filter>
          </defs>
          <image href="{{ $simUrl }}" x="0" y="0" width="480" height="360" preserveAspectRatio="xMidYMid slice" filter="url(#pf-warp-s{{ $item->id }})"/>
        </svg>
        <span class="pf-card__tag">{{ $item->category }}</span>
        <div class="pf-card__panel">
          <h3 class="pf-card__title" data-i18n="pf.item{{ $item->id }}.title">{{ $item->title }}</h3>
          <p class="pf-card__desc" data-i18n="pf.item{{ $item->id }}.desc">{{ $item->short_description }}</p>
        </div>
      </a>
      @endforeach
    </div>
  </section>
  @endif



  <!-- ===== CONTACT ===== -->
  <section class="nx-section nx-section--alt" id="contact">
    <div class="nx-header">
      <span class="nx-tag" data-i18n="ct.tag">✦ Contact</span>
      <h2 data-i18n-html="ct.title">Let's build <span>something</span></h2>
      <p data-i18n="ct.desc">Tell us about your project — we typically reply within one business day.</p>
    </div>
    <div class="ct-wrap">
      <div class="ct-info">
        <div class="ct-info-item"><span class="ic">✉</span><div><h4 data-i18n="ct.email">Email</h4><p>hello@owjcode.com</p></div></div>
        <div class="ct-info-item"><span class="ic">☎</span><div><h4 data-i18n="ct.phone">Phone</h4><p>+1 (555) 012-3456</p></div></div>
        <div class="ct-info-item"><span class="ic">📍</span><div><h4 data-i18n="ct.office">Office</h4><p>123 Studio Ave, Suite 400</p></div></div>
      </div>
      <form class="ct-form" onsubmit="return false;">
        <div class="row">
          <div><label for="ct-name" data-i18n="ct.name">Name</label><input id="ct-name" type="text" data-i18n-placeholder="ct.namePh" placeholder="Your name"></div>
          <div><label for="ct-email" data-i18n="ct.email2">Email</label><input id="ct-email" type="email" placeholder="you@company.com"></div>
        </div>
        <div><label for="ct-msg" data-i18n="ct.msg">Message</label><textarea id="ct-msg" data-i18n-placeholder="ct.msgPh" placeholder="Tell us about your project..."></textarea></div>
        <button type="submit" data-i18n="ct.send">Send message</button>
      </form>
    </div>
  </section>
  <!-- ===== FOOTER ===== -->
  <footer class="site-footer" role="contentinfo">
    <div class="ft-top">
      <div class="ft-brand">
        <div class="ft-logo">OWJcode</div>
        <p data-i18n="footer.desc">We design and build digital products — from strategy and UI to launch and long-term support.</p>
        <div class="ft-social">
          <a href="#" aria-label="X (Twitter)">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.9 2H22l-7.6 8.7L23.3 22h-6.9l-5.4-6.9L4.8 22H1.6l8.1-9.3L1 2h7.1l4.9 6.3L18.9 2zm-1.2 18h1.9L7.4 4H5.4l12.3 16z"/></svg>
          </a>
          <a href="#" aria-label="GitHub">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.58 2 12.2c0 4.5 2.87 8.32 6.84 9.67.5.1.68-.22.68-.49 0-.24-.01-.87-.01-1.71-2.78.62-3.37-1.37-3.37-1.37-.45-1.18-1.11-1.49-1.11-1.49-.91-.64.07-.63.07-.63 1 .07 1.53 1.05 1.53 1.05.89 1.56 2.34 1.11 2.91.85.09-.66.35-1.11.63-1.37-2.22-.26-4.56-1.14-4.56-5.05 0-1.12.39-2.03 1.03-2.75-.1-.26-.45-1.3.1-2.71 0 0 .84-.28 2.75 1.05a9.29 9.29 0 0 1 5 0c1.9-1.33 2.74-1.05 2.74-1.05.56 1.41.21 2.45.1 2.71.65.72 1.03 1.63 1.03 2.75 0 3.92-2.34 4.78-4.57 5.04.36.32.68.94.68 1.9 0 1.37-.01 2.47-.01 2.81 0 .27.18.6.69.49A10.02 10.02 0 0 0 22 12.2C22 6.58 17.52 2 12 2z"/></svg>
          </a>
          <a href="#" aria-label="LinkedIn">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M6.94 5a2 2 0 1 1-4-.02 2 2 0 0 1 4 .02zM7 8.48H3V21h4V8.48zm6.32 0H9.34V21h3.94v-6.57c0-3.66 4.77-3.96 4.77 0V21H22v-7.93c0-6.17-7.06-5.94-8.68-2.91V8.48z"/></svg>
          </a>
          <a href="#" aria-label="Instagram">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.2c3.2 0 3.58.01 4.85.07 1.17.05 1.97.24 2.43.4a4.9 4.9 0 0 1 1.77 1.15 4.9 4.9 0 0 1 1.15 1.77c.16.46.35 1.26.4 2.43.06 1.27.07 1.65.07 4.85s-.01 3.58-.07 4.85c-.05 1.17-.24 1.97-.4 2.43a4.9 4.9 0 0 1-1.15 1.77 4.9 4.9 0 0 1-1.77 1.15c-.46.16-1.26.35-2.43.4-1.27.06-1.65.07-4.85.07s-3.58-.01-4.85-.07c-1.17-.05-1.97-.24-2.43-.4a4.9 4.9 0 0 1-1.77-1.15 4.9 4.9 0 0 1-1.15-1.77c-.16-.46-.35-1.26-.4-2.43C2.21 15.58 2.2 15.2 2.2 12s.01-3.58.07-4.85c.05-1.17.24-1.97.4-2.43a4.9 4.9 0 0 1 1.15-1.77A4.9 4.9 0 0 1 5.6 1.8c.46-.16 1.26-.35 2.43-.4C9.3 1.34 9.68 1.33 12 1.33m0 2c-3.15 0-3.5.01-4.73.07-.96.04-1.48.2-1.83.34-.46.18-.79.39-1.13.73-.34.34-.55.67-.73 1.13-.14.35-.3.87-.34 1.83C3.18 8.33 3.17 8.68 3.17 11.83s.01 3.5.07 4.73c.04.96.2 1.48.34 1.83.18.46.39.79.73 1.13.34.34.67.55 1.13.73.35.14.87.3 1.83.34 1.23.06 1.58.07 4.73.07s3.5-.01 4.73-.07c.96-.04 1.48-.2 1.83-.34.46-.18.79-.39 1.13-.73.34-.34.55-.67.73-1.13.14-.35.3-.87.34-1.83.06-1.23.07-1.58.07-4.73s-.01-3.5-.07-4.73c-.04-.96-.2-1.48-.34-1.83a3 3 0 0 0-.73-1.13 3 3 0 0 0-1.13-.73c-.35-.14-.87-.3-1.83-.34C15.5 4.18 15.15 4.17 12 4.17z"/><circle cx="12" cy="12" r="3.2"/></svg>
          </a>
        </div>
      </div>

      <div class="ft-col">
        <h4 data-i18n="footer.company.title">Company</h4>
        <ul>
          <li><a href="#" data-i18n="footer.company.l1">About us</a></li>
          <li><a href="#careers" data-i18n="footer.company.l2">Careers</a></li>
          <li><a href="#" data-i18n="footer.company.l3">Blog</a></li>
          <li><a href="#contact" data-i18n="footer.company.l4">Contact</a></li>
        </ul>
      </div>

      <div class="ft-col">
        <h4 data-i18n="footer.services.title">Services</h4>
        <ul>
          <li><a href="#" data-i18n="footer.services.l1">Product Strategy</a></li>
          <li><a href="#" data-i18n="footer.services.l2">UI / UX Design</a></li>
          <li><a href="#" data-i18n="footer.services.l3">Web Development</a></li>
          <li><a href="#" data-i18n="footer.services.l4">Mobile Development</a></li>
        </ul>
      </div>

      <div class="ft-col">
        <h4 data-i18n="footer.resources.title">Resources</h4>
        <ul>
          <li><a href="#" data-i18n="footer.resources.l1">Documentation</a></li>
          <li><a href="#" data-i18n="footer.resources.l2">Case Studies</a></li>
          <li><a href="#" data-i18n="footer.resources.l3">Support</a></li>
          <li><a href="#" data-i18n="footer.resources.l4">Status</a></li>
        </ul>
      </div>

      <div class="ft-newsletter">
        <h4 data-i18n="footer.newsletter.title">Stay in the loop</h4>
        <p data-i18n="footer.newsletter.desc">Product notes and case studies, sent occasionally — no spam.</p>
        <form class="ft-nl-form" onsubmit="return false;">
          <label for="ft-nl-email" class="sr-only" data-i18n="footer.newsletter.label">Email address</label>
          <input id="ft-nl-email" type="email" data-i18n-placeholder="footer.newsletter.placeholder" placeholder="you@company.com">
          <button type="submit" data-i18n="footer.newsletter.btn">Subscribe</button>
        </form>
      </div>
    </div>

    <div class="ft-bottom">
      <p data-i18n="footer.copyright">© 2026 OWJcode. All rights reserved.</p>
      <div class="ft-legal">
        <a href="#" data-i18n="footer.legal.privacy">Privacy Policy</a>
        <a href="#" data-i18n="footer.legal.terms">Terms of Service</a>
        <a href="#" data-i18n="footer.legal.cookies">Cookies</a>
      </div>
    </div>
  </footer>

  <script>
    // Liquid glass displacement on portfolio cards
    (() => {
      const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
      const BASE = 0, MAX = 20;
      document.querySelectorAll('.pf-card').forEach(card => {
        const disp = card.querySelector('.pf-card__disp');
        const turb = card.querySelector('.pf-card__turb');
        if (!disp) return;
        let target = BASE, current = BASE, raf = null;
        function tick(){
          current += (target - current) * 0.12;
          disp.setAttribute('scale', current.toFixed(2));
          if (Math.abs(target - current) > 0.2){ raf = requestAnimationFrame(tick); }
          else { disp.setAttribute('scale', target.toFixed(2)); raf = null; }
        }
        function kick(){ if (!raf) raf = requestAnimationFrame(tick); }
        card.addEventListener('pointermove', e => {
          if (reduce) return;
          const r = card.getBoundingClientRect();
          const dx = Math.abs((e.clientX - (r.left+r.width/2)) / (r.width/2));
          const dy = Math.abs((e.clientY - (r.top+r.height/2)) / (r.height/2));
          target = BASE + Math.min(1,(dx+dy)/2) * (MAX - BASE);
          const f = 0.012 + Math.min(1,(dx+dy)/2)*0.02;
          turb.setAttribute('baseFrequency', f.toFixed(4)+' '+(f*1.6).toFixed(4));
          kick();
        });
        card.addEventListener('pointerleave', () => { target = BASE; kick(); });
      });
    })();

    // Highlight active nav item on click
    document.querySelectorAll('.lg-nav a').forEach(link => {
      link.addEventListener('click', (e) => {
        e.preventDefault();
        document.querySelectorAll('.lg-nav a').forEach(l => l.classList.remove('lg-active'));
        link.classList.add('lg-active');
      });
    });

    // ===== Dark mode toggle (the liquid gooey switch in the header) =====
    (() => {
      const input = document.querySelector('.lg-04__input');
      if (!input) return;
      // checked = light mode, unchecked = dark mode
      function applyMode(){
        document.body.classList.toggle('dark-mode', !input.checked);
      }
      input.addEventListener('change', applyMode);
      applyMode();
    })();

    // ===== Reveal-on-scroll (description / team / similar work / activity sections) =====
    (() => {
      const els = document.querySelectorAll('.reveal');
      if (!els.length) return;
      if (matchMedia('(prefers-reduced-motion: reduce)').matches) {
        els.forEach(el => el.classList.add('is-visible'));
        return;
      }
      const io = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            io.unobserve(entry.target);
          }
        });
      }, { threshold: 0.15, rootMargin: '0px 0px -60px 0px' });
      els.forEach((el, i) => { el.style.transitionDelay = (i % 3) * 0.08 + 's'; io.observe(el); });
    })();

    // ===== Language switcher (English / فارسی) =====
    (() => {
      const translations = {
        'nav.tag': { en: 'tame', fa: 'دقیق' },
        'nav.framework': { en: 'Framework', fa: 'چارچوب' },
        'nav.products': { en: 'Products', fa: 'محصولات' },
        'nav.resources': { en: 'Resources', fa: 'منابع' },
        'nav.events': { en: 'Events', fa: 'رویدادها' },
        'nav.docs': { en: 'Docs', fa: 'مستندات' },

        'hero.tagline': { en: '✦ The clean stack for Artisans and agents.', fa: '✦ استک تمیز برای توسعه‌دهندگان و ایجنت‌ها.' },
        'hero.title': { en: 'Laravel is <span class="highlight">batteries-included</span><br>so everyone can build and ship', fa: 'لاراول <span class="highlight">همه‌چیز تمام</span> است<br>تا همه بتوانند بسازند و منتشر کنند' },
        'hero.desc': { en: 'Build faster, deploy confidently, and scale without fear — all with the elegance you deserve.', fa: 'سریع‌تر بسازید، با اطمینان دیپلوی کنید و بدون نگرانی مقیاس بگیرید — با ظرافتی که شایسته‌شماست.' },
        'hero.btn1': { en: 'Deploy on Cloud', fa: 'دیپلوی روی کلاود' },
        'hero.btn2': { en: 'View framework docs', fa: 'مشاهده مستندات فریم‌ورک' },
        'hero.deploySeconds': { en: '— deploy in seconds', fa: '— دیپلوی در چند ثانیه' },

        'logostrip.label': { en: 'POWERING IDEAS FOR<br>THE BEST &amp; BRIGHTEST', fa: 'قدرت‌بخش ایده‌ها برای<br>بهترین‌ها و درخشان‌ترین‌ها' },

        'about.tag': { en: '✦ About Us', fa: '✦ درباره ما' },
        'about.title': { en: 'Built by engineers who care about <span>the details</span>', fa: 'ساخته‌شده توسط مهندسانی که به <span>جزئیات</span> اهمیت می‌دهند' },
        'about.p1': { en: 'OWJcode is a product engineering studio. We partner with founders and growing teams to design, build, and ship software that holds up under real usage — from the first prototype to the systems that run at scale.', fa: 'OWJcode یک استودیو مهندسی محصول است. ما با بنیان‌گذاران و تیم‌های در حال رشد همکاری می‌کنیم تا نرم‌افزاری طراحی، ساخته و منتشر کنیم که در استفاده واقعی دوام بیاورد — از اولین نمونه اولیه تا سیستم‌هایی که در مقیاس بزرگ اجرا می‌شوند.' },
        'about.p2': { en: 'We keep teams small and senior, favor clear communication over process, and stay involved long after launch so what we build keeps working.', fa: 'تیم‌ها را کوچک و باتجربه نگه می‌داریم، ارتباط شفاف را به فرآیندهای پیچیده ترجیح می‌دهیم و مدت‌ها پس از انتشار همراه پروژه می‌مانیم تا چیزی که می‌سازیم به کار خود ادامه دهد.' },
        'about.stat1': { en: 'Years building', fa: 'سال تجربه' },
        'about.stat2': { en: 'Projects shipped', fa: 'پروژه تحویل‌شده' },
        'about.stat3': { en: 'Team members', fa: 'عضو تیم' },
        'about.visual': { en: 'Our studio', fa: 'استودیوی ما' },

        'services.tag': { en: '✦ Services', fa: '✦ خدمات' },
        'services.title': { en: 'What we <span>do</span>', fa: 'کارهایی که <span>انجام می‌دهیم</span>' },
        'services.desc': { en: 'End-to-end product delivery, from strategy to the code that ships.', fa: 'تحویل کامل محصول، از استراتژی تا کدی که منتشر می‌شود.' },
        'services.c1t': { en: 'Product Strategy', fa: 'استراتژی محصول' },
        'services.c1d': { en: 'Roadmaps, discovery, and scoping that turn an idea into a buildable plan.', fa: 'رودمپ، کشف نیازها و تعیین دامنه‌ای که ایده را به یک برنامه قابل‌اجرا تبدیل می‌کند.' },
        'services.c2t': { en: 'UI / UX Design', fa: 'طراحی UI / UX' },
        'services.c2d': { en: 'Interfaces designed around how people actually use the product.', fa: 'رابط‌هایی که بر اساس نحوه واقعی استفاده کاربران طراحی شده‌اند.' },
        'services.c3t': { en: 'Web Development', fa: 'توسعه وب' },
        'services.c3d': { en: 'Fast, maintainable web apps built on modern, proven stacks.', fa: 'اپلیکیشن‌های وب سریع و قابل‌نگهداری بر پایه استک‌های مدرن و اثبات‌شده.' },
        'services.c4t': { en: 'Mobile Development', fa: 'توسعه موبایل' },
        'services.c4d': { en: 'Native and cross-platform apps for iOS and Android.', fa: 'اپلیکیشن‌های نیتیو و کراس‌پلتفرم برای iOS و اندروید.' },
        'services.c5t': { en: 'Cloud & DevOps', fa: 'کلاود و DevOps' },
        'services.c5d': { en: 'Infrastructure, CI/CD, and deployments that scale without drama.', fa: 'زیرساخت، CI/CD و دیپلوی‌هایی که بدون دردسر مقیاس می‌گیرند.' },
        'services.c6t': { en: 'Ongoing Support', fa: 'پشتیبانی مستمر' },
        'services.c6d': { en: 'Maintenance, monitoring, and iteration after launch day.', fa: 'نگهداری، مانیتورینگ و بهبود مستمر پس از انتشار.' },

        'cat.tag': { en: '✦ Categories', fa: '✦ دسته‌بندی‌ها' },
        'cat.title': { en: 'Explore <span>top</span> topics', fa: 'کاوش در <span>برترین</span> موضوعات' },
        'cat.desc': { en: 'Discover the most popular categories in our community', fa: 'محبوب‌ترین دسته‌بندی‌های جامعه ما را کشف کنید' },
        'cat.c1t': { en: 'Development', fa: 'توسعه' },
        'cat.c1d': { en: 'Web, mobile & software engineering', fa: 'مهندسی وب، موبایل و نرم‌افزار' },
        'cat.c2t': { en: 'Design', fa: 'طراحی' },
        'cat.c2d': { en: 'UI/UX, graphics & creative direction', fa: 'UI/UX، گرافیک و جهت‌گیری خلاقانه' },
        'cat.c3t': { en: 'Data Science', fa: 'علم داده' },
        'cat.c3d': { en: 'Analytics, ML & AI innovations', fa: 'تحلیل داده، یادگیری ماشین و نوآوری‌های هوش مصنوعی' },
        'cat.c4t': { en: 'Cloud & DevOps', fa: 'کلاود و DevOps' },
        'cat.c4d': { en: 'Infrastructure, deployment & scaling', fa: 'زیرساخت، دیپلوی و مقیاس‌پذیری' },
        'cat.articles': { en: 'articles', fa: 'مقاله' },

        'pf.tag': { en: '✦ Portfolio', fa: '✦ نمونه‌کارها' },
        'pf.title': { en: 'Selected <span>work</span>', fa: 'کارهای <span>منتخب</span>' },
        'pf.desc': { en: 'A few recent projects, shipped end-to-end.', fa: 'چند پروژه اخیر که به‌طور کامل تحویل داده شده‌اند.' },
        'pf.c1tag': { en: 'Web App', fa: 'اپلیکیشن وب' },
        'pf.c1title': { en: 'Cloud Dashboard', fa: 'داشبورد کلاود' },
        'pf.c1desc': { en: 'Real-time infrastructure monitoring built for scale', fa: 'مانیتورینگ لحظه‌ای زیرساخت، ساخته‌شده برای مقیاس بزرگ' },
        'pf.c2tag': { en: 'Design System', fa: 'دیزاین سیستم' },
        'pf.c2title': { en: 'OWJ Component Kit', fa: 'کیت کامپوننت OWJ' },
        'pf.c2desc': { en: 'A unified library for shipping interfaces fast', fa: 'کتابخانه‌ای یکپارچه برای تولید سریع رابط‌ها' },
        'pf.c3tag': { en: 'SaaS', fa: 'سرویس ابری' },
        'pf.c3title': { en: 'Nightwatch Analytics', fa: 'نایت‌واچ آنالیتیکس' },
        'pf.c3desc': { en: 'Error tracking and performance insight', fa: 'ردیابی خطا و تحلیل عملکرد' },
        'pf.c4tag': { en: 'Open Source', fa: 'متن‌باز' },
        'pf.c4title': { en: 'Artisan CLI Tools', fa: 'ابزارهای CLI آرتیزان' },
        'pf.c4desc': { en: 'Developer tooling that automates the boring parts', fa: 'ابزارهای توسعه که کارهای تکراری را خودکار می‌کنند' },

        'stats.l1': { en: 'Projects delivered', fa: 'پروژه تحویل‌شده' },
        'stats.l2': { en: 'Client satisfaction', fa: 'رضایت مشتری' },

        'process.tag': { en: '✦ Our Process', fa: '✦ فرآیند کار ما' },
        'process.title': { en: 'How a project <span>comes together</span>', fa: 'چگونه یک پروژه <span>شکل می‌گیرد</span>' },
        'process.desc': { en: 'A straightforward process, kept transparent from kickoff to launch.', fa: 'فرآیندی ساده و شفاف، از شروع تا انتشار.' },
        'process.s1t': { en: 'Discover', fa: 'کشف' },
        'process.s1d': { en: 'We learn your goals, users, and constraints before writing a line of code.', fa: 'قبل از نوشتن حتی یک خط کد، اهداف، کاربران و محدودیت‌ها را می‌شناسیم.' },
        'process.s2t': { en: 'Design', fa: 'طراحی' },
        'process.s2d': { en: 'Wireframes and prototypes validate the direction early.', fa: 'وایرفریم و نمونه اولیه، مسیر را از همان ابتدا اعتبارسنجی می‌کنند.' },
        'process.s3t': { en: 'Build', fa: 'ساخت' },
        'process.s3d': { en: 'Iterative development with regular check-ins and demos.', fa: 'توسعه تکرارشونده همراه با بررسی‌ها و دموهای منظم.' },
        'process.s4t': { en: 'Launch', fa: 'انتشار' },
        'process.s4d': { en: 'We ship, monitor, and stay on to support what comes next.', fa: 'منتشر می‌کنیم، مانیتور می‌کنیم و برای ادامه مسیر کنار شما می‌مانیم.' },

        'ind.tag': { en: '✦ Industries', fa: '✦ صنایع' },
        'ind.title': { en: 'Sectors we <span>work in</span>', fa: 'حوزه‌هایی که در آن‌ها <span>فعالیت می‌کنیم</span>' },
        'ind.i1': { en: 'Healthcare', fa: 'سلامت' },
        'ind.i2': { en: 'Fintech', fa: 'فین‌تک' },
        'ind.i3': { en: 'E-commerce', fa: 'تجارت الکترونیک' },
        'ind.i4': { en: 'Education', fa: 'آموزش' },
        'ind.i5': { en: 'Logistics', fa: 'لجستیک' },
        'ind.i6': { en: 'Real Estate', fa: 'املاک' },

        'case.tag': { en: '✦ Case Studies', fa: '✦ مطالعات موردی' },
        'case.title': { en: 'Results, not just <span>deliverables</span>', fa: 'نتیجه، نه فقط <span>تحویل کار</span>' },
        'case.c1tag': { en: 'Fintech', fa: 'فین‌تک' },
        'case.c1title': { en: 'Nightwatch Analytics', fa: 'نایت‌واچ آنالیتیکس' },
        'case.c1desc': { en: 'Rebuilt an error-tracking platform to handle 10x the traffic without adding servers.', fa: 'بازسازی پلتفرم ردیابی خطا برای تحمل ۱۰ برابر ترافیک بدون افزودن سرور.' },
        'case.c1s1': { en: 'Throughput', fa: 'توان عملیاتی' },
        'case.c1s2': { en: 'Latency', fa: 'تأخیر' },
        'case.c2tag': { en: 'Healthcare', fa: 'سلامت' },
        'case.c2title': { en: 'Patient Portal Revamp', fa: 'بازطراحی پورتال بیماران' },
        'case.c2desc': { en: 'Redesigned a clinic booking flow, cutting no-shows through clearer reminders.', fa: 'بازطراحی فرآیند رزرو کلینیک و کاهش عدم‌حضور با یادآوری‌های واضح‌تر.' },
        'case.c2s1': { en: 'No-shows', fa: 'عدم‌حضور' },
        'case.c2s2': { en: 'Rating', fa: 'امتیاز' },
        'case.c3tag': { en: 'E-commerce', fa: 'تجارت الکترونیک' },
        'case.c3title': { en: 'Checkout Optimization', fa: 'بهینه‌سازی تسویه‌حساب' },
        'case.c3desc': { en: 'Simplified checkout for a mid-size retailer, recovering a meaningful share of drop-offs.', fa: 'ساده‌سازی تسویه‌حساب برای یک خرده‌فروش متوسط و بازیابی بخش قابل‌توجهی از خریدهای ناتمام.' },
        'case.c3s1': { en: 'Conversion', fa: 'نرخ تبدیل' },
        'case.c3s2': { en: 'Load time', fa: 'زمان بارگذاری' },

        'tech.tag': { en: '✦ Technologies', fa: '✦ فناوری‌ها' },
        'tech.title': { en: 'Our <span>tech stack</span>', fa: '<span>استک فناوری</span> ما' },
        'tech.desc': { en: 'Proven tools, chosen for the job rather than the trend.', fa: 'ابزارهایی اثبات‌شده، انتخاب‌شده برای کار، نه برای مد روز.' },

        'ach.tag': { en: '✦ Achievements', fa: '✦ دستاوردها' },
        'ach.title': { en: 'Recognition along <span>the way</span>', fa: 'قدردانی‌ها در <span>طول مسیر</span>' },
        'ach.a1t': { en: 'Top Agency 2025', fa: 'برترین آژانس ۲۰۲۵' },
        'ach.a1d': { en: "Recognized among the region's leading dev studios.", fa: 'شناخته‌شده در میان برترین استودیوهای توسعه منطقه.' },
        'ach.a2t': { en: '120+ Launches', fa: 'بیش از ۱۲۰ انتشار' },
        'ach.a2d': { en: 'Products shipped to production across industries.', fa: 'محصولات منتشرشده در صنایع مختلف.' },
        'ach.a3t': { en: 'ISO 27001', fa: 'ISO 27001' },
        'ach.a3d': { en: 'Certified for information security management.', fa: 'دارای گواهی مدیریت امنیت اطلاعات.' },
        'ach.a4t': { en: '4.9/5 Rating', fa: 'امتیاز ۴.۹ از ۵' },
        'ach.a4d': { en: 'Average client rating across completed projects.', fa: 'میانگین امتیاز مشتریان در پروژه‌های تکمیل‌شده.' },

        'art.tag': { en: '✦ Articles', fa: '✦ مقالات' },
        'art.title': { en: 'From the <span>blog</span>', fa: 'از <span>وبلاگ</span>' },
        'art.desc': { en: 'Notes on engineering, design, and building products that last.', fa: 'یادداشت‌هایی درباره مهندسی، طراحی و ساخت محصولاتی ماندگار.' },
        'art.c1cat': { en: 'Engineering', fa: 'مهندسی' },
        'art.c1t': { en: 'Scaling a monolith without a rewrite', fa: 'مقیاس‌دهی یک مونولیت بدون بازنویسی' },
        'art.c1d': { en: 'Practical steps for handling growth before you reach for microservices.', fa: 'گام‌های عملی برای مدیریت رشد پیش از رفتن به سراغ میکروسرویس‌ها.' },
        'art.c2cat': { en: 'Design', fa: 'طراحی' },
        'art.c2t': { en: 'Designing forms people actually finish', fa: 'طراحی فرم‌هایی که کاربران واقعاً تکمیل می‌کنند' },
        'art.c2d': { en: 'Small changes to layout and copy that cut abandonment rates.', fa: 'تغییرات کوچک در چیدمان و متن که نرخ رهاسازی را کاهش می‌دهد.' },
        'art.c3cat': { en: 'Product', fa: 'محصول' },
        'art.c3t': { en: 'Shipping a v1 in six weeks', fa: 'انتشار نسخه اول در شش هفته' },
        'art.c3d': { en: 'How we scope a first release without cutting the wrong corners.', fa: 'چگونه دامنه اولین انتشار را بدون حذف بخش‌های اشتباه تعیین می‌کنیم.' },

        'car.tag': { en: '✦ Careers', fa: '✦ فرصت‌های شغلی' },
        'car.title': { en: 'Join <span>the team</span>', fa: 'به <span>تیم</span> ملحق شوید' },
        'car.desc': { en: "We're a small, senior team — open roles come up as we grow.", fa: 'ما تیمی کوچک و باتجربه هستیم — با رشد تیم، موقعیت‌های جدید باز می‌شوند.' },
        'car.j1t': { en: 'Senior Frontend Engineer', fa: 'مهندس ارشد فرانت‌اند' },
        'car.j2t': { en: 'Backend Engineer (Node/PHP)', fa: 'مهندس بک‌اند (Node/PHP)' },
        'car.j3t': { en: 'Product Designer', fa: 'طراح محصول' },
        'car.remote': { en: 'Remote', fa: 'دورکاری' },
        'car.hybrid': { en: 'Hybrid', fa: 'ترکیبی' },
        'car.fulltime': { en: 'Full-time', fa: 'تمام‌وقت' },
        'car.contract': { en: 'Contract', fa: 'قراردادی' },
        'car.apply': { en: 'Apply →', fa: 'ارسال درخواست ←' },

        'ct.tag': { en: '✦ Contact', fa: '✦ تماس با ما' },
        'ct.title': { en: "Let's build <span>something</span>", fa: 'بیایید <span>چیزی</span> بسازیم' },
        'ct.desc': { en: 'Tell us about your project — we typically reply within one business day.', fa: 'درباره پروژه‌تان به ما بگویید — معمولاً ظرف یک روز کاری پاسخ می‌دهیم.' },
        'ct.email': { en: 'Email', fa: 'ایمیل' },
        'ct.email2': { en: 'Email', fa: 'ایمیل' },
        'ct.phone': { en: 'Phone', fa: 'تلفن' },
        'ct.office': { en: 'Office', fa: 'دفتر' },
        'ct.name': { en: 'Name', fa: 'نام' },
        'ct.namePh': { en: 'Your name', fa: 'نام شما' },
        'ct.msg': { en: 'Message', fa: 'پیام' },
        'ct.msgPh': { en: 'Tell us about your project...', fa: 'درباره پروژه‌تان بنویسید...' },
        'ct.send': { en: 'Send message', fa: 'ارسال پیام' },

        'footer.desc': { en: 'We design and build digital products — from strategy and UI to launch and long-term support.', fa: 'ما محصولات دیجیتال را طراحی و توسعه می‌دهیم — از استراتژی و UI تا انتشار و پشتیبانی بلندمدت.' },
        'footer.company.title': { en: 'Company', fa: 'شرکت' },
        'footer.company.l1': { en: 'About us', fa: 'درباره ما' },
        'footer.company.l2': { en: 'Careers', fa: 'فرصت‌های شغلی' },
        'footer.company.l3': { en: 'Blog', fa: 'وبلاگ' },
        'footer.company.l4': { en: 'Contact', fa: 'تماس با ما' },
        'footer.services.title': { en: 'Services', fa: 'خدمات' },
        'footer.services.l1': { en: 'Product Strategy', fa: 'استراتژی محصول' },
        'footer.services.l2': { en: 'UI / UX Design', fa: 'طراحی UI / UX' },
        'footer.services.l3': { en: 'Web Development', fa: 'توسعه وب' },
        'footer.services.l4': { en: 'Mobile Development', fa: 'توسعه موبایل' },
        'footer.resources.title': { en: 'Resources', fa: 'منابع' },
        'footer.resources.l1': { en: 'Documentation', fa: 'مستندات' },
        'footer.resources.l2': { en: 'Case Studies', fa: 'مطالعات موردی' },
        'footer.resources.l3': { en: 'Support', fa: 'پشتیبانی' },
        'footer.resources.l4': { en: 'Status', fa: 'وضعیت سرویس' },
        'footer.newsletter.title': { en: 'Stay in the loop', fa: 'در جریان باشید' },
        'footer.newsletter.desc': { en: 'Product notes and case studies, sent occasionally — no spam.', fa: 'یادداشت‌های محصول و مطالعات موردی، گاه‌به‌گاه ارسال می‌شود — بدون اسپم.' },
        'footer.newsletter.label': { en: 'Email address', fa: 'آدرس ایمیل' },
        'footer.newsletter.placeholder': { en: 'you@company.com', fa: 'you@company.com' },
        'footer.newsletter.btn': { en: 'Subscribe', fa: 'عضویت' },
        'footer.copyright': { en: '© 2026 OWJcode. All rights reserved.', fa: '© ۲۰۲۶ OWJcode. تمامی حقوق محفوظ است.' },
        'footer.legal.privacy': { en: 'Privacy Policy', fa: 'حریم خصوصی' },
        'footer.legal.terms': { en: 'Terms of Service', fa: 'شرایط استفاده' },
        'footer.legal.cookies': { en: 'Cookies', fa: 'کوکی‌ها' },
        'pgDet.back': { en: 'Back to portfolio', fa: 'بازگشت به نمونه‌کارها' },
        'pgDet.subtitle': { en: 'A real-time infrastructure monitoring platform we designed and built end-to-end for a fast-growing SaaS team.', fa: 'پلتفرم مانیتورینگ لحظه‌ای زیرساخت که برای یک تیم سریع‌الرشد SaaS به‌طور کامل طراحی و توسعه دادیم.' },
        'pgDet.visit': { en: 'Visit live site', fa: 'مشاهده سایت زنده' },
        'pgDet.overviewTitle': { en: 'Project overview', fa: 'نگاهی به پروژه' },
        'pgDet.p1': { en: 'Our client needed a way to watch infrastructure health across dozens of services without stitching together five different tools. We designed a single dashboard that pulls metrics, logs, and alerts into one real-time view.', fa: 'مشتری ما به راهی نیاز داشت تا سلامت زیرساخت را در ده‌ها سرویس رصد کند، بدون اینکه پنج ابزار مختلف را کنار هم بچیند. ما یک داشبورد واحد طراحی کردیم که متریک‌ها، لاگ‌ها و هشدارها را در یک نمای لحظه‌ای گرد هم می‌آورد.' },
        'pgDet.p2': { en: 'The interface had to stay calm under pressure — during an incident, engineers need signal, not noise. We spent as much time on what to leave out as on what to add, and the result is a tool the team actually keeps open all day.', fa: 'رابط کاربری باید در شرایط بحرانی هم آرام می‌ماند — در زمان حادثه، مهندسان به سیگنال نیاز دارند نه نویز. به همان اندازه که روی افزودن ویژگی‌ها وقت گذاشتیم، روی حذف‌کردن‌ها هم وقت گذاشتیم و نتیجه ابزاری شد که تیم واقعاً تمام روز باز نگه می‌دارد.' },
        'pgDet.p3': { en: 'Since launch, mean-time-to-detect for critical incidents has dropped noticeably, and the on-call team reports far fewer false alarms.', fa: 'از زمان انتشار، میانگین زمان شناسایی حوادث بحرانی به‌طور محسوسی کاهش یافته و تیم آن‌کال هشدارهای اشتباه بسیار کمتری گزارش می‌دهد.' },
        'pgDet.factsTitle': { en: 'Project facts', fa: 'اطلاعات پروژه' },
        'pgDet.client': { en: 'Client', fa: 'کارفرما' },
        'pgDet.industry': { en: 'Industry', fa: 'حوزه' },
        'pgDet.timeline': { en: 'Timeline', fa: 'بازه زمانی' },
        'pgDet.timelineVal': { en: '14 weeks', fa: '۱۴ هفته' },
        'pgDet.role': { en: 'Our role', fa: 'نقش ما' },
        'pgDet.roleVal': { en: 'Design &amp; Development', fa: 'طراحی و توسعه' },
        'pgDet.stackTitle': { en: 'Technologies', fa: 'فناوری‌ها' },
        'pgDet.teamTag': { en: '✦ The team', fa: '✦ تیم پروژه' },
        'pgDet.teamTitle': { en: 'Who built this', fa: 'چه کسانی این را ساختند' },
        'pgDet.simTag': { en: '✦ More work', fa: '✦ کارهای بیشتر' },
        'pgDet.simTitle': { en: 'Similar projects', fa: 'پروژه‌های مشابه' },

        // ===== Dynamic content (from database) =====
        'pgDet.title': { en: @json($portfolio->title_en ?: $portfolio->title), fa: @json($portfolio->title) },
        'pgDet.subtitle': { en: @json($portfolio->short_description_en ?: $portfolio->short_description), fa: @json($portfolio->short_description) },
        'pgDet.desc': { en: @json($portfolio->description_en ?: $portfolio->description), fa: @json($portfolio->description) },
        @foreach ($portfolio->teamMembers as $member)
        'tm.member{{ $member->id }}.name': { en: @json($member->name_en ?: $member->name), fa: @json($member->name) },
        'tm.member{{ $member->id }}.role': { en: @json($member->role_en ?: $member->role), fa: @json($member->role) },
        @endforeach
        @foreach ($similar as $item)
        'pf.item{{ $item->id }}.title': { en: @json($item->title_en ?: $item->title), fa: @json($item->title) },
        'pf.item{{ $item->id }}.desc': { en: @json($item->short_description_en ?: $item->short_description), fa: @json($item->short_description) },
        @endforeach
      };

      function setLang(lang){
        document.querySelectorAll('[data-i18n]').forEach(el => {
          const t = translations[el.dataset.i18n];
          if (t && t[lang]) el.textContent = t[lang];
        });
        document.querySelectorAll('[data-i18n-html]').forEach(el => {
          const t = translations[el.dataset.i18nHtml];
          if (t && t[lang]) el.innerHTML = t[lang];
        });
        document.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
          const t = translations[el.dataset.i18nPlaceholder];
          if (t && t[lang]) el.setAttribute('placeholder', t[lang]);
        });
        document.body.classList.toggle('lang-fa', lang === 'fa');
        document.documentElement.setAttribute('lang', lang);
        document.documentElement.setAttribute('dir', lang === 'fa' ? 'rtl' : 'ltr');
        document.querySelectorAll('.lang-switcher__item').forEach(item => {
          item.classList.toggle('active', item.dataset.lang === lang);
        });
      }

      document.querySelectorAll('.lang-switcher__item').forEach(item => {
        item.addEventListener('click', (e) => {
          e.preventDefault();
          setLang(item.dataset.lang);
          localStorage.setItem('site_lang', item.dataset.lang);
          const details = item.closest('details.lang-switcher');
          if (details) details.removeAttribute('open');
        });
      });

      setLang(localStorage.getItem('site_lang') || '{{ app()->getLocale() }}');
    })();
  </script>
</body>
</html>
