<x-layout :title="$post['title']" :description="$post['description']">
    <article class="shell py-10 md:py-16">
        <div class="mx-auto max-w-3xl">
            <a href="{{ route('blog.index') }}" class="text-xs text-muted hover:text-ink">→ بازگشت به نوشته‌ها</a>
            <div class="mt-9 flex flex-wrap items-center gap-4 text-xs text-muted">
                @foreach ($post['categories'] as $category)
                    <a href="{{ route('blog.category', $category) }}" class="underline underline-offset-4">{{ $category }}</a>
                @endforeach
                <time datetime="{{ $post['date'] }}" dir="ltr">{{ substr($post['date'], 0, 10) }}</time>
                <span>{{ $post['author'] }}</span>
            </div>
            <h1 class="mt-5 text-3xl leading-[1.8] font-bold md:text-4xl">{{ $post['title'] }}</h1>
            <p class="mt-3 text-sm text-muted">{{ $post['description'] }}</p>
            @if ($post['image'])
                <figure class="my-9"><a href="{{ $post['image'] }}" aria-label="نمایش تصویر اصلی: {{ $post['title'] }}"><img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" class="w-full rounded-lg border border-line"></a><figcaption class="mt-3 text-center text-[11px] text-muted">تصویر اصلی نوشته · برای دیدن اندازهٔ کامل، تصویر را انتخاب کنید.</figcaption></figure>
            @endif
            <p class="my-8 border-r-2 border-line pr-4 text-xs leading-7 text-muted">این نوشته از وبلاگ پیشین کرمان‌لاگ منتقل شده است. اطلاعیه‌ها و پیوندهای داخل متن مربوط به زمان انتشار آن هستند.
                @isset ($post['source_url'])
                    <a href="{{ $post['source_url'] }}" class="underline underline-offset-4">نسخهٔ بایگانی‌شدهٔ نوشته ↗</a>
                @endisset
            </p>
            <div class="prose">{!! $post['html'] !!}</div>
            @isset ($post['archive_images'])
                <section class="mt-9 border-t border-line pt-6" aria-labelledby="archive-images-title">
                    <h2 id="archive-images-title" class="mb-4 text-sm font-bold">تصاویر نسخهٔ بایگانی‌شده</h2>
                    @foreach ($post['archive_images'] as $image)
                        @if ($image['status'] === 'downloaded')
                            @if (($image['local'] ?? null) !== $post['image'])
                                <figure class="my-4"><img src="{{ $image['local'] }}" alt="{{ $image['caption'] }}" loading="lazy" class="max-h-96 max-w-full rounded-md"><figcaption class="mt-2 text-xs text-muted">{{ $image['caption'] }}</figcaption></figure>
                            @endif
                        @else
                            <p class="my-3 text-xs leading-7 text-muted">{{ $image['caption'] }} — دریافت تصویر از آرشیو ممکن نشد. <a href="{{ $image['url'] }}" class="underline underline-offset-4">مشاهده در بایگانی اینترنت ↗</a></p>
                        @endif
                    @endforeach
                </section>
            @endisset
            @if ($sessions->isNotEmpty())
                <section class="mt-9 rounded-md border border-line bg-wash p-5"><h2 class="mb-3 text-sm font-bold">صفحهٔ نشست‌های این نوشته</h2><ul class="space-y-3">@foreach ($sessions as $session)<li><a href="{{ route('sessions.show', $session['slug']) }}" class="text-sm underline underline-offset-4">{{ $session['title'] }} ←</a></li>@endforeach</ul></section>
            @endif
            <div class="mt-10 border-t border-line pt-5 text-xs leading-7 text-muted">نوشتهٔ {{ $post['author'] }} · منتشرشده با پروانهٔ <a href="{{ route('license') }}" class="underline">GFDL</a></div>
        </div>
    </article>
    <section class="shell border-t border-line py-12"><h2 class="mb-8 text-lg font-bold">از دیگر نوشته‌ها</h2><div class="grid gap-10 md:grid-cols-2">@foreach ($related as $item)<x-post-card :post="$item" />@endforeach</div></section>
</x-layout>
