<div class="form-card">
    <h3>اطلاعات پایه</h3>
    <div class="field">
        <label for="title">عنوان پروژه</label>
        <input type="text" id="title" name="title" value="{{ old('title', $portfolio->title ?? '') }}" required>
    </div>
    <div class="field-row">
        <div class="field">
            <label for="slug">نامک (Slug)</label>
            <input type="text" id="slug" name="slug" value="{{ old('slug', $portfolio->slug ?? '') }}" required>
        </div>
        <div class="field">
            <label for="category">دسته‌بندی</label>
            <select id="category" name="category" required>
                <option value="website" {{ (old('category', $portfolio->category ?? '') == 'website') ? 'selected' : '' }}>وب‌سایت</option>
                <option value="application" {{ (old('category', $portfolio->category ?? '') == 'application') ? 'selected' : '' }}>اپلیکیشن</option>
            </select>
        </div>
    </div>
    <div class="field">
        <label for="short_description">توضیحات کوتاه</label>
        <input type="text" id="short_description" name="short_description" value="{{ old('short_description', $portfolio->short_description ?? '') }}" required>
    </div>
    <div class="field">
        <label for="description">توضیحات کامل</label>
        <textarea id="description" name="description" rows="5" required>{{ old('description', $portfolio->description ?? '') }}</textarea>
    </div>
</div>

<div class="form-card">
    <h3>اطلاعات تکمیلی</h3>
    <div class="field-row">
        <div class="field">
            <label for="client_name">نام مشتری</label>
            <input type="text" id="client_name" name="client_name" value="{{ old('client_name', $portfolio->client_name ?? '') }}">
        </div>
        <div class="field">
            <label for="duration">مدت زمان پروژه</label>
            <input type="text" id="duration" name="duration" value="{{ old('duration', $portfolio->duration ?? '') }}">
        </div>
    </div>
    <div class="field">
        <label for="project_url">آدرس پروژه</label>
        <input type="url" id="project_url" name="project_url" value="{{ old('project_url', $portfolio->project_url ?? '') }}">
    </div>
</div>

<div class="form-actions">
    <a href="{{ route('portfolios.index') }}" class="btn btn-outline">انصراف</a>
    <button type="submit" class="btn btn-primary">ذخیره اطلاعات</button>
</div>
