{{--
    این بخش را به‌جای تگ <form class="ct-form" ...> موجود در فایل
    OWJ-index-responsive.html قرار دهید (همان بخش section#contact).
    استایل‌های ct-form همان‌هایی هستند که در فایل اصلی HTML تعریف شده‌اند
    و نیازی به تغییر ندارند.
--}}

@if (session('success'))
    <div class="ct-alert ct-alert--success" style="margin-bottom:16px;padding:12px 16px;border-radius:8px;background:#e6f7ec;color:#1c7c3f;font-size:14px;">
        {{ session('success') }}
    </div>
@endif

<form class="ct-form" method="POST" action="{{ route('project-requests.store') }}">
    @csrf

    {{-- هانی‌پات ضدِ اسپم: باید همیشه مخفی و خالی بماند --}}
    <div style="position:absolute; left:-9999px; top:-9999px;" aria-hidden="true">
        <label for="website">Website</label>
        <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
    </div>

    <div class="row">
        <div>
            <label for="ct-name" data-i18n="ct.name">Name</label>
            <input
                id="ct-name"
                name="name"
                type="text"
                value="{{ old('name') }}"
                data-i18n-placeholder="ct.namePh"
                placeholder="Your name"
                required
            >
            @error('name')
                <p style="color:#f53003;font-size:12px;margin-top:4px;">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="ct-email" data-i18n="ct.email2">Email</label>
            <input
                id="ct-email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                placeholder="you@company.com"
                required
            >
            @error('email')
                <p style="color:#f53003;font-size:12px;margin-top:4px;">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label for="ct-msg" data-i18n="ct.msg">Message</label>
        <textarea
            id="ct-msg"
            name="message"
            data-i18n-placeholder="ct.msgPh"
            placeholder="Tell us about your project..."
            required
        >{{ old('message') }}</textarea>
        @error('message')
            <p style="color:#f53003;font-size:12px;margin-top:4px;">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" data-i18n="ct.send">Send message</button>
</form>
