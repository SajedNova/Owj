@extends('layouts.public')

@section('content')



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
                    <a  href="{{ route('lang.switch', 'en') }}" class="lang-switcher__item" role="menuitem" data-lang="en">
                        <span class="flag">🇺🇸</span>
                        <span class="lang-name"><img src="us.svg" alt="" style="border-radius: 5px;margin-top: 10px;"></span>
                    </a>

                    <a href="{{ route('lang.switch', 'fa') }}" class="lang-switcher__item" role="menuitem" data-lang="fa">
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



    <section class="blog-section" id="blog-list">
    <div class="blog-header">


        @if(app()->getLocale() === 'en')
            <h1>Latest Articles</h1>
            <p>Engineering, design and product notes from our team.</p>
        @else
            <h1>آخرین مقالات</h1>
            <p>یادداشت‌های مهندسی، طراحی و محصول از تیم ما.</p>
        @endif
    </div>

    @if($posts->count())
        <div class="blog-grid">
            @foreach($posts as $post)
                <a class="blog-card" href="{{ route('blog.show', $post->slug) }}">
                    <div class="blog-card__img">
                        <img src="{{ $post->image ? $post->image_url : 'https://picsum.photos/seed/' . $post->slug . '/800/500' }}" alt="{{ $post->title() }}" loading="lazy">
                        @if($post->category())
                            <span class="blog-card__cat">{{ $post->category() }}</span>
                        @endif
                    </div>
                    <div class="blog-card__body">
                        <div class="blog-card__date">{{ $post->published_at?->format('Y/m/d') ?? $post->created_at->format('Y/m/d') }}</div>
                        <h3>{{ $post->title() }}</h3>
                        <p>{{ $post->excerpt() ?? \Illuminate\Support\Str::limit(strip_tags($post->content()), 110) }}</p>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="blog-pagination">
            {{ $posts->links() }}
        </div>
    @else
        <div class="blog-empty">
            {{ app()->getLocale() === 'en' ? 'No articles published yet.' : 'هنوز هیچ مقاله‌ای منتشر نشده است.' }}
        </div>
    @endif
</section>
@endsection

@section('scripts')
<style>
    .blog-lang-switch { display: flex; gap: 10px; margin-bottom: 10px; }
    .blog-lang-switch a {
        font-size: 12.5px; font-weight: 600; padding: 5px 12px; border-radius: 999px;
        background: #eef2f7; color: #5c6b7a; text-decoration: none;
    }
    .blog-lang-switch a.active { background: var(--brand-dark, #b51c1c); color: #fff; }
</style>
@endsection
