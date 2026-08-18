@extends('layouts.admin')

@section('pageTitle', 'افزودن عضو تیم')
@section('pageSubtitle', 'اطلاعات پروفایل عضو جدید تیم شرکت را وارد کنید')

@section('content')
    <div class="content content--form">
        <form action="{{ route('team.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-card">
                <h3>عکس پروفایل</h3>
                <div class="avatar-upload">
                    <div class="avatar-upload__preview" id="avatarPreview">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <div>
                        <label for="avatarInput" class="btn btn-outline btn-sm">انتخاب تصویر</label>
                        <div class="field-hint" style="margin-top:6px;">فرمت PNG یا JPG، حداکثر ۲ مگابایت</div>
                        @error('avatar') <span style="color:red; font-size:12px; display:block;">{{ $message }}</span> @enderror
                    </div>
                    <input type="file" id="avatarInput" name="avatar" accept="image/*" hidden>
                </div>
            </div>

            <div class="form-card">
                <h3>اطلاعات اصلی</h3>
                <div class="field-row">
                    <div class="field">
                        <label for="name">نام و نام‌خانوادگی</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" >
                        @error('name') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="field">
                        <label for="slug">نامک آدرس (slug) <small>یکتا</small></label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug') }}" style="direction:ltr; text-align:left;" >
                        @error('slug') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="field-row">
                    <div class="field">
                        <label for="role">نقش</label>
                        <input type="text" id="role" name="role" value="{{ old('role') }}">
                        @error('role') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="field">
                        <label for="experience">سابقه کاری</label>
                        <input type="text" id="experience" name="experience" value="{{ old('experience') }}">
                        @error('experience') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="field">
                    <label for="bio">بیوگرافی</label>
                    <textarea id="bio" name="bio">{{ old('bio') }}</textarea>
                    @error('bio') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-card">
                <h3>مهارت‌ها</h3>
                <div class="field">
                    <div class="tag-input" id="skillsTagInput">
                        <input type="text" id="skillsTagField" placeholder="تایپ کن و Enter بزن...">
                    </div>
                    <input type="hidden" name="skills" id="skillsHidden" value="[]">
                    @error('skills') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('team.index') }}" class="btn btn-outline">انصراف</a>
                <button type="submit" class="btn btn-primary">ذخیره عضو</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    document.getElementById('avatarInput').addEventListener('change', function(){
        const file = this.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('avatarPreview').innerHTML = `<img src="${e.target.result}">`;
        };
        reader.readAsDataURL(file);
    });

    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    nameInput.addEventListener('input', () => {
        slugInput.value = nameInput.value.trim().toLowerCase().replace(/\s+/g, '-');
    });

    const skillsField = document.getElementById('skillsTagField');
    const skillsInput = document.getElementById('skillsTagInput');
    const skillsHidden = document.getElementById('skillsHidden');
    let skills = [];

    function renderSkills(){
        skillsInput.querySelectorAll('.chip').forEach(c => c.remove());
        skills.forEach((tag, idx) => {
            const chip = document.createElement('span');
            chip.className = 'chip';
            chip.innerHTML = `${tag} <button type="button">×</button>`;
            chip.querySelector('button').addEventListener('click', () => {
                skills.splice(idx, 1);
                renderSkills();
            });
            skillsInput.insertBefore(chip, skillsField);
        });
        skillsHidden.value = JSON.stringify(skills);
    }
    skillsField.addEventListener('keydown', e => {
        if (e.key === 'Enter') {
            e.preventDefault();
            const val = skillsField.value.trim();
            if (val) { skills.push(val); renderSkills(); }
            skillsField.value = '';
        }
    });
</script>
@endsection
