@extends('layouts.app', ['title' => 'OWJcode — Digital Product Studio'])

@section('content')

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
@endsection
@push('scripts')
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
@endpush

