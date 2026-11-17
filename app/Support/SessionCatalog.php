<?php

namespace App\Support;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use IntlDateFormatter;

class SessionCatalog
{
    public function __construct(private LegacyContent $content) {}

    public function all(): Collection
    {
        return collect($this->content->read('sessions'))
            ->reject(fn (array $session): bool => $session['status'] === 'draft')
            ->map(function (array $session): array {
                $session['date_label'] = $this->dateLabel($session['date']);
                $session['is_upcoming'] = $session['status'] === 'scheduled'
                    && ($session['date'] === null || CarbonImmutable::parse($session['date'].' '.($session['end_time'] ?? '23:59:59'), $session['timezone'])->isFuture());
                $session['status_label'] = match ($session['status']) {
                    'completed' => 'برگزار شده',
                    'cancelled' => 'لغو شده',
                    'announced' => 'اطلاعیهٔ آرشیوی',
                    default => $session['is_upcoming'] ? 'نشست پیش رو' : 'زمان گذشته · بدون گزارش برگزاری',
                };

                return $session;
            })
            ->sortByDesc(fn (array $session): string => ($session['date'] ?? '9999-12-31').'/'.$session['slug'])
            ->values();
    }

    public function upcoming(): Collection
    {
        return $this->all()->where('is_upcoming', true)->sortBy(fn (array $session): string => ($session['date'] ?? '9999-12-31').'/'.($session['start_time'] ?? '23:59'))->values();
    }

    public function find(string $slug): ?array
    {
        return $this->all()->firstWhere('slug', $slug);
    }

    public function reports(array $session): Collection
    {
        return $this->content->posts()->whereIn('slug', $session['source_posts'])->values();
    }

    private function dateLabel(?string $date): string
    {
        if ($date === null) {
            return 'تاریخ به‌زودی اعلام می‌شود';
        }

        if (! class_exists(IntlDateFormatter::class)) {
            return $date.' (میلادی)';
        }

        $formatter = new IntlDateFormatter('fa_IR@calendar=persian', IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'Asia/Tehran', IntlDateFormatter::TRADITIONAL, 'd MMMM yyyy');

        return $formatter->format(CarbonImmutable::parse($date.' 12:00', 'Asia/Tehran')->getTimestamp());
    }
}
