<x-layout title="دسته‌بندی نوشته‌ها">
    <section class="shell py-16"><h1 class="mb-8 text-3xl font-bold">دسته‌بندی نوشته‌ها</h1><div class="max-w-xl divide-y divide-line border-y border-line">@foreach ($categories as $category => $count)<a href="{{ route('blog.category', $category) }}" class="flex justify-between py-5"><span>{{ $category }}</span><span class="text-muted">{{ $count }} نوشته ←</span></a>@endforeach</div></section>
</x-layout>
