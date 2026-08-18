@extends('layouts.admin')

@section('title', 'پست جدید')
@section('subtitle', 'ایجاد یک پست تازه برای وبلاگ سایت')

@section('content')
    <div class="table-card">
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="post-form">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="title">عنوان پست</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="مثلاً: راهنمای شروع کار با لاراول">
                    @error('title') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="category">دسته‌بندی</label>
                    <input type="text" id="category" name="category" value="{{ old('category') }}" placeholder="مثلاً: توسعه وب">
                    @error('category') <span class="field-error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="excerpt">خلاصه کوتاه</label>
                <textarea id="excerpt" name="excerpt" rows="2" placeholder="یک یا دو جمله برای معرفی پست در کارت‌های لیست">{{ old('excerpt') }}</textarea>
                @error('excerpt') <span class="field-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="content">متن کامل پست</label>
                <textarea id="content" name="content" rows="12" placeholder="متن کامل پست را اینجا بنویسید (تگ‌های HTML مثل &lt;h2&gt; و &lt;p&gt; پشتیبانی می‌شود)">{{ old('content') }}</textarea>
                @error('content') <span class="field-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="image">تصویر شاخص</label>
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
<style>
    .post-form { display: flex; flex-direction: column; gap: 20px; }
    .post-form .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .post-form .form-group { display: flex; flex-direction: column; gap: 8px; }
    .post-form label { font-size: 13.5px; font-weight: 600; color: #1a1a2e; }
    .post-form input[type="text"],
    .post-form input[type="file"],
    .post-form select,
    .post-form textarea {
        width: 100%;
        padding: 12px 14px;
        border-radius: 10px;
        border: 1px solid #e3e7ee;
        font-size: 14px;
        font-family: inherit;
        background: #fafbfe;
        color: #1a1a2e;
        resize: vertical;
    }
    .post-form input:focus, .post-form select:focus, .post-form textarea:focus {
        outline: none;
        border-color: var(--brand-dark, #b51c1c);
    }
    .post-form .field-error { color: #e5484d; font-size: 12px; }
    .post-form .form-actions { display: flex; gap: 12px; justify-content: flex-start; margin-top: 8px; }
    .btn-primary-action {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--brand-dark, #b51c1c); color: #fff;
        border: none; padding: 11px 22px; border-radius: 10px;
        font-size: 14px; font-weight: 600; cursor: pointer; text-decoration: none;
    }
    .btn-secondary-action {
        display: inline-flex; align-items: center; gap: 6px;
        background: #eef2f7; color: #5c6b7a;
        border: none; padding: 11px 22px; border-radius: 10px;
        font-size: 14px; font-weight: 600; cursor: pointer; text-decoration: none;
    }
    @media (max-width: 720px) { .post-form .form-row { grid-template-columns: 1fr; } }
</style>
<script>
    function previewImage(event) {
        const preview = document.getElementById('imagePreview');
        const file = event.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    }
</script>
@endsection
