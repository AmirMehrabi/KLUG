<x-layout title="آرشیو وب‌سایت پیشین">
    <section class="shell py-12 md:py-16"><div class="mx-auto max-w-3xl">
        <p class="eyebrow mb-4">حافظهٔ کرمان‌لاگ</p><h1 class="text-3xl leading-relaxed font-bold">از وب‌سایت پیشین</h1>
        <p class="mt-5 text-sm leading-8 text-muted">متن اطلاعیه‌ها و اطلاعات خانهٔ قدیمی، برای حفظ تاریخچهٔ لاگ. این مطالب مربوط به سال‌های ۱۳۹۴ و ۱۳۹۵ هستند و برنامهٔ فعلی نشست‌ها محسوب نمی‌شوند.</p>
        <div class="mt-9 flex flex-wrap gap-5 text-xs underline underline-offset-4"><a href="{{ route('blog.index') }}">آرشیو کامل وبلاگ ←</a><a href="https://web.archive.org/web/20140118203056/http://www.klug.ir/">نسخه‌های قدیمی‌تر در بایگانی اینترنت ↗</a><a href="{{ asset('images/logo.png') }}">نشان پیشین کرمان‌لاگ ↗</a></div>
        @foreach ($sections as $section)
            <section class="mt-10 border-t border-line pt-8"><h2 class="mb-5 text-xl font-bold">{{ $section['title'] }}</h2><div class="prose text-muted">{!! $section['body'] !!}</div></section>
        @endforeach
        <section class="mt-10 border-t border-line pt-8"><h2 class="mb-5 text-xl font-bold">مکان نشست‌ها در نقشهٔ پیشین</h2><p class="text-sm leading-8 text-muted">در نقشهٔ وب‌سایت پیشین، میدان آزادی کرمان نمایش داده می‌شد؛ محل نشست بعدی در همان صفحه مشخص نشده بود.</p><a href="https://www.google.com/maps?q=30.2882204,57.0528741" class="mt-4 inline-block text-xs underline underline-offset-4">مشاهدهٔ میدان آزادی کرمان ↗</a></section>
    </div></section>
</x-layout>
