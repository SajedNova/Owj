@extends('layouts.admin')

@section('pageTitle', 'افزودن نمونه‌کار جدید')
@section('pageSubtitle', 'اطلاعات پروژه، گالری تصاویر و اعضای مرتبط را وارد کنید')

@section('content')
    <div class="section-head">
        <div>
            <h2>افزودن نمونه‌کار جدید</h2>
            <p>اطلاعات پروژه، گالری تصاویر و اعضای مرتبط را وارد کنید</p>
        </div>
        <a href="{{ route('portfolios.index') }}" class="btn btn-outline btn-sm">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 5l7 7-7 7"/></svg>
            بازگشت به لیست
        </a>
    </div>

    <form action="{{ route('portfolios.store') }}" method="POST" enctype="multipart/form-data" id="portfolioForm">
        @csrf

        <div class="form-card">
            <h3>اطلاعات اصلی</h3>
            <div class="field-row">
                <div class="field">
                    <label for="f_title">عنوان پروژه</label>
                    <input type="text" id="f_title" name="title" value="{{ old('title') }}" placeholder="مثلاً: پلتفرم فروشگاهی نگین" >
                    @error('title')
                    <span class="field-error" style="color:red; font-size:12px;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="field">
                    <label for="f_slug">نامک آدرس (slug) <small>یکتا</small></label>
                    <input type="text" id="f_slug" name="slug" value="{{ old('slug') }}" placeholder="negin-shop" style="direction:ltr; text-align:left;" >
                    @error('slug')
                    <span class="field-error" style="color:red; font-size:12px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="field-row">
                <div class="field">
                    <label for="f_title_en">عنوان پروژه (انگلیسی)</label>
                    <input type="text" id="f_title_en" name="title_en" value="{{ old('title_en') }}" placeholder="e.g. Negin E-commerce Platform" style="direction:ltr; text-align:left;">
                    @error('title_en')
                    <span class="field-error" style="color:red; font-size:12px;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="field">
                    <label for="f_slug_en">نامک آدرس انگلیسی (slug_en) <small>یکتا</small></label>
                    <input type="text" id="f_slug_en" name="slug_en" value="{{ old('slug_en') }}" placeholder="negin-shop-en" style="direction:ltr; text-align:left;">
                    @error('slug_en')
                    <span class="field-error" style="color:red; font-size:12px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="field">
                <label for="f_short_description">توضیح کوتاه <small>برای کارت‌های لیست</small></label>
                <textarea id="f_short_description" name="short_description" placeholder="یک خط درباره‌ی پروژه..." style="min-height:44px;">{{ old('short_description') }}</textarea>
                @error('short_description')
                <span class="field-error" style="color:red; font-size:12px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="f_short_description_en">توضیح کوتاه انگلیسی</label>
                <textarea id="f_short_description_en" name="short_description_en" placeholder="One line about the project..." style="min-height:44px; direction:ltr; text-align:left;">{{ old('short_description_en') }}</textarea>
                @error('short_description_en')
                <span class="field-error" style="color:red; font-size:12px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="f_description">توضیح کامل <small>برای صفحه‌ی جزئیات</small></label>
                <textarea id="f_description" name="description" placeholder="توضیح کامل پروژه، چالش‌ها و راه‌حل‌ها...">{{ old('description') }}</textarea>
                @error('description')
                <span class="field-error" style="color:red; font-size:12px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="f_description_en">توضیح کامل انگلیسی</label>
                <textarea id="f_description_en" name="description_en" placeholder="Full description of the project, challenges, solutions..." style="direction:ltr; text-align:left;">{{ old('description_en') }}</textarea>
                @error('description_en')
                <span class="field-error" style="color:red; font-size:12px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="field-row">
                <div class="field">
                    <label for="f_client_name">کارفرما</label>
                    <input type="text" id="f_client_name" name="client_name" value="{{ old('client_name') }}" placeholder="نام کارفرما (اختیاری)">
                    @error('client_name')
                    <span class="field-error" style="color:red; font-size:12px;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="field">
                    <label for="f_duration">مدت زمان انجام</label>
                    <input type="text" id="f_duration" name="duration" value="{{ old('duration') }}" placeholder="مثلاً: ۶ هفته">
                    @error('duration')
                    <span class="field-error" style="color:red; font-size:12px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="field-row">
                <div class="field">
                    <label for="f_client_name_en">کارفرما (انگلیسی)</label>
                    <input type="text" id="f_client_name_en" name="client_name_en" value="{{ old('client_name_en') }}" placeholder="Client name (Optional)" style="direction:ltr; text-align:left;">
                    @error('client_name_en')
                    <span class="field-error" style="color:red; font-size:12px;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="field">
                    <label for="f_duration_en">مدت زمان انجام (انگلیسی)</label>
                    <input type="text" id="f_duration_en" name="duration_en" value="{{ old('duration_en') }}" placeholder="e.g. 6 weeks" style="direction:ltr; text-align:left;">
                    @error('duration_en')
                    <span class="field-error" style="color:red; font-size:12px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="field-row">
                <div class="field">
                    <label for="f_category">دسته‌بندی</label>
                    <select id="f_category" name="category">
                        <option value="website" {{ old('category') === 'website' ? 'selected' : '' }}>وب سایت</option>
                        <option value="application" {{ old('category') === 'application' ? 'selected' : '' }}>اپلیکیشن</option>
                    </select>
                    @error('category')
                    <span class="field-error" style="color:red; font-size:12px;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="field">
                    <label for="f_project_url">لینک سایت زنده <small>اختیاری</small></label>
                    <input type="url" id="f_project_url" name="project_url" value="{{ old('project_url') }}" placeholder="https://example.com" style="direction:ltr; text-align:left;">
                    @error('project_url')
                    <span class="field-error" style="color:red; font-size:12px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-card">
            <h3>ابزارها و زبان‌ها</h3>
            <div class="field">
                <div class="tag-input" id="toolsTagInput">
                    <input type="text" id="toolsTagField" placeholder="تایپ کن و Enter بزن...">
                </div>
                <input type="hidden" name="tools" id="toolsHidden" value="{{ old('tools', '[]') }}">
                <span class="field-hint">مثلاً: Laravel، Vue.js، Tailwind — پس از تایپ هر مورد، Enter بزنید.</span>
                @error('tools')
                <span class="field-error" style="color:red; font-size:12px;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-card">
            <h3>گالری تصاویر <small style="font-weight:500; color:var(--muted-2);">portfolio_images</small></h3>
            <label class="upload-drop" for="galleryInput">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 16V4m0 0-4 4m4-4 4 4M4 16v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3"/></svg>
                <span>برای انتخاب تصاویر کلیک کنید یا آن‌ها را بکشید و رها کنید</span>
                <input type="file" id="galleryInput" name="images[]" accept="image/*" multiple hidden>
            </label>
            <div class="img-thumb-grid" id="galleryPreview"></div>
            <input type="hidden" name="main_image_index" id="mainImageIndex" value="0">
            <span class="field-hint">روی یکی از تصاویر کلیک کنید تا به‌عنوان تصویر اصلی (کاور) انتخاب شود.</span>
            @error('images')
            <span class="field-error" style="color:red; font-size:12px;">{{ $message }}</span>
            @enderror
            @error('images.*')
            <span class="field-error" style="color:red; font-size:12px;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-card">
            <h3>اعضای تیم مرتبط <small style="font-weight:500; color:var(--muted-2);">portfolio_team_member</small></h3>
            <div class="team-select-grid">
                @foreach($teamMembers as $member)
                    <label class="team-check">
                        <img src="{{ $member->avatar ? asset('storage/' . $member->avatar) : asset('storage/avatars/default-avatar.jpg') }}">
                        <span>{{ $member->name }}</span>
                        <input type="checkbox" name="team[]" value="{{ $member->id }}" {{ collect(old('team'))->contains($member->id) ? 'checked' : '' }}>
                    </label>
                @endforeach
            </div>
            @error('team')
            <span class="field-error" style="color:red; font-size:12px;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-card" style="flex-direction:row; align-items:center; justify-content:space-between;">
            <div>
                <strong style="font-size:13px; display:block;">انتشار پروژه</strong>
                <span style="font-size:11.5px; color:var(--muted-2);">در صورت فعال بودن، در سایت عمومی نمایش داده می‌شود</span>
                @error('is_published')
                <span class="field-error" style="color:red; font-size:12px;">{{ $message }}</span>
                @enderror
            </div>
            <label class="switch">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }}>
                <span class="switch-track"></span>
            </label>
        </div>

        <div class="form-actions">
            <a href="{{ route('portfolios.index') }}" class="btn btn-outline">انصراف</a>
            <button type="submit" class="btn btn-primary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M20 6 9 17l-5-5"/></svg>
                ذخیره نمونه‌کار
            </button>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        const titleInput = document.getElementById('f_title');
        const slugInput = document.getElementById('f_slug');
        let slugTouched = false;
        slugInput.addEventListener('input', () => slugTouched = true);
        titleInput.addEventListener('input', () => {
            if (slugTouched) return;
            slugInput.value = titleInput.value.trim().toLowerCase()
                .replace(/[^a-z0-9آ-ی\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        });
        const enTitleInput = document.getElementById('f_title_en');
        const enSlugInput = document.getElementById('f_slug_en');
        let enSlugTouched = false;
        enSlugInput.addEventListener('input', () => enSlugTouched = true);
        enTitleInput.addEventListener('input', () => {
            if (enSlugTouched) return;
            enSlugInput.value = enTitleInput.value.trim().toLowerCase()
                .replace(/[^a-z0-9آ-ی\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        });

        const toolsField = document.getElementById('toolsTagField');
        const toolsInput = document.getElementById('toolsTagInput');
        const toolsHidden = document.getElementById('toolsHidden');
        let tools = [];

        try {
            const initial = JSON.parse(toolsHidden.value || '[]');
            if (Array.isArray(initial)) tools = initial;
        } catch (e) {
            tools = [];
        }

        function renderTools(){
            toolsInput.querySelectorAll('.chip').forEach(c => c.remove());
            tools.forEach((tag, idx) => {
                const chip = document.createElement('span');
                chip.className = 'chip';
                chip.innerHTML = `${tag} <button type="button">×</button>`;
                chip.querySelector('button').addEventListener('click', () => {
                    tools.splice(idx, 1);
                    renderTools();
                });
                toolsInput.insertBefore(chip, toolsField);
            });
            toolsHidden.value = JSON.stringify(tools);
        }
        toolsField.addEventListener('keydown', e => {
            if (e.key === 'Enter' || e.key === ',') {
                e.preventDefault();
                const val = toolsField.value.trim().replace(/,$/, '');
                if (val) { tools.push(val); renderTools(); }
                toolsField.value = '';
            } else if (e.key === 'Backspace' && toolsField.value === '' && tools.length) {
                tools.pop();
                renderTools();
            }
        });
        renderTools();

        const galleryInput = document.getElementById('galleryInput');
        const galleryPreview = document.getElementById('galleryPreview');
        const mainImageIndex = document.getElementById('mainImageIndex');
        let galleryFiles = [];

        galleryInput.addEventListener('change', () => {
            galleryFiles = Array.from(galleryInput.files);
            if (Number(mainImageIndex.value) >= galleryFiles.length) mainImageIndex.value = 0;
            renderGallery();
        });

        function renderGallery(){
            galleryPreview.innerHTML = '';
            galleryFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = e => {
                    const isMain = index === Number(mainImageIndex.value);
                    const item = document.createElement('div');
                    item.className = 'img-thumb' + (isMain ? ' is-main' : '');
                    item.innerHTML = `<img src="${e.target.result}"><button type="button" class="img-thumb__remove">×</button>${isMain ? '<span class="badge-main">اصلی</span>' : ''}`;
                    item.querySelector('img').addEventListener('click', () => {
                        mainImageIndex.value = index;
                        renderGallery();
                    });
                    item.querySelector('.img-thumb__remove').addEventListener('click', ev => {
                        ev.stopPropagation();
                        removeGalleryFile(index);
                    });
                    galleryPreview.appendChild(item);
                };
                reader.readAsDataURL(file);
            });
        }

        function removeGalleryFile(index){
            galleryFiles.splice(index, 1);
            const dt = new DataTransfer();
            galleryFiles.forEach(f => dt.items.add(f));
            galleryInput.files = dt.files;
            if (Number(mainImageIndex.value) >= galleryFiles.length) {
                mainImageIndex.value = Math.max(0, galleryFiles.length - 1);
            }
            renderGallery();
        }
    </script>
@endsection
