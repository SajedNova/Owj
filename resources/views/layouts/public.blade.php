<!doctype html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? 'وبلاگ — OWJcode' }}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('partials.header')

  @yield('content')

  <div class="ct-wrap" id="contact">
    <div class="ct-info">
      <div class="ct-info-item"><span class="ic">✉</span><div><h4>ایمیل</h4><p>hello@owjcode.com</p></div></div>
      <div class="ct-info-item"><span class="ic">☎</span><div><h4>تلفن</h4><p>+98 21 1234 5678</p></div></div>
      <div class="ct-info-item"><span class="ic">📍</span><div><h4>دفتر</h4><p>خیابان نمونه، پلاک 400</p></div></div>
    </div>

    <form class="ct-form" action="{{ route('contact.store') }}" method="POST">
      @csrf
      @if(session('contact_success'))
        <div class="ct-alert ct-alert-success">{{ session('contact_success') }}</div>
      @endif

      <div class="row">
        <div>
          <label for="ct-name">نام</label>
          <input id="ct-name" name="name" type="text" value="{{ old('name') }}" placeholder="نام شما">
          @error('name') <span class="ct-field-error">{{ $message }}</span> @enderror
        </div>
        <div>
          <label for="ct-email">ایمیل</label>
          <input id="ct-email" name="email" type="email" value="{{ old('email') }}" placeholder="you@company.com">
          @error('email') <span class="ct-field-error">{{ $message }}</span> @enderror
        </div>
      </div>
      <div>
        <label for="ct-msg">پیام</label>
        <textarea id="ct-msg" name="message" placeholder="درباره پروژه‌تان بنویسید...">{{ old('message') }}</textarea>
        @error('message') <span class="ct-field-error">{{ $message }}</span> @enderror
      </div>
      <button type="submit">ارسال پیام</button>
    </form>
  </div>

  @include('partials.footer')

  <script>
    // ===== DARK MODE TOGGLE =====
    (() => {
      const input = document.querySelector('.lg-04__input');
      if (input) {
        function applyMode(){ document.body.classList.toggle('dark-mode', !input.checked); }
        input.addEventListener('change', applyMode);
        applyMode();
      }
    })();
  </script>
  @stack('scripts')
</body>
</html>
