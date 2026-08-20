@extends('layouts.public')

@section('content')

    <section class="post-section" id="blog-post">

        <div class="post-back">
            <a href="{{ route('blog.index') }}" class="post-back__link">
                <span class="post-back__arrow">→</span>
                <span data-i18n="post.back">Back to articles</span>
            </a>
        </div>

        <header class="post-hero">
            @if($post->category_fa || $post->category_en)
                <span class="post-hero__cat"
                      data-fa="{{ $post->category_fa }}"
                      data-en="{{ $post->category_en ?: $post->category_fa }}">
                    {{ app()->getLocale() === 'fa' ? $post->category_fa : ($post->category_en ?: $post->category_fa) }}
                </span>
            @endif

            <h1 class="post-hero__title"
                data-fa="{{ $post->title_fa }}"
                data-en="{{ $post->title_en ?: $post->title_fa }}">
                {{ app()->getLocale() === 'fa' ? $post->title_fa : ($post->title_en ?: $post->title_fa) }}
            </h1>

            <div class="post-hero__meta">
                <span class="post-hero__date">
                    {{ $post->published_at?->format('Y/m/d') ?? $post->created_at->format('Y/m/d') }}
                </span>
                @if($post->reading_time ?? false)
                    <span class="post-hero__dot">•</span>
                    <span class="post-hero__read" data-i18n="post.readtime">{{ $post->reading_time }} min read</span>
                @endif
            </div>
        </header>

        @if($post->image)
            <div class="post-cover">
                <img
                    src="{{ $post->image_url ?? asset('storage/' . $post->image) }}"
                    alt="{{ $post->title_fa }}"
                    loading="lazy"
                >
            </div>
        @endif

        <article class="post-body">
            {{-- محتوای فارسی --}}
            <div class="lang-content lang-content--fa">
                {!! $post->content_fa !!}
            </div>
            {{-- محتوای انگلیسی --}}
            <div class="lang-content lang-content--en">
                {!! $post->content_en ?: $post->content_fa !!}
            </div>
        </article>

        @if(isset($relatedPosts) && $relatedPosts->count())
            <section class="post-related">
                <h2 class="post-related__title" data-i18n="post.related">More articles</h2>
                <div class="post-related__grid">
                    @foreach($relatedPosts as $related)
                        <a class="post-related__card" href="{{ route('blog.show', $related->slug) }}">
                            <div class="post-related__img">
                                <img
                                    src="{{ $related->image ? ($related->image_url ?? asset('storage/' . $related->image)) : 'https://picsum.photos/seed/' . $related->slug . '/600/400' }}"
                                    alt="{{ $related->title_fa }}"
                                    loading="lazy"
                                >
                            </div>
                            <div class="post-related__body">
                                <h3 data-fa="{{ $related->title_fa }}"
                                    data-en="{{ $related->title_en ?: $related->title_fa }}">
                                    {{ app()->getLocale() === 'fa' ? $related->title_fa : ($related->title_en ?: $related->title_fa) }}
                                </h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

    </section>
@endsection

