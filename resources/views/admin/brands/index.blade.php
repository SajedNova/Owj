@extends('layouts.admin')

@section('pageTitle', 'برندهای همکاری')
@section('pageSubtitle', 'مدیریت لوگوی برندهای همکار')

@section('content')
    <div class="content">
        <div class="section-head">
            <div>
                <h2>برندهای همکاری</h2>
                <p>لوگوهایی که در صفحه اصلی نمایش داده می‌شوند.</p>
            </div>
            <a href="{{ route('brands.create') }}" class="btn btn-primary">افزودن برند</a>
        </div>

        @if($brands->isEmpty())
            <div class="panel empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                <strong>هنوز برندی ثبت نشده است.</strong>
                <p>اولین برند را اضافه کنید.</p>
            </div>
        @else
            <div class="panel">
                <div class="img-thumb-grid">
                    @foreach($brands as $brand)
                        <div class="img-thumb" style="display:flex; flex-direction:column; align-items:center; justify-content:center; padding:10px;">
                            <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" style="max-height:80px; width:auto;">
                            <form action="{{ route('brands.destroy', $brand) }}" method="POST" id="delete-form-{{ $brand->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="img-thumb__remove" onclick="confirmDelete({{ $brand->id }})">×</button>
                            </form>
                            <span style="font-size:11px; margin-top:8px;">{{ $brand->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
