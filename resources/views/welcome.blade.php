<x-layout title="کرمان‌لاگ">

        <section class="shell grid items-center gap-12 py-16 md:grid-cols-[1.2fr_1fr] md:gap-16 md:py-24 lg:py-28" aria-labelledby="hero-title">
            <div>
                <p class="eyebrow mb-6 flex items-center gap-2.5"><span class="size-1.5 rounded-full bg-leaf" aria-hidden="true"></span>گروه کاربران گنو/لینوکس کرمان</p>
                <h1 id="hero-title" class="text-[clamp(1.8rem,4.1vw,3.4rem)] leading-[1.65] font-bold tracking-tight">کنار هم یاد می‌گیریم،<br><span class="text-leaf">آزادانه می‌سازیم.</span></h1>
                <p class="mt-6 max-w-lg text-[15px] leading-[2.2] text-muted">ما جمعی از علاقه‌مندان گنو/لینوکس و نرم‌افزار آزاد در کرمان هستیم. دور هم جمع می‌شویم، تجربه‌هایمان را به اشتراک می‌گذاریم و از هم یاد می‌گیریم. شما هم دعوتید.</p>
                <div class="mt-8 flex flex-wrap items-center gap-6">
                    <a href="https://t.me/+T6Gdj4d7DN7mr4HB" class="inline-flex items-center gap-6 rounded-md bg-leaf px-5 py-3.5 text-sm text-white hover:bg-ink">به گفت‌وگو بپیوندید <span aria-hidden="true">↖</span></a>
                    <a href="#about" class="text-sm text-muted hover:text-leaf">با کرمان‌لاگ آشنا شوید <span class="mr-1" aria-hidden="true">↓</span></a>
                </div>
                <p class="mt-5 text-[11px] text-muted">بدون عضویت رسمی. بدون پیش‌نیاز. برای همه.</p>
            </div>
            <div class="terminal-art relative rounded-xl border border-line bg-wash p-5 sm:p-8" aria-label="سلام دوست من؛ نمادی از جامعهٔ کاربران لینوکس">
                <div class="overflow-hidden rounded-lg border border-line bg-paper shadow-sm" dir="ltr" lang="en">
                    <div class="flex items-center justify-between border-b border-line px-4 py-3"><span class="font-mono text-[10px] text-muted">friend@klug: ~</span><div class="flex gap-1.5" aria-hidden="true"><span class="size-1.5 rounded-full bg-line"></span><span class="size-1.5 rounded-full bg-line"></span><span class="size-1.5 rounded-full bg-leaf"></span></div></div>
                    <div class="px-5 py-7 font-mono text-leaf sm:px-7">
                        <p class="text-[11px]"><span class="text-muted">~ $</span> echo "hello, friend"</p>
                        <pre class="my-7 text-center text-[17px] leading-[1.3] select-none" aria-hidden="true">   .--.
  |o_o |
  |:_/ |
 //   \ \\
