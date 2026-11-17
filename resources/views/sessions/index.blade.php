<x-layout title="نشست‌ها" description="برنامهٔ نشست‌های پیش رو و آرشیو گردهمایی‌های گروه کاربران گنو/لینوکس کرمان، همراه با موضوع‌ها، زمان، مکان و گزارش‌ها.">
    <section class="shell py-12 md:py-18">
        <p class="eyebrow mb-4">از پشت صفحه، به دور یک میز</p><h1 class="text-3xl leading-relaxed font-bold md:text-4xl">نشست‌های کرمان‌لاگ</h1>
        <p class="mt-5 max-w-2xl text-sm leading-8 text-muted">برای یاد گرفتن، پرسیدن و به اشتراک گذاشتن تجربه‌ها دور هم جمع می‌شویم. شرکت در نشست‌های لاگ آزاد و رایگان است.</p>
        <section class="my-10 rounded-lg border border-line bg-wash p-6 md:p-8" aria-labelledby="upcoming-title">
            <h2 id="upcoming-title" class="text-xl font-bold">نشست‌های پیش رو</h2>
            @forelse ($upcoming as $session)
                <x-session-card :session="$session" />
            @empty
                <p class="mt-4 text-sm leading-8 text-muted">زمان و مکان نشست بعدی هنوز اعلام نشده است. برنامهٔ تازه که مشخص شود، جزئیات آن را همین‌جا می‌خوانید.</p><a href="{{ route('contact') }}" class="mt-5 inline-block text-xs underline underline-offset-4">برای ارائه یا میزبانی همراه شویم ←</a>
            @endforelse
        </section>
        <section aria-labelledby="past-title">
            <div class="mb-5 flex flex-wrap items-baseline justify-between gap-3"><h2 id="past-title" class="text-xl font-bold">آرشیو نشست‌ها</h2><span class="text-xs text-muted">{{ $past->count() }} گردهمایی ثبت‌شده</span></div>
            <p class="mb-5 max-w-3xl text-xs leading-7 text-muted">اطلاعات از گزارش‌ها و اطلاعیه‌های موجود استخراج شده است؛ تاریخ درج‌شده، تاریخ خود رویداد است. برخی جزئیات در منابع قدیمی ذکر نشده‌اند.</p>
            <div class="border-t border-line">@foreach ($past as $session)<x-session-card :session="$session" />@endforeach</div>
        </section>
    </section>
</x-layout>
