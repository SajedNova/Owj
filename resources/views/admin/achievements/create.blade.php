@extends('layouts.admin')

@section('pageTitle', 'افزودن دستاورد')
@section('pageSubtitle', 'افزودن دستاورد جدید استودیو')

@section('content')
    <div class="content content--form">
        <form action="{{ route('achievements.store') }}" method="POST">
            @csrf

            <div class="form-card">
                <h3>اطلاعات دستاورد</h3>
                <div class="field">
                    <label for="icon">آیکون (ایموجی)</label>
                    <input type="text" id="icon" name="icon" value="{{ old('icon') }}" placeholder="مثلا: 🏆" required>
                    @error('icon') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                </div>

                <div class="field-row">
                    <div class="field">
                        <label for="title">عنوان (فارسی)</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="field">
                        <label for="title_en">عنوان (انگلیسی)</label>
                        <input type="text" id="title_en" name="title_en" value="{{ old('title_en') }}" style="direction:ltr; text-align:left;">
                        @error('title_en') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="field">
                    <label for="description">توضیحات (فارسی)</label>
                    <textarea id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                    @error('description') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                </div>

                <div class="field">
                    <label for="description_en">توضیحات (انگلیسی)</label>
                    <textarea id="description_en" name="description_en" rows="4" style="direction:ltr; text-align:left;">{{ old('description_en') }}</textarea>
                    @error('description_en') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('achievements.index') }}" class="btn btn-outline">انصراف</a>
                <button type="submit" class="btn btn-primary">ذخیره دستاورد</button>
            </div>
        </form>
    </div>
@endsection
