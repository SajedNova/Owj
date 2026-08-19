@extends('layouts.admin')

@section('pageTitle', 'ویرایش سکشن درباره ما')
@section('pageSubtitle', 'ویرایش محتوای نمایشی سکشن درباره ما')

@section('content')
    <div class="content content--form">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.about-section.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-card">
                <h3>تصویر سکشن</h3>
                <div class="avatar-upload">
                    <div class="avatar-upload__preview" id="imagePreview">
                        <img src="{{ $aboutSection->image ? asset('storage/' . $aboutSection->image) : asset('placeholder.jpg') }}">
                    </div>
                    <div>
                        <label for="imageInput" class="btn btn-outline btn-sm">تغییر تصویر</label>
                        @error('image') <span style="color:red; font-size:12px; display:block;">{{ $message }}</span> @enderror
                    </div>
                    <input type="file" id="imageInput" name="image" accept="image/*" hidden>
                </div>
            </div>

            <div class="form-card">
                <h3>محتوای متنی</h3>
                <div class="field-row">
                    <div class="field">
                        <label for="title">عنوان (فارسی)</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $aboutSection->title) }}" required>
                        @error('title') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="field">
                        <label for="title_en">عنوان (انگلیسی)</label>
                        <input type="text" id="title_en" name="title_en" value="{{ old('title_en', $aboutSection->title_en) }}" style="direction:ltr; text-align:left;">
                        @error('title_en') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="field">
                    <label for="description">توضیحات (فارسی)</label>
                    <textarea id="description" name="description" rows="4">{{ old('description', $aboutSection->description) }}</textarea>
                    @error('description') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                </div>

                <div class="field">
                    <label for="description_en">توضیحات (انگلیسی)</label>
                    <textarea id="description_en" name="description_en" rows="4" style="direction:ltr; text-align:left;">{{ old('description_en', $aboutSection->description_en) }}</textarea>
                    @error('description_en') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-card">
                <h3>آمار و ارقام</h3>
                <div class="field-row">
                    <div class="field">
                        <label for="years_experience">سال تجربه</label>
                        <input type="text"  id="years_experience" name="years_experience" value="{{ old('years_experience', $aboutSection->years_experience) }}" required>
                    </div>
                    <div class="field">
                        <label for="projects_shipped">پروژه تحویل‌شده</label>
                        <input type="text" id="projects_shipped" name="projects_shipped" value="{{ old('projects_shipped', $aboutSection->projects_shipped) }}" required>
                    </div>
                    <div class="field">
                        <label for="team_members" >عضو تیم</label>
                        <input type="text" id="team_members" readonly name="team_members" value="{{ $userCount }}" required>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    document.getElementById('imageInput').addEventListener('change', function(){
        const file = this.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('imagePreview').innerHTML = `<img src="${e.target.result}">`;
        };
        reader.readAsDataURL(file);
    });
</script>
@endsection
