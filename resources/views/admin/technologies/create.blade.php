@extends('layouts.admin')

@section('pageTitle', 'افزودن تکنولوژی')
@section('pageSubtitle', 'افزودن تکنولوژی جدید استودیو')

@section('content')
    <div class="content content--form">
        <form action="{{ route('technologies.store') }}" method="POST">
            @csrf

            <div class="form-card">
                <h3>اطلاعات تکنولوژی</h3>
                <div class="field">
                    <label for="icon">آیکون (ایموجی یا متن کوتاه)</label>
                    <input type="text" id="icon" name="icon" value="{{ old('icon') }}" placeholder="مثلا: ⚛️" required>
                    @error('icon') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                </div>

                <div class="field">
                    <label for="name">نام تکنولوژی</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('technologies.index') }}" class="btn btn-outline">انصراف</a>
                <button type="submit" class="btn btn-primary">ذخیره تکنولوژی</button>
            </div>
        </form>
    </div>
@endsection