(|     | )
/'\_   _/`\
\___)=(___/</pre>
                        <p class="text-xl tracking-tight">hello, friend<span class="ml-1 inline-block h-5 w-2.5 translate-y-1 bg-leaf" aria-hidden="true"></span></p>
                        <p class="mt-2 text-[10px] tracking-wider text-muted">a little curiosity. a lot to share.</p>
                    </div>
                </div>
                <p class="mt-5 text-center font-mono text-[9px] tracking-[.15em] text-muted" dir="ltr" lang="en">FREE SOFTWARE. SHARED KNOWLEDGE.</p>
            </div>
        </section>
        <section class="shell border-t border-line py-12" aria-labelledby="blog-title">
            <div class="mb-8 flex items-center justify-between gap-4"><div><p class="eyebrow mb-2">از دفترچهٔ کرمان‌لاگ</p><h2 id="blog-title" class="text-xl font-bold">روایت نشست‌ها و تجربه‌ها</h2></div><a href="{{ route('blog.index') }}" class="text-xs text-muted hover:text-ink">همهٔ نوشته‌ها ←</a></div>
            <div class="grid gap-8 md:grid-cols-3">
                @foreach ($posts as $post)
                    <x-post-card :post="$post" />
                @endforeach
            </div>
        </section>
        <section id="about" class="shell border-t border-line py-12 md:py-16" aria-labelledby="about-title">
            <div class="mb-10 flex flex-wrap items-baseline justify-between gap-3"><h2 id="about-title" class="text-xl font-bold">یک جمع دوستانه، یک علاقهٔ مشترک</h2><span class="font-mono text-[10px] tracking-wider text-muted" dir="ltr" lang="en">COMMUNITY, NOT A COMPANY.</span></div>
            <div class="grid gap-9 md:grid-cols-3 md:gap-12">
                <article><span class="font-mono text-xs text-leaf" aria-hidden="true">01 /</span><h3 class="mt-3 text-base font-bold">یادگیری از یکدیگر</h3><p class="mt-3 text-sm leading-8 text-muted">از اولین نصب لینوکس تا تجربه‌های فنی تازه؛ اینجا جایی برای پرسیدن، تجربه کردن و یاد گرفتن است.</p></article>
                <article><span class="font-mono text-xs text-leaf" aria-hidden="true">02 /</span><h3 class="mt-3 text-base font-bold">باور به نرم‌افزار آزاد</h3><p class="mt-3 text-sm leading-8 text-muted">برای ترویج نرم‌افزاری تلاش می‌کنیم که آزادی استفاده، مطالعه، تغییر و به‌اشتراک‌گذاری آن را داشته باشیم.</p></article>
                <article><span class="font-mono text-xs text-leaf" aria-hidden="true">03 /</span><h3 class="mt-3 text-base font-bold">جایی برای همه</h3><p class="mt-3 text-sm leading-8 text-muted">تازه‌کار یا باتجربه، کاربر لینوکس یا فقط کنجکاو؛ کرمان‌لاگ گروهی غیرانتفاعی است و از حضور شما استقبال می‌کند.</p></article>
            </div>
        </section>
        <section id="meetups" class="shell py-4" aria-labelledby="meetups-title">
            <div class="rounded-lg border border-line bg-wash p-7 md:p-10">
                <div class="flex flex-wrap items-center justify-between gap-4"><div><p class="eyebrow mb-3">از پشت صفحه، به دور یک میز</p><h2 id="meetups-title" class="text-2xl font-bold">قرار بعدی‌مان؟</h2></div><a href="{{ route('sessions.index') }}" class="text-xs underline underline-offset-4">همهٔ نشست‌ها و گزارش‌ها ←</a></div>
                @if ($nextSession)
                    <x-session-card :session="$nextSession" />
                @else
                    <p class="mt-5 text-sm leading-8 text-muted">زمان و مکان نشست بعدی هنوز اعلام نشده است. برای پیگیری برنامه‌ها و پیشنهاد ارائه یا میزبانی، با ما در تماس باشید.</p>
                    <a href="{{ route('contact') }}" class="mt-4 inline-block text-xs underline underline-offset-4">برای یک نشست همکاری کنیم ↖</a>
                @endif
            </div>
        </section>
        <section id="faq" class="shell grid gap-8 py-14 md:grid-cols-[1fr_1.7fr] md:gap-20 md:py-20" aria-labelledby="faq-title">
            <div><p class="eyebrow mb-3">قبل از اولین سلام</p><h2 id="faq-title" class="text-xl font-bold">شاید بپرسید…</h2><p class="mt-4 text-sm leading-8 text-muted">آشنایی با لاگ از همین‌جا شروع می‌شود.</p><a href="{{ route('faq') }}" class="mt-4 inline-block text-xs underline underline-offset-4">همهٔ پرسش‌ها و پاسخ‌ها ←</a></div>
            <div class="border-t border-line">
                <details class="border-b border-line"><summary class="flex items-center justify-between gap-5 py-5 text-sm font-bold">برای پیوستن چقدر باید لینوکس بلد باشم؟<span class="faq-plus text-xl font-normal text-leaf" aria-hidden="true">+</span></summary><p class="pb-5 text-sm leading-8 text-muted">هیچ پیش‌نیازی ندارید. از کاربرهای تازه‌کار تا افراد باتجربه در لاگ حضور دارند. حتی اگر هنوز از لینوکس استفاده نمی‌کنید، خوشحال می‌شویم به جمع ما بپیوندید.</p></details>
                <details class="border-b border-line"><summary class="flex items-center justify-between gap-5 py-5 text-sm font-bold">چطور عضو کرمان‌لاگ شوم؟<span class="faq-plus text-xl font-normal text-leaf" aria-hidden="true">+</span></summary><p class="pb-5 text-sm leading-8 text-muted">عضویت رسمی یا هزینه‌ای در کار نیست. در گروه تلگرام یک سلام کنید یا در نشست‌های لاگ همراه ما باشید. همین برای شروع کافی است!</p></details>
                <details class="border-b border-line"><summary class="flex items-center justify-between gap-5 py-5 text-sm font-bold">چطور می‌توانم همکاری کنم؟<span class="faq-plus text-xl font-normal text-leaf" aria-hidden="true">+</span></summary><p class="pb-5 text-sm leading-8 text-muted">تجربه‌تان را ارائه کنید، به پرسش دیگران پاسخ بدهید، در توسعهٔ وب‌سایت همراه شوید یا فضایی برای نشست‌ها فراهم کنید. برای هماهنگی به <a href="mailto:hello@klug.ir" class="text-leaf underline" dir="ltr">hello@klug.ir</a> بنویسید.</p></details>
            </div>
        </section>
        <section id="connect" class="shell border-t border-line py-12 md:py-14" aria-labelledby="connect-title">
            <div class="flex flex-col justify-between gap-7 sm:flex-row sm:items-center"><div><h2 id="connect-title" class="text-2xl font-bold">از یک «سلام» شروع کنیم.</h2><p class="mt-3 text-sm text-muted">یک پرسش، یک ایده، یا فقط یک گپ دوستانه.</p></div><div class="flex flex-wrap items-center gap-6 text-sm"><a href="https://t.me/KermanLinuxUsersGroup" class="text-leaf hover:underline">کانال تلگرام ↖</a><a href="https://t.me/+T6Gdj4d7DN7mr4HB" class="text-leaf hover:underline">گروه تلگرام ↖</a><a href="mailto:hello@klug.ir" class="text-leaf hover:underline" dir="ltr">hello@klug.ir ↗</a><a href="https://github.com/emzi/kermanlug-blog" class="text-leaf hover:underline" lang="en" dir="ltr">GitHub ↗</a></div></div>
        </section>

</x-layout>
