@extends('layouts.app', ['title' => 'OWJcode — Digital Product Studio'])



@section('content')

  <!-- ===== SCROLL CONTENT ===== -->
  <section class="hero">
    <!-- ===== LEFT: Content ===== -->
    <div class="hero__content">
      <!-- Tagline -->
      <div class="hero__tagline" data-i18n="hero.tagline">✦ The clean stack for Artisans and agents.</div>

      <!-- Main Heading -->
      <h1 class="hero__title" data-i18n="hero.title">
        {!! $hero->title_en !!}
      </h1>

      <!-- Description -->
      <p class="hero__desc" data-i18n="hero.desc">
        {{ $hero->description_en }}
      </p>

      <!-- Buttons -->
      <div class="hero__actions">
        <a href="#" class="hero__btn hero__btn--primary">
          <span data-i18n="hero.btn1">View Our Work</span>
          <span class="arrow">→</span>
        </a>
        <a href="#" class="hero__btn hero__btn--secondary">
          <span data-i18n="hero.btn2">Read Our Blog</span>
          <span class="arrow">→</span>
        </a>
      </div>


    </div>

    <!-- ===== RIGHT: Image ===== -->
    <div class="hero__image">
      <img
        src="{{ $hero->image ? asset('storage/' . $hero->image) : 'Screenshot 2026-08-16 203816.png' }}"
        alt="Laravel Illustration"
        loading="lazy"
      >
    </div>
  </section>

  @include('partials.home.logo-strip')

  <!-- ===== ABOUT US ===== -->
  <section class="nx-section" id="about">
    <div class="au-wrap">
      <div class="au-content">
        <div class="nx-header nx-left">
          <span class="nx-tag" data-i18n="about.tag">✦ About Us</span>
          <h2 data-fa="{{ $about->title }}" data-en="{{ $about->title_en }}">
            {{ app()->getLocale() === 'fa' ? $about->title : $about->title_en }}
          </h2>
        </div>
        <p data-fa="{{ $about->description }}" data-en="{{ $about->description_en }}">
          {{ app()->getLocale() === 'fa' ? $about->description : $about->description_en }}
        </p>
        <div class="au-stats">
          <div class="au-stat"><strong><span>{{ $about->years_experience }}+</span></strong><small data-i18n="about.stat1">Years building</small></div>
          <div class="au-stat"><strong><span>{{ $about->projects_shipped }}+</span></strong><small data-i18n="about.stat2">Projects shipped</small></div>
          <div class="au-stat"><strong><span>{{ $about->team_members }}+</span></strong><small data-i18n="about.stat3">Team members</small></div>
        </div>
      </div>
      <div class="au-visual"><img src="{{ asset('storage/' . $about->image) }}" alt="About Us"></div>
    </div>
  </section>

  <!-- ===== SERVICES ===== -->
  <section class="nx-section nx-section--alt" id="services">
    <div class="nx-header">
      <span class="nx-tag" data-i18n="services.tag">✦ Services</span>
      <h2 data-i18n-html="services.title">What we <span>do</span></h2>
      <p data-i18n="services.desc">End-to-end product delivery, from strategy to the code that ships.</p>
    </div>
    <div class="card-grid">
      @foreach($services as $service)
        <div class="card">
          <h3 data-fa="{{ $service->title }}" data-en="{{ $service->title_en }}">{{ app()->getLocale() === 'fa' ? $service->title : $service->title_en }}</h3>
          <p data-fa="{{ $service->description }}" data-en="{{ $service->description_en }}">{{ app()->getLocale() === 'fa' ? $service->description : $service->description_en }}</p>
        </div>
      @endforeach
    </div>
  </section>

 <div class="categories-content">
      <!-- Header -->
      <div class="categories-header">
        <span class="tag" data-i18n="cat.tag">✦ Categories</span>
        <h2 data-i18n-html="cat.title">Explore <span>top</span> topics</h2>
        <p data-i18n="cat.desc">Discover the most popular categories in our community</p>
      </div>

      <!-- Cards Grid -->
      <div class="categories-grid">
        <!-- Card 1 -->
        <div class="category-card">
          <h3 data-i18n="cat.c1t">Development</h3>
          <p data-i18n="cat.c1d">Web, mobile & software engineering</p>
          <span class="count"><strong>284</strong> <span data-i18n="cat.articles">articles</span></span>
        </div>

        <!-- Card 2 -->
        <div class="category-card">
          <h3 data-i18n="cat.c2t">Design</h3>
          <p data-i18n="cat.c2d">UI/UX, graphics & creative direction</p>
          <span class="count"><strong>192</strong> <span data-i18n="cat.articles">articles</span></span>
        </div>

        <!-- Card 3 -->
        <div class="category-card">
          <h3 data-i18n="cat.c3t">Data Science</h3>
          <p data-i18n="cat.c3d">Analytics, ML & AI innovations</p>
          <span class="count"><strong>156</strong> <span data-i18n="cat.articles">articles</span></span>
        </div>

        <!-- Card 4 -->
        <div class="category-card">
          <h3 data-i18n="cat.c4t">Cloud & DevOps</h3>
          <p data-i18n="cat.c4d">Infrastructure, deployment & scaling</p>
          <span class="count"><strong>203</strong> <span data-i18n="cat.articles">articles</span></span>
        </div>
      </div>
    </div>

  <!-- ===== PORTFOLIO (LIQUID GLASS) ===== -->
  <section class="pf-section" id="portfolio">
    <div class="pf-header">
      <span class="tag" data-i18n="pf.tag">✦ Portfolio</span>
      <h2 data-i18n-html="pf.title">Selected <span>work</span></h2>
      <p data-i18n="pf.desc">A few recent projects, shipped end-to-end.</p>
    </div>

    <div class="pf-grid">

        @forelse($portfolios as $portfolio)
            <article class="pf-card" data-seed="pf{{ $loop->iteration }}">
                <svg class="pf-card__warp" viewBox="0 0 480 360" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
                    <defs>
                        <filter id="pf-warp-{{ $loop->iteration }}" x="-20%" y="-20%" width="140%" height="140%">
                            <feTurbulence class="pf-card__turb" type="fractalNoise" baseFrequency="0.012 0.02" numOctaves="2" seed="{{ $loop->iteration * 7 }}" result="noise"/>
                            <feDisplacementMap class="pf-card__disp" in="SourceGraphic" in2="noise" scale="0" xChannelSelector="R" yChannelSelector="G"/>
                        </filter>
                    </defs>
                    <image href="{{ asset('storage/' . $portfolio->mainImage->url) }}" x="0" y="0" width="480" height="360" preserveAspectRatio="xMidYMid slice" filter="url(#pf-warp-{{ $loop->iteration }})"/>
                </svg>
                <span class="pf-card__tag">{{ $portfolio->category }}</span>
                <div class="pf-card__panel">
                    <h3 class="pf-card__title"
                        data-fa="{{ $portfolio->title }}"
                        data-en="{{ $portfolio->title_en }}">
                        {{ app()->getLocale() === 'fa' ? $portfolio->title : $portfolio->title_en }}
                    </h3>
                    <p class="pf-card__desc"
                       data-fa="{{ $portfolio->short_description }}"
                       data-en="{{ $portfolio->short_description_en }}">
                        {{ app()->getLocale() === 'fa' ? $portfolio->short_description : $portfolio->short_description_en }}
                    </p>
                </div>
            </article>
        @empty
            <p>هیچ نمونه کاری موجود نیست</p>
        @endforelse


    </div>
  </section>

  <!-- ===== COMPANY STATISTICS ===== -->
  <section class="nx-section nx-section--alt" id="stats">
    <div class="cs-grid">
      <div class="cs-box"><span class="num">{{ $about->projects_shipped }}+</span><span class="lbl" data-i18n="stats.l1">Projects delivered</span></div>
      <div class="cs-box"><span class="num">{{ $about->team_members }}+</span><span class="lbl" data-i18n="stats.l2">Team Members</span></div>
    </div>
  </section>

  <!-- ===== OUR PROCESS ===== -->
  <section class="nx-section" id="process">
    <div class="nx-header">
      <span class="nx-tag" data-i18n="process.tag">✦ Our Process</span>
      <h2 data-i18n-html="process.title">How a project <span>comes together</span></h2>
      <p data-i18n="process.desc">A straightforward process, kept transparent from kickoff to launch.</p>
    </div>
    <div class="op-steps">
      <div class="op-step"><span class="op-num">01</span><h3 data-i18n="process.s1t">Discover</h3><p data-i18n="process.s1d">We learn your goals, users, and constraints before writing a line of code.</p></div>
      <div class="op-step"><span class="op-num">02</span><h3 data-i18n="process.s2t">Design</h3><p data-i18n="process.s2d">Wireframes and prototypes validate the direction early.</p></div>
      <div class="op-step"><span class="op-num">03</span><h3 data-i18n="process.s3t">Build</h3><p data-i18n="process.s3d">Iterative development with regular check-ins and demos.</p></div>
      <div class="op-step"><span class="op-num">04</span><h3 data-i18n="process.s4t">Launch</h3><p data-i18n="process.s4d">We ship, monitor, and stay on to support what comes next.</p></div>
    </div>
  </section>

  <!-- ===== INDUSTRIES ===== -->
  <section class="nx-section nx-section--alt" id="industries">
    <div class="nx-header">
      <span class="nx-tag" data-i18n="ind.tag">✦ Industries</span>
      <h2 data-i18n-html="ind.title">Sectors we <span>work in</span></h2>
    </div>
    <div class="ind-grid">
      <div class="ind-box"><span class="ic">🏥</span><span data-i18n="ind.i1">Healthcare</span></div>
      <div class="ind-box"><span class="ic">💳</span><span data-i18n="ind.i2">Fintech</span></div>
      <div class="ind-box"><span class="ic">🛒</span><span data-i18n="ind.i3">E-commerce</span></div>
      <div class="ind-box"><span class="ic">🎓</span><span data-i18n="ind.i4">Education</span></div>
      <div class="ind-box"><span class="ic">🏭</span><span data-i18n="ind.i5">Logistics</span></div>
      <div class="ind-box"><span class="ic">🏢</span><span data-i18n="ind.i6">Real Estate</span></div>
    </div>
  </section>

  <!-- ===== CASE STUDIES ===== -->
  <section class="nx-section" id="case-studies">
    <div class="nx-header">
      <span class="nx-tag" data-i18n="case.tag">✦ Case Studies</span>
      <h2 data-i18n-html="case.title">Results, not just <span>deliverables</span></h2>
    </div>
    <div class="case-grid">
      <article class="case-card">
        <div class="case-card__top">
          <span class="case-card__tag" data-i18n="case.c1tag">Fintech</span>
          <h3 data-i18n="case.c1title">Nightwatch Analytics</h3>
          <p data-i18n="case.c1desc">Rebuilt an error-tracking platform to handle 10x the traffic without adding servers.</p>
        </div>
        <div class="case-card__stats"><div><strong>10x</strong><small data-i18n="case.c1s1">Throughput</small></div><div><strong>-40%</strong><small data-i18n="case.c1s2">Latency</small></div></div>
      </article>
      <article class="case-card">
        <div class="case-card__top">
          <span class="case-card__tag" data-i18n="case.c2tag">Healthcare</span>
          <h3 data-i18n="case.c2title">Patient Portal Revamp</h3>
          <p data-i18n="case.c2desc">Redesigned a clinic booking flow, cutting no-shows through clearer reminders.</p>
        </div>
        <div class="case-card__stats"><div><strong>-28%</strong><small data-i18n="case.c2s1">No-shows</small></div><div><strong>4.8/5</strong><small data-i18n="case.c2s2">Rating</small></div></div>
      </article>
      <article class="case-card">
        <div class="case-card__top">
          <span class="case-card__tag" data-i18n="case.c3tag">E-commerce</span>
          <h3 data-i18n="case.c3title">Checkout Optimization</h3>
          <p data-i18n="case.c3desc">Simplified checkout for a mid-size retailer, recovering a meaningful share of drop-offs.</p>
        </div>
        <div class="case-card__stats"><div><strong>+22%</strong><small data-i18n="case.c3s1">Conversion</small></div><div><strong>-1.2s</strong><small data-i18n="case.c3s2">Load time</small></div></div>
      </article>
    </div>
  </section>



  <!-- ===== TEAM ===== -->
  @include('partials.team-slider')

  <!-- ===== TECHNOLOGIES ===== -->
  <section class="nx-section nx-section--alt" id="technologies">
      <div class="nx-header">
          <span class="nx-tag" data-i18n="tech.tag">✦ Technologies</span>
          <h2 data-i18n-html="tech.title">Our <span>tech stack</span></h2>
          <p data-i18n="tech.desc">Proven tools, chosen for the job rather than the trend.</p>
      </div>
      <div class="tech-grid">
          @forelse($technologies as $technology)
              <div class="tech-box">
                  <span class="ic">{{ $technology->icon }}</span>
                  <span>
                {{ $technology->name }}
          </span>
              </div>
          @empty
              <p style="color:rgba(26,26,46,0.4);">هنوز فناوری‌ای ثبت نشده.</p>
          @endforelse
      </div>
  </section>


  <!-- ===== ACHIEVEMENTS ===== -->
  <section class="nx-section" id="achievements">
      <div class="nx-header">
          <span class="nx-tag" data-i18n="ach.tag">✦ Achievements</span>
          <h2 data-i18n-html="ach.title">Recognition along <span>the way</span></h2>
      </div>
      <div class="ach-grid">
          @forelse($achievements as $achievement)
              <div class="ach-card">
                  <span class="ic">{{ $achievement->icon }}</span>
                  <h3 data-fa="{{ $achievement->title }}"
                      data-en="{{ $achievement->title_en }}">
                      {{ app()->getLocale() === 'fa' ? $achievement->title : $achievement->title_en }}
                  </h3>
                  <p data-fa="{{ $achievement->description }}"
                     data-en="{{ $achievement->description_en }}">
                      {{ app()->getLocale() === 'fa' ? $achievement->description : $achievement->description_en }}
                  </p>
              </div>
          @empty
              <p style="color:rgba(26,26,46,0.4);">هنوز دستاوردی ثبت نشده.</p>
          @endforelse
      </div>
  </section>

  <!-- ===== ARTICLES ===== -->
  <section class="nx-section nx-section--alt" id="articles">
    <div class="nx-header">
      <span class="nx-tag" data-i18n="art.tag">✦ Articles</span>
      <h2 data-i18n-html="art.title">From the <span>blog</span></h2>
      <p data-i18n="art.desc">Notes on engineering, design, and building products that last.</p>
    </div>
    <div class="art-grid">
      <article class="art-card">
        <div class="art-card__img"><span class="art-card__cat" data-i18n="art.c1cat">Engineering</span></div>
        <div class="art-card__body">
          <div class="art-card__date">Jul 12, 2026</div>
          <h3 data-i18n="art.c1t">Scaling a monolith without a rewrite</h3>
          <p data-i18n="art.c1d">Practical steps for handling growth before you reach for microservices.</p>
        </div>
      </article>
      <article class="art-card">
        <div class="art-card__img"><span class="art-card__cat" data-i18n="art.c2cat">Design</span></div>
        <div class="art-card__body">
          <div class="art-card__date">Jun 28, 2026</div>
          <h3 data-i18n="art.c2t">Designing forms people actually finish</h3>
          <p data-i18n="art.c2d">Small changes to layout and copy that cut abandonment rates.</p>
        </div>
      </article>
      <article class="art-card">
        <div class="art-card__img"><span class="art-card__cat" data-i18n="art.c3cat">Product</span></div>
        <div class="art-card__body">
          <div class="art-card__date">Jun 3, 2026</div>
          <h3 data-i18n="art.c3t">Shipping a v1 in six weeks</h3>
          <p data-i18n="art.c3d">How we scope a first release without cutting the wrong corners.</p>
        </div>
      </article>
    </div>
  </section>

  <!-- ===== CAREERS ===== -->
  <section class="nx-section" id="careers">
    <div class="nx-header">
      <span class="nx-tag" data-i18n="car.tag">✦ Careers</span>
      <h2 data-i18n-html="car.title">Join <span>the team</span></h2>
      <p data-i18n="car.desc">We're a small, senior team — open roles come up as we grow.</p>
    </div>
    <div class="car-list">
      <div class="car-item">
        <div class="car-item__info"><h3 data-i18n="car.j1t">Senior Frontend Engineer</h3><div class="car-item__meta"><span data-i18n="car.remote">Remote</span><span data-i18n="car.fulltime">Full-time</span></div></div>
        <a href="#contact" class="car-item__btn" data-i18n="car.apply">Apply →</a>
      </div>
      <div class="car-item">
        <div class="car-item__info"><h3 data-i18n="car.j2t">Backend Engineer (Node/PHP)</h3><div class="car-item__meta"><span data-i18n="car.hybrid">Hybrid</span><span data-i18n="car.fulltime">Full-time</span></div></div>
        <a href="#contact" class="car-item__btn" data-i18n="car.apply">Apply →</a>
      </div>
      <div class="car-item">
        <div class="car-item__info"><h3 data-i18n="car.j3t">Product Designer</h3><div class="car-item__meta"><span data-i18n="car.remote">Remote</span><span data-i18n="car.contract">Contract</span></div></div>
        <a href="#contact" class="car-item__btn" data-i18n="car.apply">Apply →</a>
      </div>
    </div>
  </section>

  <!-- ===== CONTACT ===== -->
  <section class="nx-section nx-section--alt" id="contact">
    <div class="nx-header">
      <span class="nx-tag" data-i18n="ct.tag">✦ Contact</span>
      <h2 data-i18n-html="ct.title">Let's build <span>something</span></h2>
      <p data-i18n="ct.desc">Tell us about your project — we typically reply within one business day.</p>
    </div>
    <div class="ct-wrap">
      <div class="ct-info">
        @if($siteSetting->email)
          <div class="ct-info-item"><span class="ic">✉</span><div><h4 data-i18n="ct.email">Email</h4><p>{{ $siteSetting->email }}</p></div></div>
        @endif
        @if($siteSetting->phone)
          <div class="ct-info-item"><span class="ic">☎</span><div><h4 data-i18n="ct.phone">Phone</h4><p>{{ $siteSetting->phone }}</p></div></div>
        @endif
        @if($siteSetting->address)
          <div class="ct-info-item"><span class="ic">📍</span><div><h4 data-i18n="ct.office">Office</h4><p>{{ $siteSetting->address }}</p></div></div>
        @endif
      </div>
      @include('partials.contact-form')
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

    // ===== Language switcher (English / فارسی) =====
    (() => {
      const translations = {
        'nav.tag': { en: 'tame', fa: 'دقیق' },
        'nav.framework': { en: 'Framework', fa: 'چارچوب' },
        'nav.products': { en: 'Products', fa: 'محصولات' },
        'nav.resources': { en: 'Resources', fa: 'منابع' },
        'nav.events': { en: 'Events', fa: 'رویدادها' },
        'nav.docs': { en: 'Docs', fa: 'مستندات' },

          'hero.tagline': {
              en: '✦ Where ideas become elegant software',
              fa: '✦ جایی که ایده‌ها به نرم‌افزاری زیبا تبدیل می‌شوند'
          },

          'hero.title': {
              en: @json($hero->title_en ),
              fa: @json($hero->title)
          },

          'hero.desc': {
              en: @json($hero->description_en ),
              fa: @json($hero->description )
          },

          'hero.btn1': {
              en: 'View Our Work',
              fa: 'مشاهده نمونه‌کارها'
          },

          'hero.btn2': {
              en: 'Read Our Blog',
              fa: 'مشاهده وبلاگ'
          },

          'hero.deploySeconds': {
              en: '— We build, you grow',
              fa: '— ما می‌سازیم، شما رشد می‌کنید'
          },

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
        'stats.l2': { en: 'Team Members', fa: 'اعضای تیم' },

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
      };

      function setLang(lang){
        // Existing static translations...
        // Add dynamic elements
        document.querySelectorAll('#about [data-fa], #about [data-en], #services [data-fa], #services [data-en], #portfolio [data-fa], #portfolio [data-en], #achievements [data-fa], #achievements [data-en]').forEach(el => {
          el.textContent = el.dataset[lang];
        });

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
          const details = item.closest('details.lang-switcher');
          if (details) details.removeAttribute('open');
        });
      });
    })();
  </script>
@endpush
