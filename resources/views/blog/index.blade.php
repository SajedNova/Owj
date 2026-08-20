@extends('layouts.public')

@section('content')



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
