@extends('layouts.admin')

@section('pageTitle', 'افزودن برند')
@section('pageSubtitle', 'افزودن لوگوی جدید برند همکار')

@section('content')
    <div class="content content--form">
        <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-card">
                <h3>اطلاعات برند</h3>
                <div class="field">
                    <label for="name">نام برند</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                </div>

                <div class="field">
                    <label>فایل لوگو (SVG)</label>
                    <label for="logoInput" class="upload-drop">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        <span>انتخاب فایل SVG</span>
                        <div id="logoPreview" style="margin-top:10px;"></div>
                    </label>
                    <input type="file" id="logoInput" name="logo" accept=".svg,image/svg+xml" hidden required>
                    @error('logo') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('brands.index') }}" class="btn btn-outline">انصراف</a>
                <button type="submit" class="btn btn-primary">ذخیره برند</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    document.getElementById('logoInput').addEventListener('change', function(){
        const file = this.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('logoPreview').innerHTML = `<img src="${e.target.result}" style="max-height:60px; width:auto;">`;
        };
        reader.readAsDataURL(file);
    });
</script>
@endsection