@push('scripts')
    <style>
        .post-section {
            max-width: 820px;
            margin: 0 auto;
            padding: 40px 20px 60px;
        }

        .post-back {
            margin-bottom: 24px;
        }
        .post-back__link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #6b7280;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color .2s ease;
        }
        .post-back__link:hover { color: var(--brand-dark, #b51c1c); }
        .post-back__arrow {
            display: inline-block;
            transform: scaleX(-1); /* پیش‌فرض RTL: فلش رو به راست */
        }
        html[dir="ltr"] .post-back__arrow { transform: none; }

        .post-hero {
            text-align: center;
            margin-bottom: 28px;
        }
        .post-hero__cat {
            display: inline-block;
            background: var(--brand-dark, #b51c1c);
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 999px;
            margin-bottom: 14px;
        }
        .post-hero__title {
            font-size: clamp(24px, 5vw, 38px);
            line-height: 1.35;
            margin-bottom: 14px;
        }
        .post-hero__meta {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            color: #9aa4b2;
            font-size: 13.5px;
        }
        .post-hero__date { direction: ltr; }
        .post-hero__dot { opacity: .6; }

        .post-cover {
            width: 100%;
            aspect-ratio: 16 / 9;
            border-radius: 16px;
            overflow: hidden;
            background: #f1f1f1;
            margin-bottom: 32px;
            box-shadow: 0 4px 16px rgba(0,0,0,.08);
        }
        .post-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .post-body {
            font-size: 16.5px;
            line-height: 1.9;
            color: #1a1a2e;
        }
        .post-body p { margin: 0 0 20px; }
        .post-body h2, .post-body h3 { margin: 32px 0 14px; line-height: 1.4; }
        .post-body img { max-width: 100%; border-radius: 12px; margin: 20px 0; }
        .post-body ul, .post-body ol { margin: 0 0 20px; padding-inline-start: 24px; }
        .post-body blockquote {
            border-inline-start: 3px solid var(--brand-dark, #b51c1c);
            padding-inline-start: 16px;
            margin: 20px 0;
            color: #6b7280;
        }
        .post-body a { color: var(--brand-dark, #b51c1c); }
        .post-body pre {
            background: #1a1a2e;
            color: #f1f1f1;
            padding: 16px;
            border-radius: 10px;
            overflow-x: auto;
            margin: 20px 0;
        }

        /* سوییچ زبان بر اساس body.lang-fa (روی هدر کل سایت ست میشه) */
        .lang-content--en { display: block; }
        .lang-content--fa { display: none; }
        body.lang-fa .lang-content--en { display: none; }
        body.lang-fa .lang-content--fa { display: block; }

        .post-related {
            margin-top: 56px;
            padding-top: 32px;
            border-top: 1px solid #eceef1;
        }
        .post-related__title {
            font-size: 20px;
            margin-bottom: 20px;
        }
        .post-related__grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 18px;
        }
        .post-related__card {
            display: flex;
            flex-direction: column;
            border-radius: 12px;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            background: #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,.08);
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .post-related__card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,.1);
        }
        .post-related__img {
            width: 100%;
            aspect-ratio: 8 / 5;
            overflow: hidden;
            background: #f1f1f1;
        }
        .post-related__img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .post-related__body { padding: 12px 14px; }
        .post-related__body h3 {
            font-size: 14.5px;
            line-height: 1.4;
            margin: 0;
        }

        @media (max-width: 768px) {
            .post-section { padding: 32px 18px 48px; }
            .post-body { font-size: 15.5px; }
        }

        @media (max-width: 480px) {
            .post-section { padding: 24px 14px 40px; }
            .post-hero__title { font-size: 22px; }
            .post-cover { border-radius: 12px; margin-bottom: 24px; }
            .post-body { font-size: 15px; line-height: 1.8; }
            .post-related__grid { grid-template-columns: 1fr; }
        }
    </style>

    <script>
        // ===== Language switcher (English / فارسی) — صفحه تک‌مقاله =====
        (() => {
            const translations = {
                'post.back': { en: 'Back to articles', fa: 'بازگشت به مقالات' },
                'post.related': { en: 'More articles', fa: 'مقالات بیشتر' },
                'post.readtime': { en: 'min read', fa: 'دقیقه مطالعه' },
            };

            function setLang(lang) {
                document.querySelectorAll('[data-i18n]').forEach(el => {
                    const t = translations[el.dataset.i18n];
                    if (t && t[lang]) el.textContent = t[lang];
                });

                // محتوای پویا (عنوان، دسته‌بندی، مقالات مرتبط) — از data-fa / data-en
                document.querySelectorAll('#blog-post [data-fa], #blog-post [data-en]').forEach(el => {
                    const val = el.dataset[lang];
                    if (val !== undefined) el.textContent = val;
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
