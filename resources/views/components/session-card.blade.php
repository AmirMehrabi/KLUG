@props(['session'])
<article class="grid gap-4 border-b border-line py-7 md:grid-cols-[11rem_1fr_auto] md:gap-8">
    <div class="text-sm leading-8"><time datetime="{{ $session['date'] }}">{{ $session['date_label'] }}</time><p class="text-xs text-muted">{{ $session['status_label'] }}</p></div>
    <div><h3 class="text-lg leading-8 font-bold"><a href="{{ route('sessions.show', $session['slug']) }}" class="hover:text-muted">{{ $session['title'] }}</a></h3><p class="mt-2 text-sm leading-8 text-muted">{{ $session['description'] }}</p><p class="mt-3 text-xs leading-7 text-muted">{{ $session['venue'] ?? $session['address'] ?? ($session['format'] === 'online' ? 'نشست آنلاین' : 'مکان اعلام نشده') }}@if ($session['start_time'])<span class="mx-2" aria-hidden="true">·</span><span dir="ltr">{{ $session['start_time'] }}@if ($session['end_time']) – {{ $session['end_time'] }}@endif</span>@endif</p></div>
    <a href="{{ route('sessions.show', $session['slug']) }}" class="self-start text-xs leading-8 underline decoration-line underline-offset-4">جزئیات نشست ←</a>
</article>
