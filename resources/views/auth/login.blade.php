<!doctype html>
<html lang="en" dir="rtl">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>ورود ادمین اوج</title>

  <link href="https://fonts.googleapis.com/css2?family=Vazirmatn&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap" rel="stylesheet">

<style>
.lg-07,
.lg-07 *,
.lg-07 *::before,
.lg-07 *::after {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
   font-family: "Vazirmatn", sans-serif;
}

@property --lg-07-angle {
  syntax: '<angle>';
  inherits: false;
  initial-value: 0deg;
}

.lg-07 {
  --accent: linear-gradient();
  font-family: 'Segoe UI',system-ui,sans-serif;
  width: 100%;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 60px 20px;
  background: conic-gradient(from 210deg at 30% 30%,#2a2350,#3a2a60,#1c2450,#2a2350);
}

.lg-07__form {
  width: min(400px,92vw);
  padding: 34px;
  border-radius: 26px;
  background: color-mix(in oklab,white 10%,transparent);
  border: 1px solid rgba(255,255,255,.28);
  box-shadow: inset 0 1px 0 rgba(255,255,255,.4),0 30px 60px -30px rgba(0,0,0,.6);
  backdrop-filter: blur(22px) saturate(170%);
  -webkit-backdrop-filter: blur(22px) saturate(170%);
}

.lg-07__head {
  color: #fff;
  font-size: 24px;
  font-weight: 800;
  margin-bottom: 22px;


}

.lg-07__field {
  margin-bottom: 18px;
}

.lg-07__label {
  display: block;
  font-size: 12px;
  font-weight: 600;
  letter-spacing: .06em;
  text-transform: uppercase;
  color: rgba(255,255,255,.7);
  margin-bottom: 7px;
}

.lg-07__wrap {
  position: relative;
  display: block;
}

.lg-07__input {
  position: relative;
  z-index: 1;
  display: block;
  width: 100%;
  font-size: 15px;
  color: #fff;
  padding: 13px 15px;
  border-radius: 14px;
  border: 1px solid rgba(255,255,255,.25);
  background: color-mix(in oklab,white 8%,transparent);
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
  box-shadow: inset 0 1px 0 rgba(255,255,255,.3);
  outline: none;
  transition: background .2s;
}

.lg-07__input::placeholder {
  color: rgba(255,255,255,.5);
}

.lg-07__wrap::before {
  content: "";
  position: absolute;
  inset: -2px;
  border-radius: 16px;
  padding: 2px;
  background: conic-gradient(from var(--lg-07-angle),var(--accent),oklch(0.7 0.18 200),oklch(0.72 0.17 330),var(--accent));
  -webkit-mask: linear-gradient(#000 0 0) content-box,linear-gradient(#000 0 0);
  -webkit-mask-composite: xor;
  mask: linear-gradient(#000 0 0) content-box,linear-gradient(#000 0 0);
  mask-composite: exclude;
  opacity: 0;
  transition: opacity .3s;
  pointer-events: none;
}

.lg-07__wrap:focus-within::before {
  opacity: 1;
  animation: lg-07-spin 3s linear infinite;
}

.lg-07__wrap:focus-within .lg-07__input {
  background: color-mix(in oklab,white 14%,transparent);
}

.lg-07__submit {
  width: 100%;
  margin-top: 6px;
  font-size: 16px;
  font-weight: 700;
  color: #fff;
  padding: 14px;
  border-radius: 14px;
  border: 1px solid color-mix(in oklab,var(--accent) 40%,white);
  cursor: pointer;
  background: linear-gradient(180deg,color-mix(in oklab,var(--accent) 85%,white),var(--accent));
  box-shadow: inset 0 1px 0 rgba(255,255,255,.5),0 14px 28px -16px rgba(0,0,0,.6);
  transition: transform .15s;
}

.lg-07__submit:hover {
  transform: translateY(-2px);
}

.lg-07__submit:focus-visible {
  outline: 3px solid #fff;
  outline-offset: 3px;
}

@keyframes lg-07-spin {
  to {
    --lg-07-angle: 360deg;
  }
}

@media (prefers-reduced-motion: reduce) {
  .lg-07__field:focus-within::before {
    animation: none;
  }
}
body{
    margin : 0;
}
</style>
</head>
<body>
<section class="lg-07" aria-label="Liquid glass form fields">
  <form class="lg-07__form" method="POST" action="{{ route('login') }}" novalidate>
    @csrf
    <h3 class="lg-07__head">ورود ادمین اوج</h3>

    @if ($errors->any())
      <div style="color: #ff6b6b; font-size: 14px; margin-bottom: 18px; font-weight: bold; background: rgba(255, 107, 107, 0.1); padding: 10px; border-radius: 10px; border: 1px solid rgba(255, 107, 107, 0.2); direction: rtl; text-align: right;">
        @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif

    <div class="lg-07__field">
      <label class="lg-07__label" for="lg-07-login">نام کاربری یا ایمیل</label>
      <span class="lg-07__wrap">
        <input class="lg-07__input" id="lg-07-login" name="login" type="text" placeholder="ali or email@example.com" value="{{ old('login') }}" autocomplete="username">
      </span>
    </div>
    <div class="lg-07__field">
      <label class="lg-07__label" for="lg-07-pass">پسورد</label>
      <span class="lg-07__wrap">
        <input class="lg-07__input" id="lg-07-pass" name="password" type="password" placeholder="••••••••" autocomplete="current-password">
      </span>
    </div>
    <button class="lg-07__submit" type="submit">ورود</button>
  </form>
</section>
<script>/* No JavaScript — :focus-within lights each field, and an @property-driven conic-gradient (masked to a 1px rim) spins the refractive border around the active input. */</script>
</body>
</html>
