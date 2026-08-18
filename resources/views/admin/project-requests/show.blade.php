@extends('layouts.admin')

@section('title', 'جزئیات درخواست پروژه')
@section('subtitle', 'پیام ارسال‌شده توسط ' . $projectRequest->name)

@section('content')
    <div class="section-head">
        <div>
            <h2>{{ $projectRequest->name }}</h2>
            <p style="direction:ltr; text-align:left; display:inline-block;">{{ $projectRequest->email }}</p>
        </div>
        <a href="{{ route('project-requests.index') }}" class="btn btn-outline btn-sm">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 5l7 7-7 7"/></svg>
            بازگشت به لیست
        </a>
    </div>

    <div class="form-card">
        <h3>اطلاعات فرستنده</h3>
        <div class="field-row">
            <div class="field">
                <label>نام</label>
                <input type="text" value="{{ $projectRequest->name }}" readonly>
            </div>
            <div class="field">
                <label>ایمیل</label>
                <input type="text" value="{{ $projectRequest->email }}" readonly style="direction:ltr; text-align:left;">
            </div>
        </div>
        <div class="field-row">
            <div class="field">
                <label>تاریخ ارسال</label>
                <input type="text" value="{{ $projectRequest->created_at->format('Y/m/d H:i') }}" readonly>
            </div>
            <div class="field">
                <label>آدرس IP</label>
                <input type="text" value="{{ $projectRequest->ip_address ?? '—' }}" readonly style="direction:ltr; text-align:left;">
            </div>
        </div>
    </div>

    <div class="form-card">
        <h3>متن پیام</h3>
        <p style="white-space:pre-line; line-height:2; font-size:13.5px;">{{ $projectRequest->message }}</p>
    </div>

    <div class="form-actions">
        <form action="{{ route('project-requests.destroy', $projectRequest->id) }}" method="POST" id="delete-form-{{ $projectRequest->id }}">
            @csrf @method('DELETE')
            <button type="button" onclick="confirmDelete('{{ $projectRequest->id }}')" class="btn btn-outline" style="color:#e5484d; border-color:#e5484d;">
                حذف این درخواست
            </button>
        </form>
        <a href="mailto:{{ $projectRequest->email }}" class="btn btn-primary">
            پاسخ از طریق ایمیل
        </a>
    </div>
@endsection
