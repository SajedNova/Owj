@extends('layouts.admin')

@section('pageTitle', 'تنظیمات سایت')
@section('pageSubtitle', 'مدیریت اطلاعات تماس و شبکه‌های اجتماعی')

@section('content')
    <div class="content content--form">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.site-settings.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-card">
                <h3>اطلاعات تماس</h3>
                <div class="field-row">
                    <div class="field">
                        <label for="address">آدرس (فارسی)</label>
                        <input type="text" id="address" name="address" value="{{ old('address', $setting->address) }}">
                        @error('address') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="field">
                        <label for="address_en">آدرس (انگلیسی)</label>
                        <input type="text" id="address_en" name="address_en" value="{{ old('address_en', $setting->address_en) }}" style="direction:ltr; text-align:left;">
                        @error('address_en') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="field-row">
                    <div class="field">
                        <label for="phone">شماره تلفن</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $setting->phone) }}" style="direction:ltr; text-align:left;">
                        @error('phone') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="field">
                        <label for="email">ایمیل</label>
                        <input type="text" id="email" name="email" value="{{ old('email', $setting->email) }}" style="direction:ltr; text-align:left;">
                        @error('email') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="form-card">
                <h3>شبکه‌های اجتماعی</h3>
                <div class="field-row">
                    <div class="field">
                        <label for="twitter_url">لینک X (توییتر سابق)</label>
                        <input type="url" id="twitter_url" name="twitter_url" value="{{ old('twitter_url', $setting->twitter_url) }}" style="direction:ltr; text-align:left;">
                        @error('twitter_url') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="field">
                        <label for="github_url">لینک گیت‌هاب</label>
                        <input type="url" id="github_url" name="github_url" value="{{ old('github_url', $setting->github_url) }}" style="direction:ltr; text-align:left;">
                        @error('github_url') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="field-row">
                    <div class="field">
                        <label for="instagram_url">لینک اینستاگرام</label>
                        <input type="url" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $setting->instagram_url) }}" style="direction:ltr; text-align:left;">
                        @error('instagram_url') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="field">
                        <label for="telegram_url">لینک تلگرام</label>
                        <input type="url" id="telegram_url" name="telegram_url" value="{{ old('telegram_url', $setting->telegram_url) }}" style="direction:ltr; text-align:left;">
                        @error('telegram_url') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">ذخیره تنظیمات</button>
            </div>
        </form>
    </div>
@endsection
