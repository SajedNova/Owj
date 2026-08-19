@extends('layouts.admin')

@section('pageTitle', 'دستاوردها')
@section('pageSubtitle', 'مدیریت دستاوردهای استودیو')

@section('content')
    <div class="content">
        <div class="section-head">
            <div>
                <h2>دستاوردها</h2>
                <p>لیست دستاوردهایی که در صفحه اصلی نمایش داده می‌شوند.</p>
            </div>
            <a href="{{ route('achievements.create') }}" class="btn btn-primary">افزودن دستاورد</a>
        </div>

        @if($achievements->isEmpty())
            <div class="panel empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                <strong>هنوز دستاوردی ثبت نشده است.</strong>
                <p>اولین دستاورد را اضافه کنید.</p>
            </div>
        @else
            <div class="panel">
                <div class="table-card">
                    <table>
                        <thead>
                            <tr>
                                <th>آیکون</th>
                                <th>عنوان</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($achievements as $achievement)
                                <tr>
                                    <td style="font-size: 24px;">{{ $achievement->icon }}</td>
                                    <td>{{ $achievement->title }}</td>
                                    <td>
                                        <div class="row-actions">
                                            <form action="{{ route('achievements.destroy', $achievement) }}" method="POST" id="delete-form-{{ $achievement->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="icon-action danger" onclick="confirmDelete({{ $achievement->id }})">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
