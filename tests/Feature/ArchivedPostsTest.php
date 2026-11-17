<?php

namespace Tests\Feature;

use Tests\TestCase;

class ArchivedPostsTest extends TestCase
{
    public function test_all_five_supplied_archive_posts_retain_their_dates_author_and_complete_text(): void
    {
        $posts = [
            '2013-12-18-one-year-anniversary' => ['یک سالگی گروه کاربران لینوکس کرمان', 'واحد ۲۰۶', 'ساعت ۱۶.۳۰'],
            '2013-09-23-second-install-fest-report' => ['گزارش دومین فستیوال نصب لینوکس و برنامه‌های لینوکسی', 'در این جلسه سعی بر برطرف کردن اشکالات دوستان بود', 'موفق باشید'],
            '2013-09-20-second-install-fest' => ['دومین فستیوال نصب لینوکس و برنامه‌های لینوکسی', 'این اینستال فست فقط بهونه ایه', 'ساعت ۶ تا ۸'],
            '2013-09-01-install-fest-report' => ['گزارش فستیوال نصب لینوکس', 'نکات پارتیشن بندی', 'تشکر از همه‌ی دوستانی که حضور داشتند.'],
            '2013-08-31-linux-install-fest' => ['فستیوال نصب توزیع‌های مختلف لینوکس', 'ubuntu,mint,elementary,centos,debian', 'زمان: دهم شهریور ماه. ساعت ۱۸ تا ۲۰'],
        ];

        foreach ($posts as $slug => [$title, $body, $ending]) {
            $this->get('/blog/post/'.$slug)->assertOk()->assertSee($title)->assertSee('ارش اردلان')->assertSee(substr($slug, 0, 10))->assertSee($body)->assertSee($ending)->assertSee('نسخهٔ بایگانی‌شدهٔ نوشته')->assertDontSee('src=""', false);
        }
    }

    public function test_wordpress_post_ids_redirect_permanently_to_the_matching_articles(): void
    {
        $ids = [
            715 => '2013-12-18-one-year-anniversary',
            684 => '2013-09-23-second-install-fest-report',
            681 => '2013-09-20-second-install-fest',
            675 => '2013-09-01-install-fest-report',
            670 => '2013-08-31-linux-install-fest',
        ];

        foreach ($ids as $id => $slug) {
            $this->get('/?p='.$id)->assertStatus(301)->assertRedirect('/blog/post/'.$slug);
        }

        $this->get('/?p=999999')->assertNotFound();
        $this->get('/?p[]=715')->assertNotFound();
    }

    public function test_archive_category_lists_only_the_five_older_posts_and_preserves_image_sources(): void
    {
        $this->get('/blog/categories/'.rawurlencode('آرشیو'))->assertOk()->assertSeeInOrder([
            'یک سالگی گروه کاربران لینوکس کرمان',
            'گزارش دومین فستیوال نصب لینوکس و برنامه‌های لینوکسی',
            'دومین فستیوال نصب لینوکس و برنامه‌های لینوکسی',
            'گزارش فستیوال نصب لینوکس',
            'فستیوال نصب توزیع‌های مختلف لینوکس',
        ])->assertDontSee('تابستان لاگ کرمان');

        $this->get('/blog/post/2013-09-23-second-install-fest-report')->assertOk()->assertSee('image-300x224.jpeg')->assertSee('logos_linux_n43sa424-120x150.png');
    }
}
