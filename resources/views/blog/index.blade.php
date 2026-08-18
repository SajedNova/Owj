@extends('layouts.public')

@section('content')
<section class="blog-section" id="blog-list">
    <div class="blog-header">
        <h1>آخرین مقالات</h1>
        <p>یادداشت‌های مهندسی، طراحی و محصول از تیم ما.</p>
    </div>

    @if($posts->count())
        <div class="blog-grid">
            @foreach($posts as $post)
                <a class="blog-card" href="{{ route('blog.show', $post->slug) }}">
                    <div class="blog-card__img">
                        <img src="{{ $post->image ? $post->image_url : 'https://picsum.photos/seed/' . $post->slug . '/800/500' }}" alt="{{ $post->title }}" loading="lazy">
                        @if($post->category)
                            <span class="blog-card__cat">{{ $post->category }}</span>
                        @endif
                    </div>
                    <div class="blog-card__body">
                        <div class="blog-card__date">{{ $post->published_at?->format('Y/m/d') ?? $post->created_at->format('Y/m/d') }}</div>
                        <h3>{{ $post->title }}</h3>
                        <p>{{ $post->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($post->content), 110) }}</p>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="blog-pagination">
            {{ $posts->links() }}
        </div>
    @else
        <div class="blog-empty">هنوز هیچ مقاله‌ای منتشر نشده است.</div>
    @endif
</section>
@endsection
