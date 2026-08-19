@extends('layouts.admin')

@section('title', 'پست جدید')
@section('subtitle', 'ایجاد یک پست تازه و دوزبانه برای وبلاگ سایت')

@section('content')
    <div class="table-card" style="padding: 30px 30px;">
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="post-form" id="postForm">
            @csrf

            <div class="lang-tabs">
                <button type="button" class="lang-tab active" data-lang="fa">فارسی</button>
                <button type="button" class="lang-tab" data-lang="en">English</button>
            </div>

            {{-- ===================== فارسی ===================== --}}
            <div class="lang-panel" data-lang-panel="fa">
                <div class="form-row">
                    <div class="form-group">
                        <label for="title_fa">عنوان پست (فارسی)</label>
                        <input type="text" id="title_fa" name="title_fa" value="{{ old('title_fa') }}" placeholder="مثلاً: راهنمای شروع کار با لاراول">
                        @error('title_fa') <span class="field-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="category_fa">دسته‌بندی (فارسی)</label>
                        <input type="text" id="category_fa" name="category_fa" value="{{ old('category_fa') }}" placeholder="مثلاً: توسعه وب">
                        @error('category_fa') <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="excerpt_fa">خلاصه کوتاه (فارسی)</label>
                    <textarea id="excerpt_fa" name="excerpt_fa" rows="2" placeholder="یک یا دو جمله برای معرفی پست در کارت‌های لیست">{{ old('excerpt_fa') }}</textarea>
                    @error('excerpt_fa') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="content_fa">متن کامل پست (فارسی)</label>
                    <textarea id="content_fa" name="content_fa" style="display:none;">{{ old('content_fa') }}</textarea>
                    <div id="editor_fa" class="rich-editor" dir="rtl"></div>
                    @error('content_fa') <span class="field-error">{{ $message }}</span> @enderror
                    <p class="hint-text">برای درج تصویر داخل متن، از آیکون تصویر در نوار ابزار بالای ادیتور استفاده کنید.</p>
                </div>
            </div>

            {{-- ===================== English ===================== --}}
            <div class="lang-panel" data-lang-panel="en" style="display:none;">
                <div class="form-row">
                    <div class="form-group">
                        <label for="title_en">Title (English)</label>
                        <input type="text" id="title_en" name="title_en" value="{{ old('title_en') }}" placeholder="e.g. Getting Started with Laravel" dir="ltr">
                        @error('title_en') <span class="field-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="category_en">Category (English)</label>
                        <input type="text" id="category_en" name="category_en" value="{{ old('category_en') }}" placeholder="e.g. Web Development" dir="ltr">
                        @error('category_en') <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="excerpt_en">Short excerpt (English)</label>
                    <textarea id="excerpt_en" name="excerpt_en" rows="2" dir="ltr" placeholder="One or two sentences shown in listing cards">{{ old('excerpt_en') }}</textarea>
                    @error('excerpt_en') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="content_en">Full content (English)</label>
                    <textarea id="content_en" name="content_en" style="display:none;">{{ old('content_en') }}</textarea>
                    <div id="editor_en" class="rich-editor" dir="ltr"></div>
                    @error('content_en') <span class="field-error">{{ $message }}</span> @enderror
                    <p class="hint-text">Use the image icon in the editor toolbar to insert images inline.</p>
                </div>
            </div>

            {{-- ===================== مشترک ===================== --}}
            <div class="form-row">
                <div class="form-group">
                    <label for="image">تصویر شاخص (مشترک برای هر دو زبان)</label>
                    <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                    @error('image') <span class="field-error">{{ $message }}</span> @enderror
                    <img id="imagePreview" src="" alt="پیش‌نمایش" style="display:none; margin-top:10px; width:160px; height:100px; object-fit:cover; border-radius:10px;">
                </div>

                <div class="form-group">
                    <label for="status">وضعیت انتشار</label>
                    <select id="status" name="status">
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>پیش‌نویس</option>
                        <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>منتشرشده</option>
                    </select>
                    @error('status') <span class="field-error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('posts.index') }}" class="btn-secondary-action">انصراف</a>
                <button type="submit" class="btn-primary-action">ذخیره پست</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    @include('admin.posts._post-form-assets')
@endsection
