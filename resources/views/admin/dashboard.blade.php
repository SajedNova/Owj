@extends('layouts.admin')

@section('pageTitle', 'داشبورد')
@section('pageSubtitle', 'نمای کلی از نمونه‌کارها و اعضای تیم')

@section('content')
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-card__icon" style="background:var(--brand-soft); color:var(--brand-dark);">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
            </div>
            <div class="stat-card__value">{{ $stats['totalPortfolios'] }}</div>
            <div class="stat-card__label">کل نمونه‌کارها</div>
        </div>
        <div class="stat-card">
            <div class="stat-card__icon" style="background:var(--ok-soft); color:var(--ok);">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6 9 17l-5-5"/></svg>
            </div>
            <div class="stat-card__value">{{ $stats['publishedPortfolios'] }}</div>
            <div class="stat-card__label">منتشرشده</div>
        </div>
        <div class="stat-card">
            <div class="stat-card__icon" style="background:rgba(26,26,46,.08); color:var(--navy);">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div class="stat-card__value">{{ $stats['totalTeamMembers'] }}</div>
            <div class="stat-card__label">اعضای تیم</div>
        </div>
        <div class="stat-card">
            <div class="stat-card__icon" style="background:rgba(59,130,246,.1); color:#2563eb;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/></svg>
            </div>
            <div class="stat-card__value">{{ $stats['totalImages'] }}</div>
            <div class="stat-card__label">تصاویر گالری</div>
        </div>
    </div>

    <div class="dash-grid">
        <div class="panel">
            <h3>آخرین نمونه‌کارها</h3>
            @forelse($recentPortfolios as $portfolio)
                <div class="mini-row">
                    @if($portfolio->mainImage)
                        <img class="mini-thumb" src="{{ $portfolio->mainImage->url }}" onerror="this.style.visibility='hidden'">
                    @else
                        <div class="mini-thumb" style="background:#eee;"></div>
                    @endif
                    <div class="mini-info">
                        <strong>{{ $portfolio->title }}</strong>
                        <span>{{ $portfolio->category }} {{ $portfolio->client_name ? '· ' . $portfolio->client_name : '' }}</span>
                    </div>
                    <span class="pill {{ $portfolio->is_published ? 'pill-ok' : 'pill-off' }}">{{ $portfolio->is_published ? 'منتشرشده' : 'پیش‌نویس' }}</span>
                </div>
            @empty
                <span class="field-hint">هنوز نمونه‌کاری ثبت نشده.</span>
            @endforelse
        </div>
        <div class="panel">
            <h3>اعضای تیم</h3>
            @forelse($recentTeamMembers as $member)
                <div class="mini-row">
                    <img class="mini-thumb" style="border-radius:50%;" src="{{ $member->avatar ? asset('storage/' . $member->avatar) : asset('storage/avatars/default-avatar.jpg') }}" onerror="this.style.visibility='hidden'">
                    <div class="mini-info">
                        <strong>{{ $member->name }}</strong>
                        <span>{{ $member->role }}</span>
                    </div>
                </div>
            @empty
                <span class="field-hint">هنوز عضوی ثبت نشده.</span>
            @endforelse
        </div>
    </div>
@endsection
