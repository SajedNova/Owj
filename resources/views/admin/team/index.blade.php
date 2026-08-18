@extends('layouts.admin')

@section('pageTitle', 'اعضای تیم')
@section('pageSubtitle', 'مدیریت پروفایل اعضای تیم شرکت')

@section('content')
    <div class="section-head">
        <div>
            <h2>اعضای تیم</h2>
            <p>افراد تیم شرکت که در نمونه‌کارها می‌توانند مشارکت داشته باشند</p>
        </div>
        <a class="btn btn-primary" href="{{ route('team.create') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M12 5v14M5 12h14"/></svg>
            افزودن عضو
        </a>
    </div>

    <div class="team-grid">
        @forelse($teamMembers as $member)
            <div class="member-card">
                <div class="member-card__top">
                    <img class="member-card__avatar" src="{{ $member->avatar ? asset('storage/' . $member->avatar) : asset('storage/avatars/default-avatar.jpg') }}" onerror="this.style.visibility='hidden'">
                    <div>
                        <div class="member-card__name">{{ $member->name }}</div>
                        <div class="member-card__role">{{ $member->role }}</div>
                    </div>
                </div>
                <p class="member-card__bio">{{ $member->bio ?? 'بیوگرافی ثبت نشده.' }}</p>
                <div class="member-card__skills " >
                    @forelse($member->skills ?? [] as $skill)
                        <span class="chip">{{ $skill }}</span>
                    @empty
                        <span style="height: 15px;"></span>
                    @endforelse
                </div>
                <div class="member-card__actions">
                    <a class="btn btn-ghost btn-sm" href="{{ route('team.edit', $member) }}">ویرایش</a>
                    <form action="{{ route('team.destroy', $member) }}" method="POST" id="delete-form-{{ $member->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger-ghost btn-sm" style="width:100%;" onclick="confirmDelete({{ $member->id }})">حذف</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <p>عضوی پیدا نشد.</p>
            </div>
        @endforelse
    </div>
@endsection
