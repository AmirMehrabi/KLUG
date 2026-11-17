<x-layout :title="$category ? 'دسته‌بندی: '.$category : 'وبلاگ'" description="نوشته‌ها و گزارش نشست‌های گروه کاربران گنو/لینوکس کرمان، همراه با تصاویر و روایت اعضا.">
    <section class="shell py-12 md:py-18">
        <div class="mb-10 border-b border-line pb-10">
            <p class="eyebrow mb-4">دفترچهٔ کرمان‌لاگ</p>
            <h1 class="text-3xl leading-relaxed font-bold md:text-4xl">{{ $category ? 'نوشته‌های «'.$category.'»' : 'روایت‌ها، نشست‌ها، تجربه‌ها.' }}</h1>
            <p class="mt-5 max-w-2xl text-sm leading-8 text-muted">آرشیو نوشته‌های اعضا و گزارش نشست‌های کرمان‌لاگ، با متن اصلی و تصاویر بازیابی‌شده. تاریخ‌های انتشار به میلادی نمایش داده می‌شوند.</p>
            <nav aria-label="دسته‌بندی نوشته‌ها" class="mt-7 flex flex-wrap items-center gap-3 text-xs">
                <a href="{{ route('blog.index') }}" @class(['rounded-md border px-4 py-2', 'bg-ink text-paper border-ink' => !$category, 'border-line hover:border-ink' => $category])>همهٔ نوشته‌ها</a>
                @foreach (['نشست', 'لاگ', 'آرشیو'] as $term)
                    <a href="{{ route('blog.category', $term) }}" @class(['rounded-md border px-4 py-2', 'bg-ink text-paper border-ink' => $category === $term, 'border-line hover:border-ink' => $category !== $term])>{{ $term }}</a>
                @endforeach
                <a href="{{ route('blog.feed') }}" class="mr-auto underline underline-offset-4">خوراک RSS ↗</a>
            </nav>
        </div>
        <div class="grid gap-x-10 gap-y-14 md:grid-cols-2">
            @foreach ($posts as $post)
                <x-post-card :post="$post" />
            @endforeach
        </div>
    </section>
</x-layout>
