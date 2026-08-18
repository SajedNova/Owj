---
paths:
  - 'resources/views/**'
---

# Views

## Corporate Website Main Pages and Architecture
این پروژه یک سایت شرکتی برای معرفی یک شرکت برنامه‌نویسیه. صفحات اصلی: index (معرفی)، لیست نمونه‌کارها، جزئیات نمونه‌کار (شامل عکس، توضیحات، طراحان، ابزارها)، و پروفایل هر برنامه‌نویس شرکت. فرانت‌اند Blade کلاسیک است، از Vite برای assets استفاده می‌شود، و قالب توسط من از HTML/CSS پیاده‌سازی می‌شود.

This is a corporate showcase website for a programming agency. Main pages include: index (about/intro), portfolio list, portfolio details (with images, description, designers, tools), and team member profiles. The frontend is classic Blade, using Vite for assets, with templates built from HTML/CSS.

## Master Blade Layout and Shared Components
Use a master Blade layout at resources/views/layouts/app.blade.php with @yield or slots for content. Shared parts like header, footer, and nav should be Blade components under resources/views/components. Every page view extends the master layout.

## Asset Management with Vite and Blade Directives
All CSS and JS assets are managed through Vite. Never link CSS/JS files directly with plain <link> or <script> tags — always use the @vite() Blade directive, and register entry files in vite.config.js.

## Structured View Directories by Site Section
Each page/section of the site gets its own subfolder inside resources/views, matching its purpose — for example resources/views/home, resources/views/portfolio, resources/views/team. Don't put unrelated page views in the same folder.
