@extends('layouts.public')

@section('content')
<section class="single-section" id="single-post">
    <a href="{{ route('blog.index') }}" class="back-link">→ بازگشت به وبلاگ</a>

    <div class="single-header">
        <div class="meta">
            <span>{{ $post->published_at?->format('Y/m/d') ?? $post->created_at->format('Y/m/d') }}</span>
            @if($post->category)
                <span style="color:#f53003;font-weight:600;">{{ $post->category }}</span>
            @endif
        </div>
        <h1>{{ $post->title }}</h1>
    </div>

    <div class="single-hero">
        <img src="{{ $post->image ? $post->image_url : 'https://picsum.photos/seed/' . $post->slug . '/900/500' }}" alt="{{ $post->title }}">
    </div>

    <div class="single-content">
        {!! $post->content !!}
    </div>
</section>

@if($relatedPosts->count())
<section class="blog-section" style="padding-top:0;">
    <div class="blog-header" style="margin-bottom:24px;">
        <h1 style="font-size:24px;">مقالات مرتبط</h1>
    </div>
    <div class="blog-grid">
        @foreach($relatedPosts as $related)
            <a class="blog-card" href="{{ route('blog.show', $related->slug) }}">
                <div class="blog-card__img">
                    <img src="{{ $related->image ? $related->image_url : 'https://picsum.photos/seed/' . $related->slug . '/800/500' }}" alt="{{ $related->title }}" loading="lazy">
                    @if($related->category)
                        <span class="blog-card__cat">{{ $related->category }}</span>
                    @endif
                </div>
                <div class="blog-card__body">
                    <div class="blog-card__date">{{ $related->published_at?->format('Y/m/d') ?? $related->created_at->format('Y/m/d') }}</div>
                    <h3>{{ $related->title }}</h3>
                    <p>{{ $related->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($related->content), 90) }}</p>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endif
@endsection
