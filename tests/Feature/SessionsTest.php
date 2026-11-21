<?php

namespace Tests\Feature;

use App\Support\LegacyContent;
use DateTimeImmutable;
use Tests\TestCase;

class SessionsTest extends TestCase
{
    public function test_sessions_index_shows_twelve_distinct_events_in_event_date_order(): void
    {
        $this->travelTo(new DateTimeImmutable('2026-11-27 12:00:00 Asia/Tehran'));

        $this->get('/sessions')->assertOk()->assertSee('12 گردهمایی ثبت‌شده')->assertSee('نشست‌های پیش رو')->assertSee('زمان و مکان نشست بعدی هنوز اعلام نشده است.')->assertSeeInOrder([
            'نشست شانزدهم کرمان‌لاگ',
            'نشست چهاردهم کرمان‌لاگ',
            'نشست سیزدهم کرمان‌لاگ',
            'نشست دوازدهم کرمان‌لاگ',
            'نشست یازدهم کرمان‌لاگ',
            'نشست دهم کرمان‌لاگ',
            'نشست نهم کرمان‌لاگ',
            'نشست هشتم کرمان‌لاگ',
            'نشست هفتم کرمان‌لاگ',
            'دورهمی یک‌سالگی گروه کاربران لینوکس کرمان',
            'دومین فستیوال نصب لینوکس و برنامه‌های لینوکسی',
            'فستیوال نصب توزیع‌های مختلف لینوکس',
        ]);
    }

    public function test_remaining_meetings_preserve_supplied_dates_venues_and_presentation_details(): void
    {
        $this->get('/sessions/meeting-14')->assertOk()->assertSee('۱۸ دی ۱۴۰۴')->assertSee('2026-01-08')->assertSee('آوینوکس')->assertSee('کارخانهٔ نوآوری کرمان')->assertSee('Serverless Computing')->assertSee('AI Workloads')->assertSee('توسعه‌دهندگان بک‌اند')->assertSee('https://evnd.co/iZhbm')->assertSee('اطلاعیهٔ آرشیوی');
        $this->get('/sessions/meeting-13')->assertOk()->assertSee('۶ آذر ۱۴۰۴')->assertSee('2025-11-27')->assertSee('ریچارد استالمن و لینوس توروالدز')->assertSee('ثبت‌نام رایگان است')->assertSee('https://evnd.co/GfU8g');
        $this->get('/sessions/meeting-12')->assertOk()->assertSee('۸ اسفند ۱۳۹۶')->assertSee('2018-02-27')->assertSee('کتابفروشی طاقچه')->assertSee('میدان کوثر')->assertSee('17:20')->assertSee('18:30');
        $this->get('/sessions/meeting-11')->assertOk()->assertSee('۲۹ مهر ۱۳۹۵')->assertSee('2016-10-20')->assertSee('ابتدای خیابان بهشتی')->assertSee('16:30')->assertSee('18:00');
    }

    public function test_meeting_pages_preserve_event_dates_agenda_and_report_links(): void
    {
        $this->get('/sessions/meeting-10')->assertOk()->assertSee('۲۵ شهریور ۱۳۹۵')->assertSee('17:30')->assertSee('19:00')->assertSee('آقای طوفانی')->assertSee('KeePass')->assertSee('/blog/post/2016-09-16-meetings-9-and-10')->assertSee('در منبع ثبت نشده');
        $this->get('/sessions/meeting-9')->assertOk()->assertSee('۳۱ تیر ۱۳۹۵')->assertSee('آقای احمدی')->assertSee('/blog/post/2016-09-16-meetings-9-and-10');
        $this->get('/sessions/meeting-8')->assertOk()->assertSee('۲۷ خرداد ۱۳۹۵')->assertSee('رایان‌گرافیک')->assertSee('آقای حسینی');
        $this->get('/sessions/meeting-7')->assertOk()->assertSee('۳۰ اردیبهشت ۱۳۹۵')->assertSee('19:30');
        $this->get('/sessions/first-anniversary')->assertOk()->assertSee('اطلاعیهٔ آرشیوی')->assertSee('گزارش تأیید برگزاری')->assertSee('16:30');
    }

