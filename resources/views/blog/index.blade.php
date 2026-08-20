@extends('layouts.public')

@section('content')

    <section class="blog-section" id="blog-list">
        <div class="blog-header">
            <h1 data-i18n="blog.title">Latest Articles</h1>
            <p data-i18n="blog.desc">Engineering, design and product notes from our team.</p>
        </div>

        @if($posts->count())
            <div class="blog-grid">
                @foreach($posts as $post)
                    <a class="blog-card" href="{{ route('blog.show', $post->slug) }}" data-seed="post{{ $post->id }}">
                        <div class="blog-card__img">
                            <img
                                src="{{ $post->image ? $post->image_url : 'https://picsum.photos/seed/' . $post->slug . '/800/500' }}"
                                alt="{{ $post->title_fa }}"
                                loading="lazy"
                                width="800" height="500"
                            >
                            @if($post->category_fa || $post->category_en)
                                <span class="blog-card__cat"
                                      data-fa="{{ $post->category_fa }}"
                                      data-en="{{ $post->category_en ?: $post->category_fa }}">
                                    {{ app()->getLocale() === 'fa' ? $post->category_fa : ($post->category_en ?: $post->category_fa) }}
                                </span>
                            @endif
                        </div>
                        <div class="blog-card__body">
                            <div class="blog-card__date">{{ $post->published_at?->format('Y/m/d') ?? $post->created_at->format('Y/m/d') }}</div>
                            <h3 data-fa="{{ $post->title_fa }}"
                                data-en="{{ $post->title_en ?: $post->title_fa }}">
                                {{ app()->getLocale() === 'fa' ? $post->title_fa : ($post->title_en ?: $post->title_fa) }}
                            </h3>
                            <p data-fa="{{ $post->excerpt_fa ?? \Illuminate\Support\Str::limit(strip_tags($post->content_fa), 110) }}"
                               data-en="{{ $post->excerpt_en ?? \Illuminate\Support\Str::limit(strip_tags($post->content_en ?: $post->content_fa), 110) }}">
                                {{ app()->getLocale() === 'fa'
                                    ? ($post->excerpt_fa ?? \Illuminate\Support\Str::limit(strip_tags($post->content_fa), 110))
                                    : ($post->excerpt_en ?? \Illuminate\Support\Str::limit(strip_tags($post->content_en ?: $post->content_fa), 110)) }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="blog-pagination">
                {{ $posts->onEachSide(1)->links() }}
            </div>
        @else
            <div class="blog-empty" data-i18n="blog.empty">No articles published yet.</div>
        @endif
    </section>
@endsection

@push('scripts')
    <style>
        .blog-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .blog-header {
            text-align: center;
            margin-bottom: 32px;
        }
        .blog-header h1 {
            font-size: clamp(22px, 4vw, 32px);
            margin-bottom: 8px;
        }
        .blog-header p {
            color: #6b7280;
            font-size: clamp(14px, 2vw, 16px);
        }

        /* ریسپانسیو با auto-fill، بدون مدیا کوئری جدا برای هر سایز */
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 24px;
        }

        .blog-card {
            display: flex;
            flex-direction: column;
            border-radius: 14px;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            background: #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,.08);
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .blog-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,.1);
        }

        .blog-card__img {
            position: relative;
            width: 100%;
            aspect-ratio: 8 / 5;
            overflow: hidden;
            background: #f1f1f1;
        }
        .blog-card__img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .blog-card__cat {
            position: absolute;
            top: 10px;
            inset-inline-start: 10px; /* خودکار سمت راست/چپ می‌شود در RTL/LTR */
            background: var(--brand-dark, #b51c1c);
            color: #fff;
            font-size: 11.5px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 999px;
        }

        .blog-card__body {
            padding: 16px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .blog-card__date {
            font-size: 12.5px;
            color: #9aa4b2;
            margin-bottom: 6px;
            direction: ltr;
            text-align: start;
        }
        .blog-card__body h3 {
            font-size: 17px;
            line-height: 1.4;
            margin-bottom: 8px;
        }
        .blog-card__body p {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.6;
            margin: 0;
        }

        .blog-pagination {
            margin-top: 32px;
            display: flex;
            justify-content: center;
        }
        .blog-pagination nav {
            direction: ltr; /* شماره صفحات همیشه چپ‌به‌راست */
        }

        .blog-empty {
            text-align: center;
            padding: 60px 20px;
            color: #9aa4b2;
            font-size: 15px;
        }

        @media (max-width: 768px) {
            .blog-grid { grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 20px; }
        }

        @media (max-width: 480px) {
            .blog-section { padding: 24px 14px; }
            .blog-grid { grid-template-columns: 1fr; gap: 18px; }
            .blog-card__body { padding: 14px; }
            .blog-card__body h3 { font-size: 16px; }
        }
    </style>

    <script>
        // ===== Language switcher (English / فارسی) — بخش وبلاگ =====
        (() => {
            const translations = {
                'blog.title': { en: 'Latest Articles', fa: 'آخرین مقالات' },
                'blog.desc': { en: 'Engineering, design and product notes from our team.', fa: 'یادداشت‌های مهندسی، طراحی و محصول از تیم ما.' },
                'blog.empty': { en: 'No articles published yet.', fa: 'هنوز هیچ مقاله‌ای منتشر نشده است.' },
            };

            function setLang(lang) {
                // متن‌های ثابت صفحه
                document.querySelectorAll('[data-i18n]').forEach(el => {
                    const t = translations[el.dataset.i18n];
                    if (t && t[lang]) el.textContent = t[lang];
                });
                document.querySelectorAll('[data-i18n-html]').forEach(el => {
                    const t = translations[el.dataset.i18nHtml];
                    if (t && t[lang]) el.innerHTML = t[lang];
                });

                // محتوای پویا (کارت‌های وبلاگ) — از data-fa / data-en
                document.querySelectorAll('#blog-list [data-fa], #blog-list [data-en]').forEach(el => {
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

            // زبان اولیه: آخرین انتخاب کاربر، وگرنه لوکیل فعلی سایت
            setLang(localStorage.getItem('site_lang') || '{{ app()->getLocale() }}');
        })();
    </script>
@endpush
