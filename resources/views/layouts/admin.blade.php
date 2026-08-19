<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'پنل ادمین' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="shell">
    @if(session('success') || session('error'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            Toast.fire({
                icon: '{{ session('success') ? "success" : "error" }}',
                title: '{{ session('success') ?? session('error') }}'
            });
        </script>
    @endif

    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <div class="brand__mark">OJ</div>
            <div class="brand__text">
                <strong>پنل ادمین</strong>
                <span>مدیریت سایت شرکتی</span>
            </div>
        </div>

        <div class="nav-group-label">اصلی</div>
        <nav class="nav">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="9" rx="2"/>
                    <rect x="14" y="3" width="7" height="5" rx="2"/>
                    <rect x="14" y="12" width="7" height="9" rx="2"/>
                    <rect x="3" y="16" width="7" height="5" rx="2"/>
                </svg>
                داشبورد
            </a>

            <!-- Content Dropdown -->
            <div class="nav-dropdown">
                <button type="button" class="nav-dropdown-toggle">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                    </svg>
                    صفحه اصلی
                    <svg class="chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                </button>
                <div class="nav-dropdown-menu">
                    <a href="{{ route('admin.hero-section.edit') }}" class="{{ request()->routeIs('admin.hero-section.*') ? 'active' : '' }}">سکشن هیرو</a>
                    <a href="{{ route('admin.about-section.edit') }}" class="{{ request()->routeIs('admin.about-section.*') ? 'active' : '' }}">درباره ما</a>
                    <a href="{{ route('services.index') }}" class="{{ request()->routeIs('services.*') ? 'active' : '' }}">خدمات</a>
                    <a href="{{ route('achievements.index') }}" class="{{ request()->routeIs('achievements.*') ? 'active' : '' }}">دستاوردها</a>
                    <a href="{{ route('technologies.index') }}" class="{{ request()->routeIs('technologies.*') ? 'active' : '' }}">تکنولوژی‌ها</a>
                    <a href="{{ route('brands.index') }}" class="{{ request()->routeIs('brands.*') ? 'active' : '' }}">برندهای همکاری</a>
                </div>
            </div>

            <a href="{{ route('portfolios.index') }}" class="{{ request()->routeIs('portfolios.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="7" width="20" height="14" rx="2"/>
                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                </svg>
                نمونه‌کارها
            </a>
            <a href="{{ route('team.index') }}" class="{{ request()->routeIs('team.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                اعضای تیم
            </a>

            <a href="{{ route('project-requests.index') }}" class="{{ request()->routeIs('project-requests.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="7" width="20" height="14" rx="2"/>
                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                </svg>
               مدیریت درخواست ها
            </a>
            <a href="{{ route('admin.site-settings.edit') }}" class="{{ request()->routeIs('admin.site-settings.*') ? 'active' : '' }}">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                اطلاعات تماس و شبکه‌ها
            </a>

        </nav>

        <div class="sidebar-footer">
            <div class="avatar-round">{{ substr(auth()->user()->name, 0, 2) }}</div>
            <div>
                <strong>{{ auth()->user()->name }}</strong>
                <span>{{ auth()->user()->email }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            style="font-size: 11px; color: var(--brand-dark); border:none; background:none; cursor:pointer;">
                        خروج
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <main class="main">
        <header class="topbar">
            <div>
                <h1>@yield('title')</h1>
                <p>@yield('subtitle')</p>
            </div>
            <div class="topbar-right">
            </div>
        </header>

        <div class="content">
            @yield('content')
        </div>
    </main>
</div>

@yield('scripts')
<script>
    // Sidebar dropdown
    document.querySelectorAll('.nav-dropdown-toggle').forEach(toggle => {
        toggle.addEventListener('click', () => {
            toggle.parentElement.classList.toggle('open');
        });
    });

    function confirmDelete(id) {
        Swal.fire({
            title: 'آیا مطمئن هستید؟',
            text: "این عملیات قابل بازگشت نیست!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'بله، حذف کن',
            cancelButtonText: 'انصراف'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
</body>
</html>
