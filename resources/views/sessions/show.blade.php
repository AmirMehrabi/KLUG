<x-layout :title="$session['title']" :description="$session['description']">
    <article class="shell py-10 md:py-16"><div class="mx-auto max-w-3xl">
        <a href="{{ route('sessions.index') }}" class="text-xs text-muted hover:text-ink">→ همهٔ نشست‌ها</a>
        <p class="eyebrow mt-9 mb-3">{{ $session['status_label'] }}@if ($session['number']) · نشست شمارهٔ {{ $session['number'] }}@endif</p>
        <h1 class="text-3xl leading-[1.8] font-bold md:text-4xl">{{ $session['title'] }}</h1>
        <p class="mt-5 text-sm leading-8 text-muted">{{ $session['description'] }}</p>
        @if ($session['status'] === 'cancelled')<p class="mt-6 rounded-md border border-line bg-wash p-5 text-sm">این نشست لغو شده است.</p>@endif
        <dl class="my-9 grid gap-6 rounded-lg border border-line bg-wash p-6 text-sm leading-8 sm:grid-cols-2">
            <div><dt class="text-xs text-muted">تاریخ رویداد</dt><dd><time datetime="{{ $session['date'] }}">{{ $session['date_label'] }}</time></dd></div>
            <div><dt class="text-xs text-muted">زمان · {{ $session['timezone'] === 'Asia/Tehran' ? 'به وقت تهران' : $session['timezone'] }}</dt><dd>@if ($session['start_time'])<span dir="ltr">{{ $session['start_time'] }}@if ($session['end_time']) – {{ $session['end_time'] }}@endif</span>@else{{ $session['is_upcoming'] ? 'به‌زودی اعلام می‌شود' : 'در منبع ثبت نشده' }}@endif</dd></div>
            <div class="sm:col-span-2"><dt class="text-xs text-muted">{{ $session['format'] === 'online' ? 'نحوهٔ حضور' : 'مکان برگزاری' }}</dt><dd>{{ $session['venue'] ?? ($session['format'] === 'online' ? 'آنلاین' : ($session['address'] ? '' : ($session['is_upcoming'] ? 'به‌زودی اعلام می‌شود' : 'در منبع ثبت نشده'))) }}@if ($session['address'])<p>{{ $session['address'] }}</p>@endif</dd></div>
            @if (!empty($session['host']))<div class="sm:col-span-2"><dt class="text-xs text-muted">میزبان</dt><dd>{{ $session['host'] }}</dd></div>@endif
        </dl>
        <div class="mb-9 flex flex-wrap gap-5 text-xs">
            @if ($session['map_url'])<a href="{{ $session['map_url'] }}" class="underline underline-offset-4">مکان روی نقشه ↗</a>@endif
            @if ($session['online_url'] && $session['is_upcoming'])<a href="{{ $session['online_url'] }}" class="underline underline-offset-4">ورود به نشست آنلاین ↗</a>@endif
            @if ($session['registration_url'] && $session['is_upcoming'])<a href="{{ $session['registration_url'] }}" class="rounded-md bg-ink px-5 py-3 text-paper">ثبت‌نام در نشست ↗</a>@endif
            @if ($session['registration_url'] && !$session['is_upcoming'] && $session['status'] !== 'cancelled')<a href="{{ $session['registration_url'] }}" class="underline underline-offset-4">صفحهٔ ثبت‌نام در اطلاعیهٔ اصلی (آرشیو) ↗</a>@endif
        </div>
        @if (!empty($session['details']))
            <section class="prose mb-9" aria-labelledby="details-title"><h2 id="details-title">دربارهٔ ارائه</h2>@foreach ($session['details'] as $paragraph)<p>{{ $paragraph }}</p>@endforeach</section>
        @endif
        @if (!empty($session['audience']))
            <section class="prose mb-9" aria-labelledby="audience-title"><h2 id="audience-title">این نشست برای چه کسانی مناسب است؟</h2><ul>@foreach ($session['audience'] as $item)<li>{{ $item }}</li>@endforeach</ul></section>
        @endif
        @if (count($session['agenda']))
            <section class="mb-9" aria-labelledby="agenda-title"><h2 id="agenda-title" class="mb-5 text-xl font-bold">موضوع‌ها و برنامهٔ نشست</h2><ol class="divide-y divide-line border-y border-line">@foreach ($session['agenda'] as $item)<li class="flex items-start gap-5 py-5"><span class="font-mono text-xs leading-8 text-muted">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><div><h3 class="text-sm leading-8 font-bold">{{ $item['title'] }}</h3>@if ($item['speaker'] || $item['minutes'])<p class="mt-1 text-xs leading-7 text-muted">{{ $item['speaker'] }}@if ($item['minutes']) · {{ $item['minutes'] }} دقیقه@endif</p>@endif</div></li>@endforeach</ol></section>
        @endif
        @if ($session['notes'])<p class="mb-9 border-r-2 border-line pr-4 text-sm leading-8 text-muted">{{ $session['notes'] }}</p>@endif
        @if ($reports->isNotEmpty())
            <section class="border-t border-line pt-7" aria-labelledby="reports-title"><h2 id="reports-title" class="mb-5 text-xl font-bold">گزارش‌ها و اطلاعیه‌های مرتبط</h2><p class="mb-4 text-xs leading-7 text-muted">اطلاعات این نشست از نوشته‌های زیر استخراج شده است. نشانی‌ها و زمان‌های بالا تاریخی هستند.</p><ul class="space-y-4">@foreach ($reports as $post)<li><a href="{{ route('blog.show', $post['slug']) }}" class="text-sm underline decoration-line underline-offset-6">{{ $post['title'] }} ←</a></li>@endforeach</ul></section>
        @endif
    </div></article>
</x-layout>
