<footer class="shell border-t border-line py-7 text-xs text-muted">
    <div class="flex flex-col justify-between gap-6 sm:flex-row sm:items-center">
        <p>از کرمان، برای دنیایی آزادتر.</p>
        <nav aria-label="پیوندهای پایین صفحه" class="flex flex-wrap gap-5">
            <a href="{{ route('blog.index') }}" class="hover:text-ink">وبلاگ</a>
            <a href="{{ route('sessions.index') }}" class="hover:text-ink">نشست‌ها</a>
            <a href="{{ route('faq') }}" class="hover:text-ink">پرسش‌ها</a>
            <a href="{{ route('contact') }}" class="hover:text-ink">تماس</a>
            <a href="{{ route('archive') }}" class="hover:text-ink">آرشیو</a>
            <a href="{{ route('blog.feed') }}" class="hover:text-ink" lang="en">RSS</a>
        </nav>
    </div>
    <p class="mt-6 text-[11px]">محتوای این وب‌سایت با پروانهٔ <a href="{{ route('license') }}" rel="license" class="underline underline-offset-4">GFDL</a> منتشر می‌شود.</p>
</footer>
