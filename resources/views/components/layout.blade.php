@props(['title' => 'کرمان‌لاگ', 'description' => 'گروه کاربران گنو/لینوکس کرمان؛ یادگیری، نرم‌افزار آزاد و تجربه‌های مشترک.'])
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#fafafa">
    <meta name="description" content="{{ $description }}">
    <title>{{ $title }} — گروه کاربران گنو/لینوکس کرمان</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate" type="application/rss+xml" title="وبلاگ کرمان‌لاگ" href="{{ route('blog.feed') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:z-50 focus:bg-paper focus:p-4">رفتن به محتوای اصلی</a>
    <x-site-header />
    <main id="main">{{ $slot }}</main>
    <x-site-footer />
</body>
</html>
