@extends('layouts.public')

@section('content')
<section class="single-section" id="single-post">
    <div class="blog-lang-switch">
        <a href="{{ route('lang.switch', 'fa') }}" class="{{ app()->getLocale() === 'fa' ? 'active' : '' }}">فارسی</a>
        <a href="{{ route('lang.switch', 'en') }}" class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">English</a>
    </div>

    <a href="{{ route('blog.index') }}" class="back-link">
        {{ app()->getLocale() === 'en' ? '\u2190 Back to blog' : '\u2192 بازگشت به وبلاگ' }}
    </a>

    <div class="single-header">
        <div class="meta">
            <span>{{ $post->published_at?->format('Y/m/d') ?? $post->created_at->format('Y/m/d') }}</span>
            @if($post->category())
                <span style="color:#f53003;font-weight:600;">{{ $post->category() }}</span>
            @endif
        </div>
        <h1>{{ $post->title() }}</h1>
    </div>

    <div class="single-hero">
        <img src="{{ $post->image ? $post->image_url : 'https://picsum.photos/seed/' . $post->slug . '/900/500' }}" alt="{{ $post->title() }}">
    </div>

    {{-- محتوا به صورت HTML رندر می‌شود؛ تصاویر داخل متن (که از ادیتور پنل ادمین درج شده‌اند)
         همینجا به‌صورت خودکار نمایش داده می‌شوند. --}}
    <div class="single-content">
        {!! $post->content() !!}
    </div>
</section>

@if($relatedPosts->count())
<section class="blog-section" style="padding-top:0;">
    <div class="blog-header" style="margin-bottom:24px;">
        <h1 style="font-size:24px;">{{ app()->getLocale() === 'en' ? 'Related articles' : 'مقالات مرتبط' }}</h1>
    </div>
    <div class="blog-grid">
        @foreach($relatedPosts as $related)
            <a class="blog-card" href="{{ route('blog.show', $related->slug) }}">
                <div class="blog-card__img">
                    <img src="{{ $related->image ? $related->image_url : 'https://picsum.photos/seed/' . $related->slug . '/800/500' }}" alt="{{ $related->title() }}" loading="lazy">
                    @if($related->category())
                        <span class="blog-card__cat">{{ $related->category() }}</span>
                    @endif
                </div>
                <div class="blog-card__body">
                    <div class="blog-card__date">{{ $related->published_at?->format('Y/m/d') ?? $related->created_at->format('Y/m/d') }}</div>
                    <h3>{{ $related->title() }}</h3>
                    <p>{{ $related->excerpt() ?? \Illuminate\Support\Str::limit(strip_tags($related->content()), 90) }}</p>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endif
@endsection

@section('scripts')
<style>
    .blog-lang-switch { display: flex; gap: 10px; margin-bottom: 14px; }
    .blog-lang-switch a {
        font-size: 12.5px; font-weight: 600; padding: 5px 12px; border-radius: 999px;
        background: #eef2f7; color: #5c6b7a; text-decoration: none;
    }
    .blog-lang-switch a.active { background: var(--brand-dark, #b51c1c); color: #fff; }
    /* تصاویر داخل متن پست ریسپانسیو باشند */
    .single-content img { max-width: 100%; height: auto; border-radius: 10px; margin: 12px 0; }
</style>
@endsection
