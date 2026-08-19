@extends('layouts.admin')

@section('pageTitle', 'تکنولوژی‌ها')
@section('pageSubtitle', 'مدیریت تکنولوژی‌های مورد استفاده')

@section('content')
    <div class="content">
        <div class="section-head">
            <div>
                <h2>تکنولوژی‌ها</h2>
                <p>لیست تکنولوژی‌هایی که در صفحه اصلی نمایش داده می‌شوند.</p>
            </div>
            <a href="{{ route('technologies.create') }}" class="btn btn-primary">افزودن تکنولوژی</a>
        </div>

        @if($technologies->isEmpty())
            <div class="panel empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                <strong>هنوز تکنولوژی ثبت نشده است.</strong>
                <p>اولین تکنولوژی را اضافه کنید.</p>
            </div>
        @else
            <div class="panel">
                <div class="table-card">
                    <table>
                        <thead>
                            <tr>
                                <th>آیکون</th>
                                <th>نام</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($technologies as $technology)
                                <tr>
                                    <td style="font-size: 24px;">{{ $technology->icon }}</td>
                                    <td>{{ $technology->name }}</td>
                                    <td>
                                        <div class="row-actions">
                                            <form action="{{ route('technologies.destroy', $technology) }}" method="POST" id="delete-form-{{ $technology->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="icon-action danger" onclick="confirmDelete({{ $technology->id }})">
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
