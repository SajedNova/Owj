@extends('layouts.admin')

@section('pageTitle', 'ویرایش عضو تیم')
@section('pageSubtitle', 'ویرایش اطلاعات پروفایل عضو تیم')

@section('content')
    <div class="content content--form">
        <form action="{{ route('team.update', $team) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-card">
                <h3>عکس پروفایل</h3>
                <div class="avatar-upload">
                    <div class="avatar-upload__preview" id="avatarPreview">
                        <img src="{{ $team->avatar ? asset('storage/' . $team->avatar) : asset('storage/avatars/default-avatar.jpg') }}">
                    </div>
                    <div>
                        <label for="avatarInput" class="btn btn-outline btn-sm">تغییر تصویر</label>
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
                        <input type="text" id="name" name="name" value="{{ old('name', $team->name) }}" required>
                        @error('name') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="field">
                        <label for="slug">نامک آدرس (slug) <small>یکتا</small></label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $team->slug) }}" style="direction:ltr; text-align:left;" required>
                        @error('slug') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="field-row">
                    <div class="field">
                        <label for="name_en">نام و نام‌خانوادگی (انگلیسی)</label>
                        <input type="text" id="name_en" name="name_en" value="{{ old('name_en', $team->name_en) }}" style="direction:ltr; text-align:left;">
                        @error('name_en') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="field">
                        <label for="slug_en">نامک آدرس انگلیسی (slug_en) <small>یکتا</small></label>
                        <input type="text" id="slug_en" name="slug_en" value="{{ old('slug_en', $team->slug_en) }}" style="direction:ltr; text-align:left;">
                        @error('slug_en') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="field-row">
                    <div class="field">
                        <label for="role">نقش</label>
                        <input type="text" id="role" name="role" value="{{ old('role', $team->role) }}">
                        @error('role') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="field">
                        <label for="experience">سابقه کاری</label>
                        <input type="text" id="experience" name="experience" value="{{ old('experience', $team->experience) }}">
                        @error('experience') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="field-row">
                    <div class="field">
                        <label for="role_en">نقش (انگلیسی)</label>
                        <input type="text" id="role_en" name="role_en" value="{{ old('role_en', $team->role_en) }}" style="direction:ltr; text-align:left;">
                        @error('role_en') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="field">
                        <label for="experience_en">سابقه کاری (انگلیسی)</label>
                        <input type="text" id="experience_en" name="experience_en" value="{{ old('experience_en', $team->experience_en) }}" style="direction:ltr; text-align:left;">
                        @error('experience_en') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="field">
                    <label for="bio">بیوگرافی</label>
                    <textarea id="bio" name="bio">{{ old('bio', $team->bio) }}</textarea>
                    @error('bio') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                </div>

                <div class="field">
                    <label for="bio_en">بیوگرافی (انگلیسی)</label>
                    <textarea id="bio_en" name="bio_en" style="direction:ltr; text-align:left;">{{ old('bio_en', $team->bio_en) }}</textarea>
                    @error('bio_en') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-card">
                <h3>مهارت‌ها</h3>
                <div class="field">
                    <div class="tag-input" id="skillsTagInput">
                        <input type="text" id="skillsTagField" placeholder="تایپ کن و Enter بزن...">
                    </div>
                    <input type="hidden" name="skills" id="skillsHidden" value="{{ old('skills', json_encode($team->skills)) }}">
                    @error('skills') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('team.index') }}" class="btn btn-outline">انصراف</a>
                <button type="submit" class="btn btn-primary">به‌روزرسانی عضو</button>
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
    const nameInputEn = document.getElementById('name_en');
    const slugInputEn = document.getElementById('slug_en');
    nameInputEn.addEventListener('input', () => {
        slugInputEn.value = nameInputEn.value.trim().toLowerCase().replace(/\s+/g, '-');
    });
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    nameInput.addEventListener('input', () => {
        slugInput.value = nameInput.value.trim().toLowerCase().replace(/\s+/g, '-');
    });

    const skillsField = document.getElementById('skillsTagField');
    const skillsInput = document.getElementById('skillsTagInput');
    const skillsHidden = document.getElementById('skillsHidden');
    let skills = JSON.parse(skillsHidden.value || '[]');

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

    renderSkills();

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
