<x-layout title="پرسش‌های متداول">
    <section class="shell py-12 md:py-16">
        <div class="mx-auto max-w-3xl">
            <p class="eyebrow mb-4">قبل از اولین سلام</p><h1 class="text-3xl leading-relaxed font-bold">پرسش‌های متداول</h1>
            <p class="mt-5 text-sm leading-8 text-muted">می‌دانیم پیوستن به یک جمع تازه ممکن است با پرسش‌هایی همراه باشد. اینجا پاسخ‌های وب‌سایت پیشین کرمان‌لاگ را می‌خوانید.</p>
            <p class="my-6 rounded-md border border-line bg-wash p-4 text-xs leading-7 text-muted">این پاسخ‌ها متعلق به آرشیو سایت هستند. آمار حضور، نشانی انجمن دانشگاه، نام توزیع‌ها و شیوه‌های ارتباطی قدیمی ممکن است تغییر کرده باشند. برای اطلاعات تازه <a href="{{ route('contact') }}" class="underline">با ما در تماس باشید</a>.</p>
            <div class="border-t border-line">
                @foreach ($questions as $question)
                    <details class="border-b border-line" @if ($loop->first) open @endif>
                        <summary class="flex items-center justify-between gap-5 py-6 text-sm font-bold">{{ $question['question'] }}<span class="faq-plus text-xl font-normal" aria-hidden="true">+</span></summary>
                        <div class="prose pb-6 text-muted">{!! $question['answer'] !!}</div>
                        @if ($loop->first)
                            <div class="mb-7 grid gap-5 sm:grid-cols-2">
                                @foreach (['Ubuntu_15.10' => 'Ubuntu 15.10', 'Fedora_23' => 'Fedora 23', 'LinuxMint_17.3' => 'Linux Mint 17.3', 'openSUSE-Leap_42.1' => 'openSUSE Leap 42.1'] as $file => $label)
                                    <figure><video controls preload="none" aria-label="{{ $label }}" class="aspect-video w-full rounded-md bg-ink"><source src="{{ asset('videos/'.$file.'.mp4') }}" type="video/mp4"><a href="{{ asset('videos/'.$file.'.mp4') }}">دریافت ویدیو</a></video><figcaption class="mt-2 text-xs text-muted" dir="ltr">{{ $label }} · archive</figcaption></figure>
                                @endforeach
                            </div>
                        @endif
                    </details>
                @endforeach
            </div>
        </div>
    </section>
</x-layout>
