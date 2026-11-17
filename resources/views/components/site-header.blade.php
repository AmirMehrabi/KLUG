    <header class="shell relative flex min-h-25 items-center justify-between gap-5 border-b border-line" x-data="{ menuOpen: false }" @keydown.escape.window="menuOpen = false">
        <a href="{{ route('home') }}" aria-label="کرمان‌لاگ، خانه" class="flex items-center gap-3">
            <span class="flex size-10 items-center justify-center rounded-lg bg-leaf font-mono text-xl font-bold text-paper" dir="ltr" aria-hidden="true">&gt;_</span>
            <span class="flex flex-col gap-0.5"><span class="text-lg font-bold">کرمان‌لاگ</span><span class="font-mono text-[10px] tracking-[.12em] text-muted" lang="en" dir="ltr">KERMAN LINUX USERS GROUP</span></span>
        </a>
        <nav aria-label="منوی اصلی" class="hidden items-center gap-5 text-[13px] lg:flex">
            <a href="{{ route('blog.index') }}" class="hover:text-leaf">وبلاگ</a>
            <a href="{{ route('about') }}" class="hover:text-leaf">دربارهٔ ما</a>
            <a href="{{ route('sessions.index') }}" class="hover:text-leaf">نشست‌ها</a>
            <a href="{{ route('faq') }}" class="hover:text-leaf">پرسش‌های متداول</a>
        </nav>
        <a href="{{ route('contact') }}" class="hidden items-center gap-5 rounded-md border border-line px-4 py-2.5 text-xs hover:border-leaf hover:text-leaf lg:flex">به جمع ما بپیوندید <span aria-hidden="true">↖</span></a>
        <button type="button" class="flex size-11 items-center justify-center rounded-md border border-line text-xl lg:hidden" @click="menuOpen = !menuOpen" :aria-expanded="menuOpen" aria-controls="mobile-menu" aria-label="باز و بسته کردن منو"><span aria-hidden="true" x-text="menuOpen ? '×' : '☰'">☰</span></button>
        <nav id="mobile-menu" x-cloak x-show="menuOpen" @click.outside="menuOpen = false" aria-label="منوی موبایل" class="absolute inset-x-0 top-full z-20 flex flex-col gap-5 border border-line bg-paper p-6 text-sm shadow-sm lg:hidden">
            <a href="{{ route('blog.index') }}" @click="menuOpen = false">وبلاگ</a>
            <a href="{{ route('about') }}" @click="menuOpen = false">دربارهٔ ما</a>
            <a href="{{ route('sessions.index') }}" @click="menuOpen = false">نشست‌ها</a>
            <a href="{{ route('faq') }}" @click="menuOpen = false">پرسش‌های متداول</a>
            <a href="{{ route('contact') }}" @click="menuOpen = false" class="text-leaf">به جمع ما بپیوندید ↖</a>
        </nav>
    </header>