    public function test_announcement_report_pairs_link_to_one_session_instead_of_duplicate_events(): void
    {
        $this->get('/sessions/first-install-fest')->assertOk()->assertSee('/blog/post/2013-08-31-linux-install-fest')->assertSee('/blog/post/2013-09-01-install-fest-report');
        $this->get('/sessions/second-install-fest')->assertOk()->assertSee('/blog/post/2013-09-20-second-install-fest')->assertSee('/blog/post/2013-09-23-second-install-fest-report');
        $this->get('/blog/post/2016-09-16-meetings-9-and-10')->assertOk()->assertSee('/sessions/meeting-9')->assertSee('/sessions/meeting-10');
        $this->get('/sessions/missing')->assertNotFound();
    }

    public function test_future_session_details_appear_on_the_index_detail_and_homepage(): void
    {
        $this->travelTo(new DateTimeImmutable('2027-01-10T10:00:00+03:30'));
        $this->useSessions([$this->futureSession()]);

        $this->get('/sessions')->assertOk()->assertSee('نشست آیندهٔ آزمایشی')->assertSee('نشست پیش رو')->assertSee('18:00');
        $this->get('/sessions/future-meeting')->assertOk()->assertSee('نام سخنران')->assertSee('موضوع ارائه')->assertSee('نشانی محل نشست')->assertSee('https://example.org/register')->assertSee('https://example.org/meeting');
        $this->get('/')->assertOk()->assertSee('نشست آیندهٔ آزمایشی')->assertSee('/sessions/future-meeting')->assertDontSee('زمان و مکان نشست بعدی هنوز اعلام نشده است.');
    }

    public function test_drafts_are_hidden_and_cancelled_or_elapsed_events_are_not_upcoming(): void
    {
        $this->travelTo(new DateTimeImmutable('2027-01-16T10:00:00+03:30'));
        $future = $this->futureSession();
        $draft = array_replace($future, ['slug' => 'draft-meeting', 'title' => 'پیش‌نویس محرمانه', 'status' => 'draft']);
        $cancelled = array_replace($future, ['slug' => 'cancelled-meeting', 'title' => 'نشست لغوشده', 'date' => '2027-02-01', 'status' => 'cancelled']);
        $this->useSessions([$future, $draft, $cancelled]);

        $this->get('/sessions')->assertOk()->assertDontSee('پیش‌نویس محرمانه')->assertSee('نشست لغوشده')->assertSee('زمان گذشته · بدون گزارش برگزاری');
        $this->get('/sessions/draft-meeting')->assertNotFound();
        $this->get('/sessions/cancelled-meeting')->assertOk()->assertSee('این نشست لغو شده است.')->assertDontSee('ثبت‌نام در نشست');
        $this->get('/')->assertOk()->assertSee('زمان و مکان نشست بعدی هنوز اعلام نشده است.')->assertDontSee('نشست آیندهٔ آزمایشی');
    }

    private function futureSession(): array
    {
        $template = json_decode(file_get_contents(resource_path('content/session-template.json')), true, flags: JSON_THROW_ON_ERROR);

        return array_replace($template, [
            'slug' => 'future-meeting', 'title' => 'نشست آیندهٔ آزمایشی', 'status' => 'scheduled',
            'date' => '2027-01-15', 'start_time' => '18:00', 'end_time' => '20:00',
            'format' => 'online', 'address' => 'نشانی محل نشست',
            'online_url' => 'https://example.org/meeting', 'registration_url' => 'https://example.org/register',
            'agenda' => [['title' => 'موضوع ارائه', 'speaker' => 'نام سخنران', 'minutes' => 30]],
        ]);
    }

    private function useSessions(array $sessions): void
    {
        $this->instance(LegacyContent::class, new class($sessions) extends LegacyContent
        {
            public function __construct(private array $sessions) {}

            public function read(string $name): array
            {
                return $name === 'sessions' ? $this->sessions : parent::read($name);
            }
        });
    }
}
