@props(['post'])
<article id="{{ $post['slug'] }}" class="group min-w-0">
    <a href="{{ route('blog.show', $post['slug']) }}" class="block">
        @if ($post['image'])
            <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" loading="lazy" class="aspect-[16/10] w-full rounded-md border border-line object-cover">
        @else
            <div class="flex aspect-[16/10] flex-col items-center justify-center gap-3 rounded-md border border-line bg-wash text-muted"><span class="font-mono text-3xl" aria-hidden="true">{{ substr($post['date'], 0, 4) }}</span><span class="text-xs">از آرشیو کرمان‌لاگ</span></div>
        @endif
        <div class="mt-5 flex items-center gap-3 text-[11px] text-muted"><time datetime="{{ $post['date'] }}" dir="ltr">{{ substr($post['date'], 0, 10) }}</time><span aria-hidden="true">/</span><span>{{ implode('، ', $post['categories']) }}</span></div>
        <h3 class="mt-3 text-lg leading-9 font-bold group-hover:text-muted">{{ $post['title'] }}</h3>
        <p class="mt-2 text-sm leading-8 text-muted">{{ $post['description'] }}</p>
        <span class="mt-4 inline-block text-xs underline decoration-line underline-offset-6">ادامهٔ نوشته ←</span>
    </a>
</article>
